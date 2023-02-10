<?php
/**
 * The template for displaying all pages.
 *
 * @package flatsome
 */

$args = array(
    'timeout' => 5,
    'sslverify' => false,
);
$response = wp_remote_get("https://dem.vn/wp/menu-header", $args);
$response = json_decode(wp_remote_retrieve_body($response), true);

if(flatsome_option('pages_template') != 'default') {
	
	// Get default template from theme options.
	get_template_part('page', flatsome_option('pages_template'));
	return;

} else {

get_header(null, [
    "menu_header" => $response["data"]["header"] ?? [],
    "menu_mobile_header" => $response["data"]["mobile_header"] ?? []
]);
do_action( 'flatsome_before_page' ); ?>
<div id="content" class="content-area page-wrapper" role="main">
	<div class="row row-main">
		<div class="large-12 col">
			<div class="col-inner">
				
				<?php if(get_theme_mod('default_title', 0)){ ?>
				<header class="entry-header">
					<h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
				</header>
				<?php } ?>

				<?php while ( have_posts() ) : the_post(); ?>
					<?php do_action( 'flatsome_before_page_content' ); ?>
					
						<?php the_content(); ?>

						<?php if ( comments_open() || '0' != get_comments_number() ){
							comments_template(); } ?>

					<?php do_action( 'flatsome_after_page_content' ); ?>
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
	</div>
</div>

<?php
do_action( 'flatsome_after_page' );
get_footer(null, ["html_footer" => $response["data"]["footer"] ?? []]);


}

?>