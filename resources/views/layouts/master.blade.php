<!doctype html>
<html lang="en">
<head>
    <meta property="og:image" content="{{url("web/image/meta.png")}}" /> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url("web/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("web/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{url("web/css/style.css")}}">
    <link rel="stylesheet" href="{{url("web/css/slick-theme.css")}}">
    <link type="text/css" rel="stylesheet" href="{{url("libs/lightgallery-master/dist/css/lightgallery.min.css")}}"/>
    <link rel="icon" type="image/png" href="{{url("web/image/favicon.png")}}"/>
    {!! SEO::generate() !!}
    @stack('css')
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '{{env("GTM_CODE")}}');
    </script>
</head>

<body>
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id={{env("GTM_CODE")}}"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
{{ Widget::run('menuHeader') }}
@yield('content')
{{ Widget::run('footer') }}
<script type="text/javascript" src="{{url("web/js/jquery.min.js")}}"></script>
<script type="text/javascript" src="{{url("web/js/popper.min.js")}}"></script>
<script type="text/javascript" src="{{url("web/js/bootstrap.min.js")}}"></script>
<script type="text/javascript" src="{{url("web/js/slick.js")}}"></script>
<script type="text/javascript" src="{{url("libs/lightgallery-master/dist/js/lightgallery-all.min.js")}}"></script>
<script type="text/javascript" src="{{url("libs/lightgallery-master/lib/jquery.mousewheel.min.js")}}"></script>
<script type="text/javascript" src="{{url("web/js/lazysizes.min.js")}}"></script>
<script type="text/javascript" src="{{url("web/js/js_theme.js")}}"></script>
<script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
@stack('scripts')
</body>
</html>
