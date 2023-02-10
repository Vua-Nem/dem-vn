<div class="header-wrapper">
  <div class="section-header">
    <div class="hotline-section">
      <img data-src="{{url('web/newImage/headphone.svg')}}" alt="" class="lazyload" />
      <span class="text-hotline">Hotline: 1800 2092</span>
    </div>
    <span class="text-header">Mua nệm trả góp 0%. <a>Mua ngay!</a>
    </span>
    <img data-src="{{url('web/newImage/close.svg')}}" alt="" class="close-icon lazyload" />
  </div>
  <div class="section-menu">
    <div class="menu-item">
      @foreach($categories as $category)
        <div class="dropdown">
          <a class="menu-title" href="{{route('category.detail', $category->slug)}}">{{$category->name}} <i class="fa fa-caret-down" aria-hidden="true"></i></a>
          <ul class="dropdown-content">
            @foreach($category->products as $product)
            <li class="dropdown-item">
              <a>{{$product->name}}</a>
            </li>
            @endforeach
          </ul>
        </div>
      @endforeach
      <a class="menu-title" href="#">Về chúng tôi</a>
    </div>
    <a href={{route('home')}}>
      <img data-src="{{url('web/newImage/logo.svg')}}" alt="" class="cursor-pointer lazyload" />
    </a>
    <div class="d-flex gap-4 align-items-center">
      <div class="position-relative">
        <form action="{{route('search')}}" action="get">
          <input type="text" class="input-search" placeholder="Tìm kiếm" name="keyword" />
          <button type="submit" class="icon-search">
           <img data-src="{{url('web/newImage/search-icon.svg')}}" alt="" class="lazyload" />
          </button>
        </form>
      </div>
      <img data-src="{{url('web/newImage/circleZalo.svg')}}" alt="" class="cursor-pointer lazyload" />
      <div class="position-relative active-cart">
        <img data-src="{{url("web/newImage/cart.svg")}}" alt="" class="cursor-pointer lazyload" />
        <span id="cartcount">{{Cart::count()}}</span>
      </div>
    </div>
  </div>
</div>
<div class="overlay"></div>
<div id="cart">
  <div class="header-cart">
    <div class="title-cart">
      <div class="cart-icon">
        <div class="position-relative">
          <img data-src="{{url("web/newImage/cart.svg")}}" alt="" class="cursor-pointer lazyload" />
          <span id="cartcount">{{Cart::count()}}</span>
        </div>
        <span>Giỏ Hàng</span>
      </div>
      <img data-src="{{url('web/newImage/close-cart.svg')}}" alt="" class="cursor-pointer lazyload close-cart" />
    </div>
    <div class="note-cart">Giỏ hàng của bạn có&nbsp;<span>{{Cart::count()}} sản phẩm</span></div>
  </div>
  @if (Cart::content()->count() == 0)
  <div class="empty-cart">
    <p>Hiện tại chưa có sản phẩm nào <br> trong giỏ hàng</p>
    <div class="button-continue"><span>Tiếp tục mua sắm</span></div>
  </div>
  @else
  <div class="cart-products">
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
              Kích thước: {{$item->options->width}} x {{$item->options->length}}cm
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
  </div>
  <div class="content-cart">
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
      <div class="total-price">
        <span class="title">Tổng tạm tính</span>
        <span class="value">{{price($totalAmount - $totalDiscount)}} đ</span>
      </div>
    </div>
  </div>
  <div class="bottom-cart">
    <div class="button-active">
      <a class="button-left" href="#">Tiếp tục mua sắm</a>
      <a class="button-right js-ga-begin-checkout" href={{route('order.customer')}}>
        <img class="lazyload" data-src="{{url('web/newImage/lock.svg')}}" alt="">
        <span>Thanh toán</span>
      </a>
    </div>
    <div class="logo-payments">
      <img data-src="{{url('web/newImage/detail/ic-payment-all.svg')}}" alt="list payment" class="lazyload">
    </div>
  </div>
  @endif
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    $(".dropdown").hover(function() {
      $('body').addClass('overlay-active');
    }, function() {
      $('body').removeClass('overlay-active');
    });

    $('.active-cart').click(function(e) {
      $('#cart, .overlay, body').addClass('active')
    });

    $('.close-cart, .button-left, .overlay, .button-continue').click(function(e) {
      $('#cart, .overlay, body').removeClass('active')
    });
  })

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

  $('.close-icon').click(function() {
    $('.section-header').hide();
  })
</script>
@endpush

