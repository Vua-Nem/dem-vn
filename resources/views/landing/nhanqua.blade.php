<!doctype html>
<html lang="en">
<head>
    <title>Nhận quà 8-3 từ Dem.vn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url("web/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("web/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("web/css/slick-theme.css")}}">
    <link type="text/css" rel="stylesheet" href="{{url("mobile/lightGallery/css/lightGallery.min.css")}}" />
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=GTM-5Q55Z8B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'GTM-5Q55Z8B');
    </script> -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5Q55Z8B');
    </script>
</head>
<body>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q55Z8B"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
    <div class="page-landing">
        <div class="background-landing">
            <div class="bg-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-7 section-top column-left">
                            <p class="alt-font" style="text-align: center;"><span style="font-size: 160%; color: #ffffff;">QUÀ TẶNG 8/3 DÀNH CHO BẠN</span></p>
                            <p class="alt-font" style="text-align: center;"><span style="color: #ffffff;">Hãy dành tặng bản thân bạn và những người phụ nữ bạn yêu thương 365 đêm ngon giấc trên những chiếc đệm chất lượng.</span></p>
                            <div class="d-none d-md-block">
                                <figure class="block-image size-large" style="text-align: center;">
                                    <img class="lazyload" style="width: 90%" data-src="{{url("/landing/nhanqua/anhr-1.png")}}" src="{{url("/landing/nhanqua/anhr-1.png")}}" alt="">
                                </figure>
                                <p class="alt-font" style="text-align: center;"><span style="color: #ffffff;">Voucher có giá trị đến hết ngày 31.03.2021. Voucher được sử dụng 1 lần duy nhất và trừ trực tiếp vào giá đơn hàng.</span></p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 column-right">
                            <div class="custom-form">
                                <p class="alt-font" style="text-align: center; margin-bottom: 0;"><span style="color: #000080;"><span style="font-size: 20.16px;"><b>Nhận ngay voucher</b></span></span></p>
                                <p class="uppercase alt-font" style="text-align: center;"><span style="color: #000080;"><span style="font-size: 20.16px;"><b>1 TRIỆU ĐỒNG</b></span></span></p>
                                <div role="form" class="cf7" id="cf7-f361-p320-o1" lang="en-US" dir="ltr">
                                    <form action="{{route("landing.postIndex")}}" method="post">
                                        {{csrf_field()}}
                                        <p>
                                            <span class="name">
                                                <input type="text" id="name" name="name" value="" size="40"
                                                       placeholder="Họ tên">
                                            </span>
                                        @if ($errors->has('name'))
                                            <span>{{ $errors->first('name') }}</span>
                                        @endif
                                        <br>
                                        <span class="number-phone">
                                                <input type="tel" id="number-phone" name="phone" value="" size="40"
                                                       maxlength="10" minlength="10" placeholder="Số điện thoại">
                                            </span>
                                        @if ($errors->has('phone'))
                                            <span>{{ $errors->first('phone') }}</span>
                                        @endif
                                        <br>
                                        <span class="email">
                                                <input type="email" name="email" value="" size="40" placeholder="Email">
                                            </span>
                                        @if ($errors->has('email'))
                                            <span>{{ $errors->first('email') }}</span>
                                        @endif
                                    </p>
                                    <input type="hidden" name="campain" value="8-3" id="campain">
                                    <div class="form-lp">
                                        <input type="submit" value="Đăng kí ngay" class="form-submit">
                                    </div>
                                    @if(Session::has('success'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                            {{ Session::get('success') }} Mã giảm giá của bạn: WOMENSDAY
                                        </p>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <div class="d-md-none">
                                <figure class="-block-image size-large">
                                    <img class="lazyload" width="961" height="563" data-src="{{url("/landing/nhanqua/anhr-1.png")}}" src="{{url("/landing/nhanqua/anhr-1.png")}}" alt="">
                                </figure>
                                <p class="alt-font" style="text-align: center;"><span style="color: #ffffff;">Voucher có giá trị đến hết ngày 31.01.2021. Voucher được sử dụng 1 lần duy nhất và trừ trực tiếp vào giá đơn hàng.</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-content product" style="padding-top: 30px; padding-bottom: 30px; background-color: rgb(245 245 245);">
            <div class="container">
                <div class="col-inner text-center">
                    <div class="title">
                        <img class="lazyload" width="844" height="58" data-src="{{url("/landing/nhanqua/lua-chon-phu-hop-vs-ban.png")}}" src="{{url("/landing/nhanqua/lua-chon-phu-hop-vs-ban.png")}}" alt="">
                    </div>
                    <p style="margin-bottom: 50px;" class="alt-font"><span style="font-size: 105%; color: #333333;">Sẽ luôn có một chiếc đệm tồn tại vì bạn và dành riêng cho bạn ở Dem.vn</span></p>
                </div>
                <div class="row">
                    <div class="item-product col-sm-12 col-md-4 mb-4">
                        <a href="https://dem.vn/products/dem_foam_gap_3_goodnight_eva.html">
                            <div class="col-inner">
                                <div class="image-product">
                                    <div class="label-product">Giá tốt nhất</div>
                                    <img class="lazyload" data-src="{{url("/landing/nhanqua/Eva.png")}}" src="{{url("/landing/nhanqua/Eva.png")}}">
                                    <div class="discount-percent">-10%</div>
                                </div>
                                <p class="product-name"><span style="font-size: 115%; color: #000000;">Đệm Foam Goodnight Eva</span></p>
                                <p class="alt-font">
                                    <span class="price"><span style="color: #6800BE;">2,160,000 đ </span> <del style="color: #8D8D8D;">(2,400,000 đ)</del></span><br>
                                    <span style="font-size: 115%;"><span style="color: #FF3939;">Giảm 10% + Tặng voucher 1 triệu</span></span>
                                </p>
                                <div class="button-action style2">
                                    <span>Mua ngay</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item-product col-sm-12 col-md-4 mb-4">
                        <a href="https://dem.vn/products/dem_lo_xo_goodnight_4stars.html">
                            <div class="col-inner">
                                <div class="image-product">
                                    <div class="label-product">Best-seller</div>
                                    <img class="lazyload" data-src="{{url("/landing/nhanqua/4-star.png")}}" src="{{url("/landing/nhanqua/4-star.png")}}">
                                    <div class="discount-percent">-15%</div>
                                </div>
                                <p class="product-name"><span style="font-size: 115%; color: #000000;">Đệm Foam Goodnight 4stars</span></p>
                                <p class="alt-font">
                                    <span class="price"><span style="color: #6800BE;">3,315,000 đ </span> <del style="color: #8D8D8D;">(3,900,000 đ)</del></span><br>
                                    <span style="font-size: 115%;"><span style="color: #FF3939;">Giảm 15% + Tặng voucher 1 triệu</span></span>
                                </p>
                                <div class="button-action style2">
                                    <span>Mua ngay</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item-product col-sm-12 col-md-4 mb-4">
                        <a href="https://dem.vn/products/dem_foam_goodnight_galaxy.html">
                            <div class="col-inner">
                                <div class="image-product">
                                    <div class="label-product">Organic</div>
                                    <img class="lazyload" data-src="{{url("/landing/nhanqua/Galaxy.png")}}" src="{{url("/landing/nhanqua/Galaxy.png")}}">
                                    <div class="discount-percent">-15%</div>
                                </div>
                                <p class="product-name"><span style="font-size: 115%; color: #000000;">Đệm Foam Goodnight Galaxy</span></p>
                                <p class="alt-font">
                                    <span class="price"><span style="color: #6800BE;">4,845,000 đ </span> <del style="color: #8D8D8D;">(5,700,000 đ)</del></span><br>
                                    <span style="font-size: 115%;"><span style="color: #FF3939;">Giảm 15% + Tặng voucher 1 triệu</span></span>
                                </p>
                                <div class="button-action style2">
                                    <span>Mua ngay</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col col-12">
                        <div class="col-inner text-center">
                            <p class="label-bottom" style="color: #333333;">Hãy đăng ký nhận voucher quà 8/3 để được giảm trực tiếp 1 triệu trên mỗi đơn hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-inner text-center container">
            <img class="lazyload d-none d-md-block" style="padding: 30px 0 60px;" data-src="{{url("/landing/nhanqua/footer-top.png")}}" src="{{url("/landing/nhanqua/footer-top.png")}}" alt="">
            <img class="lazyload d-md-none" style="padding: 20px 0;" data-src="{{url("/landing/nhanqua/footer-top-mobile.png")}}" src="{{url("/landing/nhanqua/footer-top-mobile.png")}}" alt="">
        </div>
        <img class="lazyload d-none d-md-block" data-src="{{url("/landing/nhanqua/footer-bottom.png")}}" src="{{url("/landing/nhanqua/footer-bottom.png")}}" alt="">
        <img class="lazyload d-md-none" data-src="{{url("/landing/nhanqua/footer-mobile.png")}}" src="{{url("/landing/nhanqua/footer-mobile.png")}}" alt="">
        <div id="buttoninteractive">
        <div class="live-chat">
            <a href="https://www.messenger.com/t/dem.vn" class="items-action messenger">
                <img class=" ls-is-cached lazyloaded" data-src="https://dem.vn/web/image/homepage/messenger.png" src="https://dem.vn/web/image/homepage/messenger.png">
                <div class="title-action">Chat với chúng tôi</div>
            </a>
            <a href="tel:18002095" class="items-action phone">
                <img class=" ls-is-cached lazyloaded" data-src="https://dem.vn/web/image/homepage/callnow.png" src="https://dem.vn/web/image/homepage/callnow.png">
                <div class="title-action"><b>1800 2095</b></div>
            </a>
        </div>
    </div>
    </div>
    @yield('content')
    <script type="text/javascript" src="{{url("web/js/jquery.min.js")}}"></script>
    <script type="text/javascript" src="{{url("web/js/popper.min.js")}}"></script>
    <script type="text/javascript" src="{{url("web/js/bootstrap.min.js")}}"></script>
    <script type="text/javascript" src="{{url("web/js/slick.js")}}"></script>
    <script type="text/javascript" src="{{url("web/lightGallery/js/lightGallery.min.js")}}"></script>
    <script type="text/javascript" src="{{url("web/js/lazysizes.min.js")}}"></script>
    <script type="text/javascript" src="{{url("web/js/js_theme.js")}}"></script>

</html>

<style>
    .bg-section {
        background-image: url("{{url("/landing/nhanqua/BG-1.png")}}");
        padding-bottom: 10px;
    }
    a {
        text-decoration: none;
    }

    img {
        width: 100%;
        height: auto;
    }

    figure {
        margin: 0;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1080px;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
    }

    .section-content.product  .button.success {
        border-radius: 5px;
        width: 100%;
        display: inline-block;
        text-align: center;
        background: linear-gradient( 268.99deg, #6800BE -46.42%, #ed54ff 137.57%);
        color: #fff;
        text-transform: uppercase;
        height: 37px;
        line-height: 37px;
        cursor: pointer;
    }

    .section-content.product .product-name{
        margin-top: 15px;
        font-weight: 600;
        margin-bottom: 0;
    }

    .section-content.product .price{
        font-size: 115%;
        color: #000000;
        margin-bottom: 10px;
        display: inline-block;
        border-bottom: 1px solid #dddd;
        width: 100%;
        padding-bottom: 10px;
    }

    .label-bottom {
        margin-bottom: 0;
        padding-top: 30px;
        font-size: 24px;
    }
    .custom-form {
        background-color: rgb(255, 255, 255);
        padding: 40px 25px 37px 25px;
        margin: 136px 0px 0px 40px;
        border-radius: 12px;
    }

    .custom-form form input {
        box-sizing: border-box;
        border: 1px solid #ddd;
        padding: 0 .75em;
        height: 2.507em;
        font-size: .97em;
        border-radius: 0;
        max-width: 100%;
        width: 100%;
        vertical-align: middle;
        background-color: #fff;
        color: #333;
        box-shadow: inset 0 1px 2px rgb(0 0 0 / 10%);
        transition: color .3s, border .3s, background .3s, opacity .3s;
        margin-bottom: 15px;
    }

    .custom-form form .form-submit {
        color: #fff;
        background-color: #f6a733;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0;
    }
    .section-content.product .title {
        width: 57%;
        margin: 0 auto;
        margin-bottom: 10px;
    }
    @media (min-width: 768px) {
        .section-top.column-left {
            margin-top: 60px;
        }
        .section-content.product .column-left {
            width: 100%;
        }
        .section-content.product .column-left {
            width: 100%;
        }
    }
    @media (max-width: 767px) {
        .section-content.product .title {
            width: 100%;
        }
        .column-left {
            padding-top: 20px;
        }
        .label-bottom {
            padding-top: 20px;
        }
        .custom-form {
            margin: 30px 0;
        }
        .bg-section {
            background-position: center;
        }
    }
    .button-action.style2 {
    color: #6800BE;
    font-size: 18px;
    height: 48px;
    line-height: 44px;
    width: 190px;
    text-align: center;
    border-radius: 10px;
    margin-top: 10px;
    cursor: pointer;
    background: linear-gradient(#6800BE 0%, #E461F3 100%);
    position: relative;
}
.button-action.style2 a {
    color: #6800BE;
}
.button-action.style2:before {
    content: "";
    background: #fff;
    position: absolute;
    left: 2px;
    top: 2px;
    width: calc(100% - 4px);
    height: calc(100% - 4px);
    border-radius: 8px;
    z-index: 1;
}
.button-action.style2 span {
    position: relative;
    z-index: 2;
}
.button-action.style2:hover {
    background: linear-gradient(268.99deg, #6800BE -46.42%, #E461F3 137.57%);
    color: #fff;
}
.button-action.style2:hover a{color:#fff;}
.button-action.style2:hover:before{
    display: none;
}
.section-content.product .item-product .label-product {
    position: absolute;
    top: 10px;
    left: -10px;
    width: 120px;
    height: 26px;
    line-height: 26px;
    z-index: 2;
    text-align: center;
    color: #fff;
    background-repeat: no-repeat
}
.section-content.product .item-product .label-product:before {
    content: "";
    position: absolute;
    bottom: -6px;
    left: 0;
    width: 0;
    height: 0;
    border-top: 6px solid #E2E2E2;
    border-left: 9px solid transparent;
}
.section-content.product .item-product:nth-child(1) .label-product {
    background-image: url(../web/image/homepage/label-product1.svg);
}
.section-content.product .item-product:nth-child(2) .label-product {
    background-image: url(../web/image/homepage/label-product2.svg);
}
.section-content.product .item-product:nth-child(3) .label-product {
    background-image: url(../web/image/homepage/label-product3.svg);
}
.section-content.product .image-product {
    position: relative;
}
.section-content.product .image-product .discount-percent {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 42px;
    height: 42px;
    line-height: 42px;
    text-align: center;
    border-radius: 50%;
    font-size: 15px;
    color: #FFFFFF;
    background: #FF3939;
}
.live-chat {
    position: fixed;
    z-index: 99;
    font-size: 0;
    right: 20px;
    bottom: 70px;
}
.live-chat .items-action, .live-chat .items-action img {
    position: relative;
    display: block;
}
.live-chat .items-action img {
    width: 40px;
    height: 40px;
    margin-bottom: 16px;
    -webkit-transition: width .3s;
    transition: width .3s;
    z-index: 9;
}
.live-chat .items-action .title-action {
    height: 38px;
    line-height: 40px;
    position: absolute;
    z-index: 2;
    right: 24px;
    top: 1px;
    max-width: 0;
    overflow: hidden;
    white-space: nowrap;
    -webkit-transition: max-width .3s ease,padding .3s ease;
    transition: max-width .3s ease,padding .3s ease;
    text-align: right;
    background: #44aa21;
    color: #fff;
    font-size: 15px;
    border-radius: 30px 0 0 30px;
}
.live-chat .items-action .title-action b {
    font-size: 18px;
}
.live-chat .items-action:hover .title-action {
    padding: 0 20px 0 10px;
    max-width: 160px;
    width: 160px;
}
</style>
