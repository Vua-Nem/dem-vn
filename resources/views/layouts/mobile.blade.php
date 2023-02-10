<!doctype html>
<html lang="en">
<head>
    <meta property="og:image" content="https://ahrefs.com/blog/wp-content/uploads/2020/01/fb-open-graph-1.jpg" />
    <title>Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.</title>
    <meta property="og:title" content="Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url("mobile/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/style.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/slick-theme.css")}}">
    <link type="text/css" rel="stylesheet" href="{{url("libs/lightgallery-master/dist/css/lightgallery.min.css")}}"/>
    <link rel="icon" type="image/png" href="{{url("mobile/image/favicon.png")}}"/>
    <!-- <script async src="https://www.googletagmanager.com/gtm/js?id=GTM-5Q55Z8B"></script> -->
    <!-- <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GTM-5Q55Z8B');
    </script> -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{env("GTM_CODE")}}');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{env("GTM_CODE")}}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
{{ Widget::run('mobile.menuHeader') }}
@yield('content')
{{ Widget::run('footer') }}
<script type="text/javascript" src="{{url("mobile/js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/popper.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/slick.js")}}"></script>
<script type="text/javascript" src="{{url("libs/lightgallery-master/dist/js/lightgallery-all.min.js")}}"></script>
<script type="text/javascript" src="{{url("libs/lightgallery-master/lib/jquery.mousewheel.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/lazysizes.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/js_theme.js")}}"></script>
<script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
@stack('scripts')
</body>
</html>
