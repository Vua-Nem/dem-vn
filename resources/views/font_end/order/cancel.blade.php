<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.</title>
    <meta property="og:title" content="Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url("web/css/fonts.css")}}">
    <link rel="stylesheet" href="{{url("web/css/style.css")}}">
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
<div class="checkout-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 header-logo">
                <a href="{{route("home")}}">
                    <h1>
                        <img src="{{url("web/image/homepage/logo.svg")}}">
                    </h1>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .header-logo a {
        text-decoration: none;
    }
</style>
<div class="checkout-main page-success">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 content-left">
                <div class="content-sc-top">
                   <img src="{{url("web/image/image-faild.jpg")}}">
                    <h6>Thanh toán thất bại</h6>
                    <p>Vui lòng kiểm tra lại hình thức thanh toán</p>
                    <a href="{{route('home')}}"><span>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.1546e-08 6.00027C6.8982e-08 6.21529 0.0842789 6.43031 0.252091 6.5943L5.53183 11.754C5.86746 12.082 6.41191 12.082 6.74828 11.754C7.08391 11.426 7.08391 10.8939 6.74828 10.5659L2.07639 6.00027L6.74828 1.43461C7.08391 1.10661 7.08391 0.574534 6.74828 0.246541C6.41266 -0.0821812 5.8682 -0.0821812 5.53183 0.246541L0.252091 5.40624C0.0842789 5.57024 7.41101e-08 5.78525 7.1546e-08 6.00027Z" fill="#6800BE"/>
                    </svg>
                    </span> Quay lại trang chủ</a>
                </div>

            </div>

        </div>
    </div>
</div>
<style type="text/css">
    @media  (max-width: 767px) {
         .header-logo h1{text-align: center;}
         .checkout-header{      box-shadow: 0px 4px 4px rgb(210 210 210 / 25%);}
    }
    body .checkout-main.page-success{height:90vh;    display: flex;
    align-items: center;}
    body .checkout-main .container{height: auto;min-height: auto;min-height: inherit;}
    body .content-sc-top{border:none;}
    .content-sc-top h6{font-size: 24px; color: #EB4A4A}
    .content-sc-top a span{margin-right: 10px;}
    .content-sc-top a{ 
        padding: 10px 25px;
        border-radius: 10px;
        display: flex;text-decoration: none;
        border: 1px solid;
        color: #6800BE;
        align-items: center;
        max-width: fit-content;
        width: auto;
        margin: auto;
    }
    .content-sc-top a:hover svg path{fill: #fff;}
    .content-sc-top a:hover {
        border-color: transparent;
        color: #fff;
        background: linear-gradient(268.99deg, #6800BE -46.42%, #E461F3 137.57%);
    }
    .content-sc-top p{font-size: 16px;color:#464646;margin-bottom: 20px;}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>