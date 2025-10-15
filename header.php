<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$bootstrap_version = get_theme_mod('understrap_bootstrap_version', 'bootstrap4');
$navbar_type       = get_theme_mod('understrap_navbar_type', 'collapse');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<?php if (!is_a_bot()) : ?>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-RL2G0WCD9M"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'G-RL2G0WCD9M');
		</script>
	<?php endif; ?>
	<?php wp_head(); ?>

	<style>
		.compareslider::-webkit-slider-thumb {
			width: 20px !important;
			height: 27rem !important;
			background-color: rgba(0, 0, 0, 0.00) !important;
			-webkit-appearance: none;
		}

		.compareslider {
			height: 100% !important;
			display: block !important;
		}

		.image-comparison .photo1 {
			border-right: 1px solid white;
		}

		.image-comparison {
			overflow: hidden;
		}

		.yt-popup {
			z-index: 100000 !important;
		}
	</style>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	<?php do_action('wp_body_open'); ?>
	<div class="site" id="page">
		<!-- ******************* The Navbar Area ******************* -->
		<header id="wrapper-navbar" data-aos="fade-up" class="container-fluid">
			<div class="container">
				<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e('Skip to content', 'understrap'); ?></a>

				<?php get_template_part('global-templates/navbar', $navbar_type . '-' . $bootstrap_version); ?>
			</div>
		</header><!-- #wrapper-navbar end -->
		<div id="mega-menu">
			<div class="mm-sto">
				<div class="mm-col">
					<div class="mm-heading">
						<a href="<?php _e(get_the_permalink(34)); ?>">
							<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu_biala", 34))); ?>
							<?php _e(get_the_title(34)); ?>
						</a>
					</div>
					<div class="mm-links">
						<?php $args = array(
							'posts_per_page' => -1,
							'post_parent'    => 34,
							'post_type'      => 'zabiegi'
						);
						$mmstochildren = get_children($args, ARRAY_N);
						foreach ($mmstochildren as $mmstochild) : ?>
							<a href="<?php _e(get_the_permalink($mmstochild[0])); ?>"><?php _e(get_the_title($mmstochild[0])); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="mm-zab">
				<?php $mmzabiegiarr = [35, 36, 37, 38]; // , 39
				foreach ($mmzabiegiarr as $zabiegid) : ?>
					<div class="mm-col">
						<div class="mm-heading">
							<a href="<?php _e(get_the_permalink($zabiegid)); ?>">
								<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu_biala", $zabiegid))); ?>
								<?php _e(get_the_title($zabiegid)); ?>
							</a>
						</div>
						<div class="mm-links">
							<?php $args = array(
								'posts_per_page' => -1,
								'post_parent'    => $zabiegid,
								'post_type'      => 'zabiegi',
								'orderby'		=>	'menu_order',
								'order'			=>	'ASC'
							);
							$mmstochildren = get_children($args, ARRAY_N);
							foreach ($mmstochildren as $mmstochild) : ?>
								<a href="<?php _e(get_the_permalink($mmstochild[0])); ?>"><?php _e(get_the_title($mmstochild[0])); ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>