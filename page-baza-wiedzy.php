<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page    = 8;
$args = array(
    'post_type'    =>    'post',
    'post_status'    =>    'publish',
    'posts_per_page'    =>  $posts_per_page,
    'paged' =>  $paged
);
$blogposts = new WP_Query($args);
$totalpages = $blogposts->max_num_pages;
$row                = 0;
$total              = $blogposts->post_count;
$big = 99999999999;
?>

<div class="wrapper" id="frontPage">
    <?php get_template_part('global-templates/ws-page-loop'); ?>
    <section class="bbr-blog">
        <div data-aos="fade-up" class="container-fluid">
            <div class="container" id="bbrBlogWrapper">
                <?php if ($blogposts->have_posts()) :
                    while ($blogposts->have_posts()) : $blogposts->the_post();
                        $row++;
                        if ($row == 3) {
                            _e(do_shortcode("[ws_newsletter_display]"));
                        }; ?>
                        <?php get_template_part('global-templates/ws-blogpost'); ?>
                <?php endwhile;
                endif; ?>
            </div>
            <div class="container bbrpagination">
                <?php echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '/page/%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $totalpages,
                    'prev_text' => '<prev></prev>',
                    'next_text' => '<next></next>',
                )); ?>
            </div>
        </div>
    </section>
    <?php _e(do_shortcode("[ws_recentposts_display]")); ?>
    <?php _e(do_shortcode("[ws_shopinfo_display]")); ?>
    <?php _e(do_shortcode("[ws_operatoricons_display]")); ?>
</div><!-- #page-wrapper -->
<?php
get_footer();
