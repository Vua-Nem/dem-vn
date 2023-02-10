<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="facebook-domain-verification" content="ob9853b0n0qgy95qkvoz2oeux4tqsq" />
    <link rel="stylesheet" href="{{url("mobile/css/style.css")}}">
    <link rel="stylesheet" href="{{url("mobile/css/slick-theme.css")}}">
    <link rel="icon" type="image/png" href="{{url("mobile/image/favicon.png")}}"/>
    {!! SEO::generate() !!}
   
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
{{ Widget::run('footer') }}
<script type="text/javascript" src="{{url("mobile/js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/popper.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/slick.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/lazysizes.min.js")}}"></script>
<script type="text/javascript" src="{{url("mobile/js/js_theme.js")}}"></script>
<script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
@stack('scripts')
</body>
</html>
