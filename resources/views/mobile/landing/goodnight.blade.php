<!doctype html>
<html lang="en">
<head>
    <title>Mừng thống nhất - sales ngây ngất - Giảm đến 1 triệu</title>
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
            <img class="lazyload" src="{{url("/mobile/image/top-top-banner.jpg")}}" alt="">
            <div class="bg-section" style="margin-top: -1px;">
                <div class="containers">
                    <div class="row">
                        <div class="col-sm-12 col-md-7 section-top column-left">
                        </div>
                        <div class="col-sm-12 col-md-4 column-right">
                            <div class="custom-form">
                                <p class="alt-font" style="text-align: center; margin-bottom: 0;"><span style="color: #db2c2c;"><span style="font-size: 20px;">Nhận thêm</span></span></p>
                                <h2  style="text-align: center; margin-bottom: 0;color:#e12c30;font-size: 46px;">200.000đ</h2>
                                <p class=" alt-font" style="text-align: center;"><span style="color: #2d2e7f;font-size: 16px">cho 100 người đăng kí sớm nhất </p>
                                <div role="form" class="cf7" id="cf7-f361-p320-o1" lang="en-US" dir="ltr">
                                    <form action="{{route("landing.postIndex")}}" method="post">
                                        {{csrf_field()}}
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
                                      
                                 
                                    <input type="hidden" name="campain" value="8-3" id="campain">
                                    <div class="form-lp" style="text-align: center;"> 
                                        <input type="submit" value="Đăng kí ngay" class="form-submit">
                                    </div>
                                    @if(Session::has('success'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">
                                            {{ Session::get('success') }} Mã giảm giá của bạn: 200k
                                        </p>
                                        @endif
                                    </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <img class="lazyload" src="{{url("/mobile/image/bottom-top-banner.jpg")}}" alt="" style="margin-top: -1px;">
        </div>
        <div class="main-image">  <div class="containers" style="text-align: center; "> <img class="lazyload" src="{{url("/mobile/image/block-main-bm.jpg")}}" alt=""></div></div>
      
      <?php $a = 1; ?>
    <div class="section-testimonial section-homepage">
        <h2 class="title-section">Reviews sản phẩm</h2>
        <div class="text-center star-rating">
           Đánh giá của khách hàng về đệm Foam Goodnight Massage Nhật Bản
        </div>
        <div class="content-section">
            <div id="testimonialCarousel" class="review-section" >
                @foreach($reviews as $review)
                <div class="review-items">
                    <div class="feedback-customer">
                        <div class="customer-name">{{ $review->getUser->name }}</div>
                        <p>"{{$review->content}} "</p>
                    </div>
                    <div class="col-right">
                        @isset($review->reviewImage)
                        <div class="image image-review" data-index="{{$a}}" style="background: url('{{url("image/reviews/" .$review->id ."/" . $review->reviewImage->file_name)}}')"></div>
                        @endisset
                        <div class="content-title">
                            <div class="title">{{ $review->getProduct->name}}</div>
                        </div>
                    </div>
                </div>
                <?php $a++; ?>
                @endforeach
                </div>
            </div>
        </div>
        <div class="main-images"  style="text-align: center; ">  <img class="lazyload" src="{{url("/mobile/image/block-main-bm2.jpg")}}" alt=""></div>
        <div class="section-content product" style="padding-top: 50px; padding-bottom: 30px; background: #faf9ff">
            <div class="container">
                <div class="col-inner text-center">
                    <div class="title-section " style="padding-bottom: 30px;">
                        Các sản phẩm khác
                    </div>
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
                                    <span class="price"><span style="color: #6800BE;">2,160,000 đ </span> <del style="color: #8D8D8D;">(2,400,000 đ)</del></span>
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
                                    <span class="price"><span style="color: #6800BE;">3,315,000 đ </span> <del style="color: #8D8D8D;">(3,900,000 đ)</del></span>
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
                                    <span class="price"><span style="color: #6800BE;">4,845,000 đ </span> <del style="color: #8D8D8D;">(5,700,000 đ)</del></span>
                                </p>
                                <div class="button-action style2">
                                    <span>Mua ngay</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
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
    .alert-info{    margin-top: 10px;
    margin-bottom: 0;
    padding: 5px;}
.review-items .image {
    margin-bottom: 0px;
    text-align: center;
    width: 100%;
} 
.section-slide-testimonial .slick-arrow {
    display: none !important;
}
.section-slide-testimonial .image {
    margin-bottom: 30px;
    text-align: center;
    width: 100%;
} 
.slick-dots li button {
    font-size: 0;
    border: none;
    background: none;
    height: 16px;
    width: 16px;
    border-radius: 50%;
    border: 1px solid #717171;
}

.slick-dots li.slick-active button {
    background: #6800BE;
    border-color: #6800BE;
}

.slick-dots {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.slick-dots li {
    margin: 0 5px;list-style: none;
}

.slick-slide {
    padding: 0 15px;
}
    .product img{width: 100%;}
.review-items .image{
    max-width: 100px;
    margin-right: 15px;
    margin-bottom: 0;
    min-height: 100px;
    align-items: flex-end;
    display: flex;
    background-size: cover !important;
    background-position: bottom !important;
    border-radius: 4px;
}
.section-testimonial {
    background: linear-gradient(180deg, #FAF9FF 0%, #FAF9FF 100%);
    padding-top: 50px;
    padding-bottom: 50px;
    margin-bottom: 0;
}
.review-items .col-right {display: flex;color: #000F40;font-size: 16px;align-items: flex-end;}
.feedback-customer{font-size: 18px;color: #000F40;}
.feedback-customer p{    font-weight: 500;
    padding-top: 10px;
    height: 120px;
    position: relative;
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    -webkit-line-clamp: 4;}
.review-items{ padding:25px;     background: linear-gradient(0deg, #FFFFFF 82.29%, #F7F4FF 100%);
    box-shadow: -6px 7px 0px #f5eaff;}
.section-testimonial .content-section{padding-top: 0px;}
.section-testimonial .slick-slide{padding-bottom: 10px;}

.star-rating {
    margin-bottom: 20px;
}
.title-section {
    font-size: 30px;
    font-weight: 500;
    text-align: center;
    color: #d73233;
}

    .background-landing{position: relative;}
    .custom-form{
    background: #fff;
    max-width: 300px;
    margin-right: auto;
    box-shadow: 0.175px 9.998px 5.52px 0.48px rgb(161 29 31 / 32%);
    margin-left: auto;
    padding: 30px 15px 50px;
    border-radius: 96px 6px;
    }
    .bg-section {
        position: relative;
    background-color: #db2d36;
    bottom: 5%;
    padding-bottom: 10px;
    width: 100%;
    overflow: hidden;
    left: 0;
    }
    a {
        text-decoration: none;
    }

    img {
        height: auto;    max-width: 100%;
    }

    figure {
        margin: 0;
    }

    @media (min-width: 1200px) {
        .container {
      
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
        margin-bottom: 0px;
        display: inline-block;
        width: 100%;
        padding-bottom: 0px;
    }

    .label-bottom {
        margin-bottom: 0;
        padding-top: 30px;
        font-size: 24px;
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
        transition: color .3s, border .3s, background .3s, opacity .3s;
        margin-bottom: 15px;
    }

    .custom-form form .form-submit {
        color: #c7011b;
        background-color: #fee53a;
        border: none;
        font-weight: 600;
        max-width: 90%;border-radius: 6px;
        margin-bottom: 0;
    }
    .section-content.product .title {
        width: 57%;
        margin: 0 auto;
        margin-bottom: 10px;
    }
    @media (min-width: 768px) {
   
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
    left: 0px;
    width: 120px;
    height: 26px;
    line-height: 26px;
    z-index: 2;
    text-align: left;padding-left: 15px;
    color: #fff;
    background-repeat: no-repeat
}
.section-content.product .item-product .label-product:before {

}
.section-content.product .item-product:nth-child(1) .label-product {
    background-image: url(../web/image/homepage/label-product1.svg);
}
.section-content.product .item-product:nth-child(2) .label-product {
    background-image: url(../web/image/homepage/label-product2.svg);    width: 160px;
}
.section-content.product .item-product:nth-child(3) .label-product {
    background-image: url(../web/image/homepage/label-product3.svg);    width: 160px;
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
