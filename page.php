<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="frontPage">
    <?php if (!empty(get_the_content()) && get_field("sekcje")) : ?>
        <section class="ws-content-page">
            <div data-aos="fade-up" class="container-fluid">
                <h1 class="page-content-heading"><?php _e(get_the_title()); ?></h1>
                <div class="container">
                    <div class="ws-page-content">
                        <?php _e(get_the_content()); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <?php get_template_part('global-templates/ws-page-loop'); ?>
</div><!-- #page-wrapper -->
<?php
get_footer();
