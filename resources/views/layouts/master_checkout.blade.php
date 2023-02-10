<!doctype html>
<html lang="en">
<head>
  <title>Dem.vn - Website thương mại điện tử tiên phong về mua sắm online đệm và phụ kiện tại Việt Nam.</title>
  <meta property="og:image" content="{{url("web/image/meta.png")}}" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="facebook-domain-verification" content="ob9853b0n0qgy95qkvoz2oeux4tqsq" />
  {!! SEO::generate() !!}
  <link rel="stylesheet" href="{{url("web/css/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{url("web/css/payment.css")}}">
  <link rel="stylesheet" href="{{url('web/css/font-awesome.min.css')}}">
  <link rel="icon" type="image/png" href="{{url("web/image/favicon.png")}}" />
  @stack('css')

  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime()
        , event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0]
        , j = d.createElement(s)
        , dl = l != 'dataLayer' ? '&l=' + l : ''
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-5Q55Z8B');

  </script>
</head>
<body>
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5Q55Z8B" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <div class="wrapper">
    {{ Widget::run('checkoutHeader') }}
    @yield('content')
    {{ Widget::run('checkoutFooter') }}
  </div>
  <script src="{{url('web/js/lazysizes.min.js')}}"></script>
  <script src="{{url('web/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{url('web/js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('web/js/slick.js')}}"></script>
  <script type="text/javascript" src="{{url('web/js/js_theme.js')}}"></script>
  <script src="{{url('web/js/popper.min.js')}}" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script type="text/javascript" src="{{url('web/js/bootstrap.min.js')}}"></script>
  @stack('scripts')
</body>
</html>

