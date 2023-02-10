<?php
define( 'THEME_URL', get_stylesheet_directory() );
define( 'CORE', THEME_URL . '/core' );

if ( ! isset( $content_width ) ) {
    $content_width = 1200;
}

//Add Style
function demvn_styles() {
	wp_register_style( 'demvn-style', get_stylesheet_directory_uri() . '/style.css', 'all' );
    wp_enqueue_style( 'demvn-style' );

    wp_enqueue_script( 'js-script', get_stylesheet_directory_uri() . '/assets/js/jquery-3.5.1.min.js', 'all' );
    wp_enqueue_script( 'js-script' );

	wp_enqueue_script( 'demvn-script', get_stylesheet_directory_uri() . '/assets/js/demvn.js', 'all' );
    wp_enqueue_script( 'demvn-script' );

    wp_register_style( 'owlcarousel-style', get_stylesheet_directory_uri() . '/assets/libs/owlcarousel/assets/owl.carousel.min.css', 'all' );
	wp_enqueue_style( 'owlcarousel-style' );

	wp_enqueue_script( 'owlcarousel-script', get_stylesheet_directory_uri() . '/assets/libs/owlcarousel/owl.carousel.min.js', 'all' );
    wp_enqueue_script( 'owlcarousel-script' );
}
add_action( 'wp_enqueue_scripts', 'demvn_styles' );

if ( ! function_exists( 'demvn_theme_setup' ) ) {
    function demvn_theme_setup() {
            $language_folder = THEME_URL . '/languages';
            load_theme_textdomain( 'demvn', $language_folder );

            /*
                * Tự chèn RSS Feed links trong <head>
                */
            add_theme_support( 'automatic-feed-links' );

            /*
                * Thêm chức năng post thumbnail
                */
            add_theme_support( 'post-thumbnails' );

            /*
                * Thêm chức năng title-tag để tự thêm <title>
                */
            add_theme_support( 'title-tag' );

            /*
                * Thêm chức năng post format
                */
            add_theme_support( 'post-formats',
                    array(
                            'video',
                            'image',
                            'audio',
                            'gallery'
                    )
                );

            /*
                * Thêm chức năng custom background
                */
            $default_background = array(
                    'default-color' => '#e8e8e8',
            );
            add_theme_support( 'custom-background', $default_background );

    }
    add_action ( 'init', 'demvn_theme_setup' );

}

function new_excerpt_length($length) {
    return 20;
}

add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
    return '... <a href="'. get_permalink() . '" class="read-more">' . ' Xem thêm' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
