<div class="header-wapper">
    <div class="header-topbar" style="display: none;">
        <p><a href="#">Nhận ngay voucher 1 triệu từ dem.vn</a></p>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="header-logo">
                    <a href="{{route("home")}}">
                        <img src="{{url("/web/image/homepage/logo.svg")}}">
                    </a>
                     <div class="main-menu">
                        <div class="header-menu">
                            <ul class="menu-list">
                                <li class="item parent has-submenu">
                                    <a class="menu-link" href="#">Đệm <i class="fa fa-caret-down"
                                                                         aria-hidden="true"></i></a>
                                    <ul class="submenu">
                                        <li><a class="menu-link" href="{{route("product.detail1")}}">Đệm foam Goodnight
                                                Eva</a></li>
                                        <li><a class="menu-link" href="{{route("product.detail2")}}">Đệm foam Goodnight
                                                Galaxy</a></li>
                                        <li><a class="menu-link" href="{{route("product.detail3")}}">Đệm lò xo Goodnight
                                                4Star</a></li>
                                        <li><a class="menu-link" href="{{route("product.detail4")}}">Đệm Foam Goodnight
                                                Massage Nhật Bản</a></li>
                                        <li><a class="menu-link" href="{{route("product.detail5")}}">Đệm Foam Than Hoạt Tính
                                                Zinus Charcoal Foam</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="main-menu">
                    <div class="header-menu">
                        <ul class="menu-list">
                           
                            <li>
                                <div class="header-phone desktop">
                                    <img src="{{url("/web/image/homepage/phone2.svg")}}"> <a href="tel:18002095">1800 2095</a>
                                </div>
                            </li>
                            @foreach($menus as $value)
                                <li>
                                    <a href="{{$value->url}}">{{$value->name}}</a>
                                </li>
                            @endforeach
                            <li>
                                <div class="header-cart">
                                    <div class="active-cart">
                                        <span class="icon-cart">
                                            <img src="{{url("/web/image/homepage/icon-cart.svg")}}">
                                            <span id="cartcount">{{Cart::count()}}</span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="mini-cart">
        <div class="minicart">
            <div class="title-cart">
                <div class="cart-icon">
                    <img src="{{url("/web/image/homepage/icon-cart.svg")}}"> Giỏ Hàng ({{Cart::count()}})
                </div>
                <div class="close-minicart">
                    Đóng
                </div>
            </div>
            @if (Cart::content()->count() > 0)
                <div class="content-block">
                    <div class="list-items">
                        <?php $totalAmount = 0; ?>
                        <div class="list-products">
                            @foreach(Cart::content() as $item)
                                @if($item->options->product_attach_status == false)
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
                                                        @if($item->options->product_attach_status != true)
                                                            <button type="button" class="button hollow circle minus"
                                                                    onclick="qty('minus', '{{$item->rowId}}')">
                                                                <span>-</span>
                                                            </button>
                                                        @endif
                                                        <input readonly id="quantity_{{$item->rowId}}"
                                                               class="quantity_{{$item->rowId}}" type="text" name="quantity"
                                                               min="1" max="5" value="{{$item->qty}}">
                                                        @if($item->options->product_attach_status != true)
                                                            <button type="button" class="button hollow circle plus"
                                                                    onclick="qty('plus', '{{$item->rowId}}')">
                                                                <span>+</span>
                                                            </button>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-product">
                                            <div class="content-pr">
                                                <div class="header-block">
                                                    <h3 class=name-product>{{$item->name}}</h3>
                                                    <a href="{{route("cart.cartRemoveItem", ["itemId" => $item->rowId])}}"
                                                       class="remove-item">Xoá</a>
                                                </div>
                                                <p class="option-product"><label class="label">Kích
                                                        thước:</label> {{$item->options->width}}
                                                    x {{$item->options->length}}cm</p>
                                                <p class="option-product"><label class="label">Độ
                                                        dày: </label> {{$item->options->thickness}}cm</p>
                                                <p class="price-pr desktop"><label class="label">Giá: </label> <span
                                                            class="price">{{price($item->price)}}đ</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach(Cart::content() as $item2)
                                        <?php $id_product = explode('_',$item->id)?>
                                        @if($item2->options->product_attach_status == true && ($item2->options->product_attach_id  == $id_product[0]))
                                            <div class="no-border product-items js-ga-checkout-product-data {{$item2->rowId}}"
                                                 data-product-id="{{explode("_", $item2->id)[0]}}"
                                                 data-product-name="{{$item2->name}}"
                                                 data-product-price="{{$item2->price}}"
                                                 data-product-variant="{{$item2->options->sku}}"
                                                 data-product-qty="{{$item2->qty}}">
                                                <div class="image">
                                                    <img src="{{$item2->options->default_img}}" alt="">
                                                </div>
                                                <div class="info-product">
                                                    <div class="content-pr">
                                                        <div class="header-block">
                                                            <div class="sale-km">Khuyến mại</div>
                                                            <h3 class=name-product>{{$item2->name}}</h3>
                                                            <!-- <a href="{{route("cart.cartRemoveItem", ["itemId" => $item2->rowId])}}"
                                                               class="remove-item">Xoá</a> -->
                                                        </div>
                                                        <p class="option-product"><label class="label">Kích
                                                                thước:</label> {{$item2->options->width}}
                                                            x {{$item2->options->length}}cm</p>
                                                        <p class="option-product"><label class="label">Độ
                                                                dày: </label> {{$item2->options->thickness}}cm</p>
                                                        <p class="price-pr desktop"><label class="label">Giá: </label> <span
                                                                    class="price">{{price($item2->price)}}đ</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                                <?php $totalAmount += ($item->price * $item->qty); ?>
                            @endforeach
                        </div>
                    </div>
                    <?php $html = Widget::run('showVoucher'); ?>
                    @if(strlen($html))
                        <div class="voucher-code">
                            {{ Widget::run('showVoucher') }}
                        </div>
                    @endif
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
                                    <p class="name-voucher"><span class="remove-voucher">Xóa</span><span
                                                class="voucher-label">{{\Illuminate\Support\Str::upper($voucher->name)}}</span>
                                    </p>
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
                                <p class="name-voucher"><span class="remove-voucher">Xóa</span><span
                                            class="voucher-label"></span></p>
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
                    <div class="button-active">
                        <a class="button-left" href="#">
                            <i class="fa fa-angle-left" aria-hidden="true"></i> Tiếp tục mua sắm
                        </a>
                        <a class="button-right button-action style1 js-ga-begin-checkout"
                           href="{{route('order.customer')}}">
                            <span>Thanh toán <i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        </a>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <div class="content-minicart">
                        <p>Hiện tại chưa có sản phẩm nào <br> trong giỏ hàng</p>
                        <div class="button-continue button-action style1"><span>Tiếp tục mua sắm</span></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="overlay"></div>
</div>
<style type="text/css">
    .no-border{border:none!important;background: #F8F8F8;}
    .list-products .product-items.no-border{padding-bottom: 10px;padding-top: 10px;}
    .sale-km{    color: #FFFFFF;
    background: #DD4A4A;margin-bottom: 5px;
    border-radius: 200px;
    display: inline-block;
    padding: 2px 15px;
    font-size: 14px;
    font-weight: 300;}
    .list-products .product-items .info-product{width: 100%;}
</style>
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".item.has-submenu").hover(function () {
                $('body').addClass('overlay-active');
            }, function () {
                $('body').removeClass('overlay-active');
            });
            $('.active-cart').click(function (e) {
                $('#mini-cart, .overlay, body').addClass('active')
            });
            $('.close-minicart, .button-left, .overlay, .button-continue').click(function (e) {
                $('#mini-cart, .overlay, body').removeClass('active')
            });
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

            $('.remove-voucher').click(function (e) {
                $.ajax({
                    url: "{{route('cart.removerVoucher')}}",
                    method: "GET",
                    success: function (data) {
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
                success: function (data) {
                    if (data.success === true) {
                        $(".pre-amount .price").text(Number.parseFloat(data.data.subtotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                        $(".total-amount").text(Number.parseFloat(data.data.grandTotal).toFixed().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + 'đ');
                    }
                }
            });
        }
    </script>
@endpush
