<!DOCTYPE html>
<!--[if IE 8]>
<html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if !IE]>
<html <?php language_attributes(); ?>> <![endif]-->

<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <link rel="profile" href="http://gmgp.org/xfn/11"/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5Q55Z8B');</script>
    <!-- End Google Tag Manager -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<style>
    #mini-cart {
        display: none;
    }
</style>
<div class="header-desktop"><?php echo $args["menu_header"] ?? '' ?></div>
<div class="header-mobile"><?php echo $args["menu_mobile_header"]?? '' ?></div>