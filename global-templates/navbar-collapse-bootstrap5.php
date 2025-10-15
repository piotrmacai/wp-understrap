<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-primary" aria-labelledby="main-nav-label">

	<!--<h2 id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</h2>-->


	<div class="<?php echo esc_attr( $container ); ?>">

		<!-- Your site title as branding in the menu -->
		<?php if ( ! has_custom_logo() ) { ?>

			<?php if ( is_front_page() && is_home() ) : ?>

				<h2 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>/" itemprop="url"><?php bloginfo( 'name' ); ?></a></h2>

			<?php else : ?>

				<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>/" itemprop="url"><?php bloginfo( 'name' ); ?></a>

			<?php endif; ?>

			<?php
		} else {
			?>
			<?php
			the_custom_logo();
		}
		?>
		<div class="order-5" style="">
			<a href="http://localhost/TourEstetica/" class="navbar-brand custom-logo-link order-5" style="" rel="home" aria-current="page"><img class="ue-mark" style="max-width: 300%; margin-right: 5px;" src="/wp-content/uploads/2023/10/logo_UE_rgb-2.jpg" alt=""></a>
		<!-- end custom logo -->
			<button class="navbar-toggler position-relative order-5" style="" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		

		<!-- The WordPress Menu goes here -->
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse desk-only',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary-mobile',
				'container_class' => 'collapse navbar-collapse mobi-only',
				'container_id'    => 'navbarNavDropdownMobile',
				'menu_class'      => 'navbar-nav',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu-mobile',
				'depth'           => 3,
				'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
			)
		);
		?>
	</div><!-- .container(-fluid) -->

</nav><!-- .site-navigation -->
<!-- <div style="position: absolute;
    top: 0;
    right: 0;
    width: 10%;
    transform: translate(0%, 0%);">
	<img src="http://localhost/TourEstetica/wp-content/uploads/2023/10/logo_UE_rgb-2.jpg" alt="">
</div> -->
