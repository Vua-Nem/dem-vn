<?php
/*
Template name: Page - No Header / No Footer
*/
?>
<!DOCTYPE html>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5Q55Z8B');</script>
    <!-- End Google Tag Manager -->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action('flatsome_before_page' ); ?>
<?php do_action('flatsome_after_header'); ?>
<div id="wrapper">

	<div id="main" class="<?php flatsome_main_classes();  ?>">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; // end of the loop. ?>

	</div>

</div>
<?php do_action( 'flatsome_after_page' ); ?>

<?php wp_footer(); ?>
</body>
</html>
