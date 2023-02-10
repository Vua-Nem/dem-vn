<?php
$args = array(
    'timeout' => 5,
    'sslverify' => false,
);
$response = wp_remote_get("https://dem.vn/wp/menu-header", $args);
$response = json_decode(wp_remote_retrieve_body($response), true);
?>
<?php get_header(null, [
        "menu_header" => $response["data"]["header"] ?? [],
        "menu_mobile_header" => $response["data"]["mobile_header"] ?? []
    ]);
?>
<div class="page-detail" id="page-<?php the_ID(); ?>">
    <?php while ( have_posts() ) : the_post();?>
        <div class="section-top-page">
            <div class="container"><h2><?php the_title(); ?></h2></div>
        </div>
        <div class="container">
            <article id="post-<?php the_ID(); ?>">
                <div class="entry-header">
                    <?php the_post_thumbnail(array( 1440, 768 )) ?>
                </div>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(null, ["html_footer" => $response["data"]["footer"] ?? []]); ?>