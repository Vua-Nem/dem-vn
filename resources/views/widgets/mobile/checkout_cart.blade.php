<div class="checkout-cart">
  <div class="header">
    <div class="title">Giỏ hàng</div>
    <img data-src="{{url("mobile/newImage/payment/close.svg")}}" alt="" class="lazyload" id="closeCheckoutCart" />
    <div class="icon">
      <div class="position-relative">
        <img data-src="{{url("mobile/newImage/payment/cart.svg")}}" alt="" class="lazyload" />
        <span id="cartcount">{{$cartCount}}</span>
      </div>
      <span class="cart-total-price">{{price($totalAmount - $totalDiscount)}} đ</span>
    </div>
    <div class="view-cart">
      <span>Xem giỏ hàng</span>
      <img class="lazyload arrow-down" data-src="{{url('mobile/newImage/payment/arrow_down.svg')}}" alt="">
    </div>
  </div>
  <div id="checkoutCart">
    <div class="block-order">
      <div class="list-product">
        @foreach($carts as $item)
        <div class="product">
          <div class="product-image">
            <img src="{{$item->options->default_img}}" alt="" width="77px" height="74px">
          </div>
          <div class="product-info">
            <div class="product-name">{{$item->name}}</div>
            <p class="product-variant">
              Kích thước: {{$item->options->width}} x {{$item->options->length}}c,
              <br>
              Độ dày: {{$item->options->thickness}}cm
            </p>
            <div class="number-qty">
              Số lượng: {{$item->qty}}
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <form id="form-voucher" class="{{!$vouchers->count() ? 'active' : '' }}" method="post" action="/ajax/voucher/add">
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
            <span class="title">Tổng</span>
            <span class="value">{{price($totalAmount)}} đ</span>
          </div>
          <div class="shipping-order">
            <span class="title">Vận chuyển</span>
            <span class="value">Miễn phí</span>
          </div>
          <div class="voucher-code">
            <span class="title">Giảm giá</span>
            <div class="d-flex align-items-center gap-2">
              @if(!$vouchers->count())
              <span class="value">0 đ</span>
              @else
              @foreach($vouchers as $voucher)
              <div class="value">-{{price($voucher->price)}} đ</div>
              @endforeach
              @endif
              <img class="lazyload remove-voucher cursor-pointer {{ $vouchers->count() ? 'active' : '' }}" data-src="{{url("mobile/newImage/payment/trash.svg")}}" alt="">
            </div>
          </div>
        </div>
        <div class="total">
          <div class="total-price">
            <span class="title">Tổng</span>
            <span class="value">{{price($totalAmount - $totalDiscount)}} đ</span>
          </div>
        </div>
      </div>
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
            $(".cart-total-price").text(Number.parseFloat(data.data.total_amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ')
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
          $(".cart-total-price").text(Number.parseFloat(data.data.amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ')
        }
      }
    });
  });

  $('#closeCheckoutCart').click(function() {
    $('.checkout-cart').toggleClass('active');
  })

  $('.view-cart').click(function() {
    $('.checkout-cart').toggleClass('active');
  })
</script>
@endpush