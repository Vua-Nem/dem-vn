<!doctype html>
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
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : ''
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
    <div class="checkout-main page-checkout">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="content-left">
                        <div class="logo">
                            <a href="{{route("home")}}">
                                <img src="{{url("web/image/homepage/logo.svg")}}">
                            </a>
                        </div>
                        <form class="form-info" method="post" action="{{route("order.customer")}}">
                            {{csrf_field()}}
                            <div class="title-cart">1. Thông tin khách hàng</div>
                            <div class="form-group">
                                <div class="label">Số điện thoại di động<sup> *</sup></div>
                                @if($errors->has('phone'))
                                    <span class="error-message">{{ $errors->first('phone') }}</span>
                                @endif
                                <input class="form-control" type="text" name="phone" id="phone" value="@if(isset($customer["phone"])){{$customer["phone"]}}@endif">
                            </div>
                            <div class="form-group">
                                <div class="label">Email<sup> *</sup></div>
                                @if ($errors->has('email'))
                                    <span class="error-message">{{ $errors->first('email') }}</span>
                                @endif
                                <input name="email" id="email" class="form-control @if($errors->has('email')) error @endif" value="@if(isset($customer["email"])) {{$customer["email"]}}@endif">
                            </div>
                            <div class="form-group">
                                <div class="label">Họ và tên<sup> *</sup></div>
                                @if ($errors->has('full_name'))
                                    <span class="error-message">{{ $errors->first('full_name') }}</span>
                                @endif
                                <input type="text" name="full_name" id="full_name" class="form-control @if($errors->has('full_name')) error @endif" value="@if(isset($customer["full_name"])) {{$customer["full_name"]}}@endif">
                            </div>
                            <div class="form-group">
                                <div class="label">Tỉnh/Thành phố<sup> *</sup></div>
                                @if ($errors->has('province_id'))
                                    <span class="error-message">{{ $errors->first('province_id') }}</span>
                                @endif
                                <select name="province_id" id="province" class="form-control @if($errors->has('province_id')) error @endif">
                                    <option>Tỉnh/Thành Phố</option>
                                    @foreach($provinces as $province)
                                    <option @if(isset($customer["province_id"]) && $customer["province_id"]==$province->id) selected
                                        @endif
                                        value="{{$province->id}}">{{$province->name}}</checkout-main page-checkoutoption>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="label">Quận/Huyện<sup> *</sup></div>
                                @if ($errors->has('district_id'))
                                    <span class="error-message">{{ $errors->first('district_id') }}</span>
                                @endif
                                <select id="district" name="district_id" class="form-control @if($errors->has('district_id')) error @endif">
                                    @if(!empty($districts))
                                    @foreach($districts as $district)
                                    <option @if(isset($customer["district_id"]) && $customer["district_id"]==$district->id) selected
                                        @endif
                                        value="{{$district->id}}">{{$district->name}}</option>
                                    @endforeach
                                    @else
                                    <option>Quận/Huyện</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="label">Địa chỉ cụ thể<sup> *</sup></div>
                                @if ($errors->has('address'))
                                    <span class="error-message">{{ $errors->first('address') }}</span>
                                @endif
                                <input  name="address" id="address" class="form-control @if($errors->has('address')) error @endif" value="@if(isset($customer["email"])) {{$customer["email"]}}@endif">
                            </div>
                            <div class="checkout-left-bottom js-ga-click-address">
                                <button class="button-action style1" type="submit"><span>Thanh toán <i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="checkout-right">
                        <div class="title-cart">Giỏ hàng</div>
                        <?php $totalAmount = 0; ?>
                        <div class="list-products">
                            @foreach(Cart::content() as $item)
                            <div class="product-items js-ga-checkout-product-data {{$item->rowId}}"
                                data-product-id="{{explode("_", $item->id)[0]}}"
                                data-product-name="{{$item->name}}"
                                data-product-price="{{$item->price}}"
                                data-product-variant="{{$item->options->sku}}"
                                data-product-qty="{{$item->qty}}">
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
                            <?php $totalAmount += ($item->price * $item->qty); ?>
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
                            <p class="total-amount">{{price($totalAmount - $totalDiscount)}}đ</p>
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
                            <p class="total-amount">{{price($totalAmount)}}đ</p>
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
    <script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#province').on('change', function() {
                var url = "{{route('ajax.getDistrict')}}";
                $.get(url + '?id=' + $(this).val(), function(data, status) {
                    $("#district").html(data);
                });
            });

            $("#createOrder").on('submit', function(event) {
                return confirm("Bạn có thật sự muốn tạo đơn hàng. Bấm Ok để tiếp tục");
            });

            $('#form-voucher').submit(function(e) {
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
                        success: function(data) {
                            if (data.success === true) {
                                $(".voucher-info").show();
                                $('#form-voucher').hide();
                                $(".voucher-label").text(data.data.code);
                                $(".voucher-amount").text('-' + Number.parseFloat(data.data.discount_value).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                                $(".total-amount").text(Number.parseFloat(data.data.total_amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ')
                            } else {
                                $(".error-voucher").text(data.message).show();
                            }
                        }
                    });
                }
            });

            $('.remove-voucher').click(function(e) {
                $.ajax({
                    url: "{{route('cart.removerVoucher')}}",
                    method: "GET",
                    success: function(data) {
                        if (data.success === true) {
                            $(".voucher-info").hide();
                            $("#form-voucher").show();
                            $(".total-amount").text(Number.parseFloat(data.data.amount).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ')
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
            } else if (value === 'plus' && qty <= 4){
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
                        $(".pre-amount .price").text(Number.parseFloat(data.data.subtotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                        $(".total-amount").text(Number.parseFloat(data.data.grandTotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                        $(".js-ga-checkout-product-data." + id).attr('data-product-qty', qty);
                    }
                }
            });
        }
    </script>
</body>

</html>
