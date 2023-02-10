<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{url("web/css/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{url("web/css/style.css")}}">
  <link rel="stylesheet" href="{{url("web/css/font-awesome.min.css")}}">
  <link rel="icon" type="image/png" href="{{url("web/image/favicon.png")}}" />
  @stack('css')
  <meta property="og:title" content="Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.">
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime()
        , event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0]
        , j = d.createElement(s)
        , dl = l != 'dataLayer' ? '&l=' + l : ''
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5Q55Z8B');

  </script>
</head>
<body>
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q55Z8B" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <?php $totalAmount = 0; ?>
  @foreach(Cart::content() as $item)
  <?php $totalAmount += ($item->price * $item->qty); ?>
  @endforeach
  <div class="checkout-main page-payment">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <div class="content-left">
            <div class="logo">
              <a href="{{route("home")}}">
                <img src="{{url("web/image/homepage/logo.svg")}}">
              </a>
            </div>
            <div class="title-cart">1. Thông tin khách hàng</div>
            <div class="table-infor">
              <div class="line">
                <div class="cols-1">Họ tên</div>
                <div class="cols-2">{{$customer["full_name"]}}</div>
                <div class="cols-3"><a href="{{route("order.checkOut")}}#full_name">Thay đổi</a></div>
              </div>
              <div class="line">
                <div class="cols-1">Số điện thoại</div>
                <div class="cols-2">{{phone($customer["phone"])}}</div>
                <div class="cols-3"><a href="{{route("order.checkOut")}}#phone">Thay đổi</a></div>
              </div>
              <div class="line">
                <div class="cols-1">Địa chỉ</div>
                <div class="cols-2">{{$customer["address"]}} - {{$district->name}} - {{$province->name}}</div>
                <div class="cols-3"><a href="{{route("order.checkOut")}}#address">Thay đổi</a></div>
              </div>
              <div class="line">
                <div class="cols-1">Vận chuyển</div>
                <div class="cols-2">Miễn phí</div>
              </div>
            </div>
            <div class="title-cart mb-0">2. Thanh toán</div>
            <p class="desc">Toàn bộ các giao dịch được bảo mật và mã hoá</p>
            <form method="post" action="{{route("order.saveOrder")}}">
              {{csrf_field()}}
              <label class="check-box cod">
                <p>Nhận hàng và trả tiền (COD)</p>
                <input type="radio" checked name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_COD}}">
                <span class="check"></span>
              </label>

              <label class="check-box vnpay">
                <p>Thanh toán bằng VNPAY (ATM / Internet Banking / MasterCard)</p>
                <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_VNP}}">
                <span class="check"></span>
              </label>

              <label class="check-box">
                <p>Chuyển khoản ngân hàng</p>
                <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_INTERNET_BANKING}}">
                <span class="check"></span>

                <div class="tabs-bank">
                  <div class="tabs">
                    <div class="tablinks active" onclick="openCity(event, 'vcb')"><img src="{{url("web/image/bank-vietcombank.png")}}"></div>
                    <div class="tablinks" onclick="openCity(event, 'bvd')"><img src="{{url("web/image/bank-biv.png")}}"></div>
                  </div>
                  <div id="vcb" class="tabcontent">
                    <div class="bank-items-1">
                      <p style="font-weight: 600;">Tài khoản Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank):</p>
                      <p>– Số tài khoản: 0971.0000.15217</p>
                      <p>– Chủ tài khoản: Công ty cổ phần Vua Nệm</p>
                      <p>– Ngân hàng TMCP Ngoại thương Việt Nam (Vietcombank) – Chi nhánh Nam Hà Nội</p>
                    </div>
                  </div>
                  <div id="bvd" class="tabcontent">
                    <div class="bank-items-1">
                      <p style="font-weight: 600;">Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV)</p>
                      <p>– Số tài khoản: 21610000601982</p>
                      <p>– Chủ tài khoản: Công ty cổ phần Vua Nệm</p>
                      <p>– Ngân hàng TMCP Đầu tư và Phát triển Việt Nam (BIDV) – Chi nhánh Đống Đa Hà Nội</p>
                    </div>
                  </div>
                </div>
              </label>

              <label class="check-box payoo" @if($totalAmount < 3000000)style="display: none" @endif>
                <p>Trả góp bằng PAYOO (Thẻ tín dụng)</p>
                <input type="radio" name="payment_method" value="{{\App\Models\Orders::ORDER_PAYMENT_METHOD_IS_PAYOO}}">
                <span class="check"></span>
              </label>

              <div class="checkout-left-bottom js-ga-click-payment">
                <button class="button-action style1" type="submit"><span>Hoàn tất <i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <div class="checkout-right">
            <div class="title-cart">Giỏ hàng</div>
            <div class="list-products">
              @foreach(Cart::content() as $item)
              <div class="product-items js-ga-checkout-product-data {{$item->rowId}}" data-product-id="{{explode("_", $item->id)[0]}}" data-product-name="{{$item->name}}" data-product-price="{{$item->price}}" data-product-variant="{{$item->options->sku}}" data-product-qty="{{$item->qty}}">
                <div class="image">
                  <img src="{{$item->options->default_img}}" alt="">
                  <div class="number-qty">
                    <div class="input-group plus-minus-input">
                      <div class="input-group-button">
                        <button type="button" class="button hollow circle minus" onclick="qty('minus', '{{$item->rowId}}')">
                          <span>-</span>
                        </button>
                        <input id="quantity_{{$item->rowId}}" class="quantity_{{$item->rowId}}" type="text" name="quantity" min="1" max="5" class="qty-input" value="{{$item->qty}}">
                        <button type="button" class="button hollow circle plus" onclick="qty('plus', '{{$item->rowId}}')">
                          <span>+</span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="info-product">
                  <div class="content-pr">
                    <div class="header-block">
                      <h3 class=name-product>{{$item->name}}</h3>
                      <a href="{{route("cart.cartRemoveItem", ["itemId" => $item->rowId])}}" class="remove-item">Xoá</a>
                    </div>
                    <p class="option-product"><label class="label">Kích thước:</label> {{$item->options->width}} x {{$item->options->length}}cm</p>
                    <p class="option-product"><label class="label">Độ dày: </label> {{$item->options->thickness}}cm</p>
                    <p class="price-pr desktop"><label class="label">Giá: </label> <span class="price">{{price($item->price)}}đ</span></p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="amount-order">
              <div class="items pre-amount">
                <div class="title">Tạm tính</div>
                <div class="price">{{price($totalAmount)}}đ</div>
              </div>
              <div class="items shipping-amount">
                <div class="title">Vận chuyển</div>
                <div class="price"><span class="free">Miễn phí</span></div>
              </div>
              <div class="items shipping-amount">
                <span class="text">Đổi trả</span>
                <span class="price"><span class="free">6 tháng miễn phí</span></span>
              </div>
            </div>
            @if(Cart::instance('voucher')->count())
            <?php $totalDiscount = 0; ?>
            @foreach(Cart::instance('voucher')->content() as $voucher)
            <div class="voucher-info">
              <div class="title">Mã giảm giá</div>
              <div class="price-voucher">
                <p class="name-voucher"><span class="remove-voucher">Xóa</span><span class="voucher-label">{{\Illuminate\Support\Str::upper($voucher->name)}}</span></p>
                <p class="voucher-amount">-{{price($voucher->price)}} đ</p>
              </div>
            </div>
            <?php $totalDiscount += $voucher->price; ?>
            @endforeach
            <form id="form-voucher" method="post" action="/ajax/voucher/add" style="display: none">
              {{csrf_field()}}
              <div class="title">Mã giảm giá</div>
              <div class="discount-ps">
                <input id="input-voucher" type="text" placeholder="Nơi nhập mã giảm giá" name="voucher">
                <button type="submit">Áp dụng</button>
              </div>
              <div class="error-voucher" style="display: none"></div>
            </form>
            <div class="total">
              <p>Tổng</p>
              <p class="total-amount js-ga-total" data-product-total-amount="{{$totalAmount - $totalDiscount}}">{{price($totalAmount - $totalDiscount)}}đ</p>
            </div>
            @else
            <div class="voucher-info" style="display: none">
              <div class="title">Mã giảm giá</div>
              <div class="price-voucher">
                <p class="name-voucher"><span class="remove-voucher">Xóa</span><span class="voucher-label"></span></p>
                <p class="voucher-amount"></p>
              </div>
            </div>
            <form id="form-voucher" method="post" action="/ajax/voucher/add">
              {{csrf_field()}}
              <div class="title">Mã giảm giá</div>
              <div class="discount-ps">
                <input id="input-voucher" type="text" placeholder="Nơi nhập mã giảm giá" name="voucher">
                <button type="submit">Áp dụng</button>
              </div>
              <div class="error-voucher" style="display: none"></div>
            </form>
            <div class="total">
              <p>Tổng</p>
              <p class="total-amount js-ga-total" data-product-total-amount="{{$totalAmount}}">{{price($totalAmount)}}đ</p>
            </div>
            @endif
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-sm-6">
              <div class="bottom-block left">
                <div class="label-block">Gặp vấn đề trong quá trình thanh toán, vui lòng liên hệ</div>
                <div class="items-block">
                  <a class="item" href="tel:18002095">
                    <div class="icon">
                      <img src="{{url("/web/image/checkout/checkout-call.svg")}}">
                    </div>
                    <div class="title">1800 2095 <br> (Từ 8h30 - 21h) </div>
                  </a>
                  <a class="item" href="mailto:cskh@dem.vn">
                    <div class="icon">
                      <img src="{{url("/web/image/checkout/checkout-mail.svg")}}">
                    </div>
                    <div class="title">cskh@dem.vn</div>
                  </a>
                  <a class="item" href="https://www.messenger.com/t/dem.vn">
                    <div class="icon">
                      <img src="{{url("/web/image/checkout/checkout-chat.svg")}}">
                    </div>
                    <div class="title">Chat với <br> chúng tôi</div>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="bottom-block right">
                <div class="label-block">Ưu đãi siêu đặc biệt chỉ có tại dem.vn</div>
                <div class="items-block">
                  <div class="item">
                    <div class="icon" style="padding-top: 9px;">
                      <img height="32" style="margin-left: -5px" src="{{url("/web/image/homepage/ic-freeship.svg")}}">
                    </div>
                    <div class="title">Miễn phí <br> vận chuyển</div>
                  </div>
                  <div class="item">
                    <div class="icon" style="padding-top: 7px;">
                      <img height="32" src="{{url("/web/image/homepage/ic-nguthu.svg")}}">
                    </div>
                    <div class="title">180 ngày <br> ngủ thử</div>
                  </div>
                  <div class="item">
                    <div class="icon">
                      <img height="48" src="{{url("/web/image/homepage/ic-doitra.png")}}">
                    </div>
                    <div class="title">Miễn phí <br> đổi trả</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
    .check-box input:checked~.tabs-bank {
      display: block;
    }

    body .check-box .check {
      top: 11px;
    }

    .tabs-bank {
      display: none;
      padding-top: 10px;
    }

    .tablinks.active:after {
      width: 0;
      height: 0;
      border-left: 10px solid transparent;
      border-right: 10px solid transparent;
      border-bottom: 10px solid rgba(236, 224, 245, 0.95);
      content: "";
      position: absolute;
      bottom: -17px;
      left: calc(50% - 10px);
    }

    #vcb.tabcontent {
      display: block;
    }

    .tabcontent {
      display: none;
      background: linear-gradient(180deg, #F7F4FF 11.41%, rgba(247, 244, 255, 0) 95.62%);
      border: 1px solid rgba(236, 224, 245, 0.95);
      padding: 10px 15px;
      margin-top: 15px;
      box-sizing: border-box;
      color: #000F40;
      border-radius: 4px;
    }

    .tabs {
      display: flex
    }

    .tablinks img {
      max-width: 120px
    }

    .tablinks {
      padding: 10px;
      border: 1px solid #eaeaea;
      margin-right: 15px;
    }

    .tablinks.active {
      border: 1px solid #6800BE;
      border-radius: 4px;
      position: relative;
    }

  </style>
  <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

  </script>
  <script>
    $(document).ready(function() {
      $('#form-voucher').submit(function(e) {
        e.preventDefault();
        $(".error-voucher").hide()
        var voucher = $("#input-voucher").val();
        if (voucher != '') {
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "{{route('cart.addVoucher')}}"
            , method: "POST"
            , data: {
              voucher: voucher
              , _token: _token
            }
            , success: function(data) {
              console.log(data);
              if (data.success === true) {
                $(".voucher-info").show();
                $('#form-voucher').hide();
                $(".voucher-label").text(data.data.code);
                $(".voucher-amount").text('-' + Number.parseFloat(data.data.discount_value).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                $(".total-amount").text(Number.parseFloat(data.data.total_amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                $(".js-ga-total").attr('data-product-total-amount', data.data.total_amount);
                checkPaymentMethod(data.data.total_amount);
              } else {
                $(".error-voucher").text(data.message).show();
              }
            }
          });
        }
      });

      $('.remove-voucher').click(function(e) {
        $.ajax({
          url: "{{route('cart.removerVoucher')}}"
          , method: "GET"
          , success: function(data) {
            if (data.success === true) {
              $(".voucher-info").hide();
              $("#form-voucher").show();
              $(".total-amount").text(Number.parseFloat(data.data.amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
              $(".js-ga-total").attr('data-product-total-amount', data.data.total_amount);
              checkPaymentMethod(data.data.amount);
            }
          }
        });
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
        url: "{{route('cart.updateCartQty')}}"
        , method: "GET"
        , data: {
          rowId: id
          , qty: qty
        }
        , success: function(data) {
          if (data.success === true) {
            $(".pre-amount .price").text(Number.parseFloat(data.data.subtotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
            $(".total-amount").text(Number.parseFloat(data.data.grandTotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
            $(".js-ga-total").attr('data-product-total-amount', data.data.grandTotal);
            $(".js-ga-checkout-product-data." + id).attr('data-product-qty', qty);
            checkPaymentMethod(data.data.grandTotal);
          }
        }
      });
    }

    function checkPaymentMethod(grandTotal) {
      if (grandTotal >= 3000000) {
        $(".check-box.payoo").show();
      } else {
        $(".check-box.payoo").hide();
      }
    }

  </script>
</body>

</html>

