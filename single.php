<?php

/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="single-wrapper">
	<div data-aos="fade-up" class="container-fluid">
		<?php
		while (have_posts()) {
			the_post();
			get_template_part('loop-templates/content', 'single');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) {
				comments_template();
			}
		}
		?>
	</div>
</div><!-- #single-wrapper -->

<?php
get_footer();
