<!doctype html>
<html lang="en">
<head>
    <title>Đăng ký nhận voucher 1 triệu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url("web/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("web/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("web/css/style.css")}}">
    <link rel="stylesheet" href="{{url("web/css/slick-theme.css")}}">
    <link type="text/css" rel="stylesheet" href="{{url("mobile/lightGallery/css/lightGallery.min.css")}}"/>
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
        <div class="container">
            <figure class="block-image size-large">
                <img class="lazyload" width="1025" height="186" data-src="{{url("/landing/dang-ky/text.png")}}"
                     src="{{url("/landing/dang-ky/text.png")}}" alt="">
            </figure>
            <p class="text-header">
                <span style="color: #ffffff;">Dem.vn đã trở lại với 1 diện mạo hoàn toàn mới cùng phần quà cực chất dành tặng bạn:</span><br>
                <span style="color: #ffffff;">“Voucher GIẢM <span style="color: #ffff00;">1,000,000VNĐ</span> cho đơn hàng mua đệm trên website <span
                            style="color: #ffff00;">www.dem.vn</span>”</span>
            </p>
            <div class="form-content">
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <figure class="-block-image size-large"><img class="lazyload" width="961" height="563"
                                                                    data-src="{{url("/landing/dang-ky/hinh.png")}}"
                                                                    src="{{url("/landing/dang-ky/hinh.png")}}" alt="">
                        </figure>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="custom-form">
                            <figure class="-block-image size-large"><img class="lazyload" width="450" height="136"
                                                                        data-src="{{url("/landing/dang-ky/logo.png")}}"
                                                                        src="{{url("/landing/dang-ky/logo.png")}}" alt="">
                            </figure>
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
                                    <input type="hidden" name="campain" value="DEMVNLAUNCHING" id="campain">
                                    <div class="form-lp">
                                        <input type="submit" value="Đăng kí ngay" class="form-submit">
                                    </div>
                                    @if(Session::has('success'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                            {{ Session::get('success') }}
                                        </p>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p style="text-align: center; margin-bottom: 0;; padding-bottom:30px;"><span
                        style="font-size: 130%;"><strong><span style="color: #ffffff;"><em>Voucher có giá trị sử dụng đến hết ngày 31/3/2021.</em><br><em>Lưu ý: Voucher được sử dụng 1 lần duy nhất và trừ trực tiếp vào giá đơn hàng.</em> </span></strong></span>
            </p>
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
    img {
        max-width: 100%;
        height: auto;
    }

    figure {
        margin: 0;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1140px;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
    }

    body {

    }

    .block-columns {
        display: flex;
        margin-bottom: 1.75em;
        flex-wrap: wrap;
    }

    .block-column {
        flex-grow: 1;
        min-width: 0;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    @media (min-width: 782px) {
        .block-columns {
            flex-wrap: nowrap;
        }

        .block-column[style*=flex-basis] {
            flex-grow: 0;
        }
    }

    .background-landing {
        background-image: url("{{url("/landing/dang-ky/BG.png")}}");
        text-align: center;
    }

    .custom-form {
        background-color: rgb(255, 255, 255);
        padding: 22px 0px 18px;
        border-radius: 6px;
        opacity: 0.98;
        width: 320px;
    }

    .custom-form form {
        padding: 20px 25px 20px 25px;
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
    .text-header {
        text-align: center;
        font-size: 24px;
        margin-top: 30px;
    }
    .form-content {
        margin-top: 90px;
        margin-bottom: 0;
    }
    @media (max-width: 767px) {
        .form-content {
            margin-top: 30px;
            margin-bottom: 30px;
        }
        .text-header {
            font-size: 18px;
        }
        .custom-form {
            width: 100%;
            margin-top: 20px;
        }
    }
</style>