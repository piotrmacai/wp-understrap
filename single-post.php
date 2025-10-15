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
?>
<div class="wrapper" id="frontPage">
	<section class="baner blog-post">
		<div data-aos="fade-up" class="container-fluid aos-init aos-animate">
			<div class="slide ">
				<img class="bg" width="1920" height="724" src="<?php echo get_the_post_thumbnail_url() ?>">
				<div class="overlay"></div>
				<div class="slide-contents-wrapper">
					<h1><?php echo get_the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>
	<section class="blog-post-content">
		<div data-aos="fade-up" class="container-fluid">
			<div class="container">
				<div class="gutenberg-content">
					<?php
					// Start the loop
					if (have_posts()) :
						while (have_posts()) : the_post();
							the_content(); // This will display the content from the Gutenberg editor
						endwhile;
					endif;
					?>
				</div>
			</div>
		</div>
	</section>


</div>
<?php
get_footer();
