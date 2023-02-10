<?php
define( 'THEME_URL', get_stylesheet_directory() );
define( 'CORE', THEME_URL . '/core' );

if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

//Add Style
function demvn_styles() {
    wp_enqueue_script( 'js-script', get_stylesheet_directory_uri() . '/assets/js/jquery-3.5.1.min.js', 'all' );
    wp_enqueue_script( 'js-script' );

	wp_enqueue_script( 'demvn-script', get_stylesheet_directory_uri() . '/assets/js/demvn.js', 'all' );
    wp_enqueue_script( 'demvn-script' );

    wp_register_style( 'owlcarousel-style', get_stylesheet_directory_uri() . '/assets/libs/owlcarousel/assets/owl.carousel.min.css', 'all' );
	wp_enqueue_style( 'owlcarousel-style' );

	wp_enqueue_script( 'owlcarousel-script', get_stylesheet_directory_uri() . '/assets/libs/owlcarousel/owl.carousel.min.js', 'all' );
    wp_enqueue_script( 'owlcarousel-script' );

    wp_register_style( 'demvn-style', get_stylesheet_directory_uri() . '/style.css', 'all' );
    wp_enqueue_style( 'demvn-style' );
}
add_action( 'wp_enqueue_scripts', 'demvn_styles' );

function new_excerpt_length($length) {
    return 20;
}

add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
    return '... <a href="'. get_permalink() . '" class="read-more">' . ' Xem thêm' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
