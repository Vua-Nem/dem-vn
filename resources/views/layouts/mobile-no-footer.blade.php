<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url("mobile/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/style.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/slick-theme.css")}}">
    <link type="text/css" rel="stylesheet" href="{{url("libs/lightgallery-master/dist/css/lightgallery.min.css")}}"/>
    <link rel="icon" type="image/png" href="{{url("mobile/image/favicon.png")}}"/>
    {!! SEO::generate() !!}
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
    })(window,document,'script','dataLayer','GTM-5Q55Z8B');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q55Z8B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
{{ Widget::run('mobile.menuHeader') }}
@yield('content')
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
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:2217031,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<script type="text/javascript" src="https://a.omappapi.com/app/js/api.min.js" data-account="91740" data-user="81554" async></script>
</body>
</html>
