<div class="block-order">
  <div class="order-title">Chi Tiết Đơn Hàng</div>
  <div class="block-detail">
    <div class="list-product">
      <?php $totalAmount = 0; ?>
      @foreach(Cart::content() as $item)
      <div class="product">
        <div class="product-image">
          <img src="{{$item->options->default_img}}" alt="" width="114px" height="93px">
        </div>
        <div class="product-info">
          <div class="product-name">{{$item->name}}</div>
          <p class="product-variant">
            Kích thước: {{$item->options->width}} x {{$item->options->length}}c,
            <br>
            Độ dày: {{$item->options->thickness}}cm
          </p>
          <div class="number-qty">
            @if($item->options->product_attach_status != true)
            <button type="button" onclick="qty('minus', '{{$item->rowId}}')">
              <span>-</span>
            </button>
            @endif
            <input readonly id="quantity_{{$item->rowId}}" class="quantity_{{$item->rowId}}" type="text" name="quantity" min="1" max="5" value="{{$item->qty}}">
            @if($item->options->product_attach_status != true)
            <button type="button" onclick="qty('plus', '{{$item->rowId}}')">
              <span>+</span>
            </button>
            @endif
          </div>
        </div>
        <div class="block-price">
          <p class="price">{{price($item->price)}} đ</p>
          <p class="compare-price">{{price($item->options->compare_price)}} đ</p>
          <a href="{{route("cart.cartRemoveItem", ["itemId" => $item->rowId])}}">
            <img class="lazyload" data-src="{{url("web/newImage/payment/trash.svg")}}" alt="">
          </a>
        </div>
      </div>
      <?php $totalAmount += ($item->price * $item->qty); ?>
      @endforeach
    </div>
    <form id="form-voucher" class="{{!Cart::instance('voucher')->count() ? 'active' : '' }}" method="post" action="/ajax/voucher/add">
      {{csrf_field()}}
      <div class="discount-ps">
        <input id="input-voucher" type="text" placeholder="Nhập mã khuyến mãi" name="voucher">
        <button type="submit">Áp dụng</button>
      </div>
      <div class="error-voucher" style="display: none"></div>
    </form>
    <div id="block-total">
      <div class="block-order-price">
        <div class="order-price">
          <span class="title">Thành tiền</span>
          <span class="value">{{price($totalAmount)}} đ</span>
        </div>
        <div class="voucher-code">
          <span class="title">Mã giảm giá</span>
          <div class="d-flex align-items-center gap-2">
            <?php $totalDiscount = 0; ?>
            @if(!Cart::instance('voucher')->count())
            <span class="value">0 đ</span>
            @else
            @foreach(Cart::instance('voucher')->content() as $voucher)
            <div class="value">-{{price($voucher->price)}} đ</div>
            <?php $totalDiscount += $voucher->price; ?>
            @endforeach
            @endif
            <img class="lazyload remove-voucher cursor-pointer {{ Cart::instance('voucher')->count() ? 'active' : '' }}" data-src="{{url("web/newImage/payment/trash.svg")}}" alt="">
          </div>
        </div>
      </div>
      <div class="total">
        <div class="total-price">
          <span class="title">Tổng</span>
          <span class="value">{{price($totalAmount - $totalDiscount)}} đ</span>
        </div>
        <span class="note">(Đã bao gồm VAT)</span>
      </div>
    </div>
  </div>
  <div class="policies">
    <div class="item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/policy_1.svg')}}" alt="" />
      <p>180 ngày&nbsp;<span>ngủ thử</span></p>
    </div>
    <div class="item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/policy_2.svg')}}" alt="" />
      <p>Vận chuyển&nbsp;<span>Miễn Phí</span></p>
    </div>
    <div class="item">
      <img class="lazyload" data-src="{{url('web/newImage/detail/policy_3.svg')}}" alt="" />
      <p>Bảo hành&nbsp;<span>Chính Hãng</span></p>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $('#form-voucher').submit(function (e) {
    e.preventDefault();
    $(".error-voucher").hide()
    var voucher = $("#input-voucher").val();
    if (voucher != '') {
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: "{{route('cart.addVoucher')}}",
        method: "POST",
        data: {
          voucher: voucher,
          _token: _token
        },
        success: function (data) {
          if (data.success === true) {
            $('#form-voucher').removeClass('active');
            $('.remove-voucher').addClass('active');
            $(".voucher-code .value").text('-' + Number.parseFloat(data.data.discount_value).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
            $(".total-price .value").text(Number.parseFloat(data.data.total_amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ')
          } else {
            $(".error-voucher").text(data.message).show();
          }
        }
      });
    }
  });

  $('.remove-voucher').click(function (e) {
    $.ajax({
      url: "{{route('cart.removerVoucher')}}",
      method: "GET",
      success: function (data) {
        if (data.success === true) {
          $('.remove-voucher').removeClass('active');
          $('#form-voucher').addClass('active');
          $(".voucher-code .value").text('0 đ');
          $(".total-price .value").text(Number.parseFloat(data.data.amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ')
        }
      }
    });
  });

  function qty(value, id) {
    var qty = $('.quantity_' + id).val();
    if (value === 'minus' && qty >= 2) {
      qty--;
      $('.quantity_' + id).val(qty);
    } else if (value === 'plus' && qty <= 4) {
      qty++;
      $('.quantity_' + id).val(qty);
    }
    $.ajax({
      url: "{{route('cart.updateCartQty')}}",
      method: "GET",
      data: {
        rowId: id,
        qty: qty
      },
      success: function(data) {
        if (data.success === true) {
          $(".order-price .value").text(Number.parseFloat(data.data.subtotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
          $(".total-price .value").text(Number.parseFloat(data.data.grandTotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
        }
      }
    });
  }

</script>
@endpush