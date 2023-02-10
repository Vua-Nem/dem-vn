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
<?php 

    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }

    $args = array(
        'post_status' => 'publish',
        'post_type'=> 'post',
        'orderby'    => 'ID',
        'order'    => 'DESC',
        'paged' => $paged,
        'posts_per_page' => get_option('posts_per_page'),
    );
    $query = new WP_Query($args);
?>
<div class="main-page page-blog">
    <div class="section-top-page">
        <h2>Ngủ ngon, sống khoẻ</h2>
    </div>
    <div class="container">
        <div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-md-4 col-12">
                <div class="blog-items">
                    <div class="image">
                        <a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail(array(361, 203)) ?></a>
                    </div>
                    <div class="blog-content">
                        <h3><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h3>
                        <div class="rte">
                            <?php the_excerpt(); ?> 
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
                wp_reset_postdata(); 
            ?>
            
            <div class="col-sm-12">
                <div class="pagination">
                    <?php echo paginate_links(array(
                        'prev_text'    => __('<'),
                        'next_text'    => __('>')
                    )); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(null, ["html_footer" => $response["data"]["footer"] ?? []]); ?>