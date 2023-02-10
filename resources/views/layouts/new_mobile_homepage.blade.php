<!doctype html>
<html lang="en">
<head>
  <title>Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="facebook-domain-verification" content="ob9853b0n0qgy95qkvoz2oeux4tqsq" />
  <link rel="stylesheet" href="{{url("mobile/css/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{url("mobile/css/style1.css")}}">
  <link rel="stylesheet" href="{{url('mobile/css/font-awesome.min.css')}}">
  <link rel="icon" type="image/png" href="{{url("mobile/image/favicon.png")}}" />
  @stack('css')
  {!! SEO::generate() !!}

  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime()
        , event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0]
        , j = d.createElement(s)
        , dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5Q55Z8B');

  </script>
  <!-- End Google Tag Manager -->
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q55Z8B" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="wrapper">
    {{ Widget::run('mobile.menuHeader') }}
    @yield('content')
    {{ Widget::run('mobile.footer') }}
  </div>
  <script src="{{url('mobile/js/lazysizes.min.js')}}"></script>
  <script src="{{url('mobile/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{url('mobile/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('mobile/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{url('mobile/js/js_theme.js')}}"></script>
  <script src="{{url('mobile/js/popper.min.js')}}" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{url('mobile/js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{url("/js/js_ga.js")}}"></script>
  @stack('scripts')
</body>
</html>

