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

$container = get_theme_mod('understrap_container_type'); ?>
<div class="wrapper" id="frontPage">
	<section class="contact">
		<div data-aos="fade-up" class="container-fluid gold">
			<div class="container">
				<h1 class="centered"><?php _e(get_field("naglowek")); ?></h1>
				<p class="centered"><?php _e(get_field("tekst")); ?></p>
				<div class="contact-blocks">
					<div class="contact-block">
						<?php $bl = get_field("blok_1"); ?>
						<?php _e(wp_get_attachment_image($bl['ikona'], 'full-size', '', array('class' => 'icon'))); ?>
						<h5><?php _e($bl['naglowek']); ?></h5>
						<p><?php _e($bl['tekst']); ?></p>
						<?php if ($bl['dodatkowe_dane'] == 'zabiegi') : ?>
							<div class="buttons">
								<a href="/darmowa-konsultacja/" class="button navy arrow"><?php _e("Zobacz zabiegi", "websitestyle"); ?></a>
							</div>
						<?php elseif ($bl['dodatkowe_dane'] == 'contact') : ?>
							<div class="contact-data">
								<a class="phone" href="tel: <?php _e(get_field("numer_telefonu", "options")); ?>"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftphone.svg"><?php _e(get_field("numer_telefonu", "options")); ?></a>
								<a class="mail" href="mailto: <?php _e(get_field("adres_e-mail", "options")); ?>"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftemail.svg"><?php _e(get_field("adres_e-mail", "options")); ?></a>
							</div>
						<?php elseif ($bl['dodatkowe_dane'] == 'address') : ?>
							<p><?php _e(get_field("dane_adresowe", "options")); ?></p>
							<?php if (get_field("odnosnik_google_maps", "options")) : ?>
								<div class="googlemaps-wrapper">
									<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/google-maps.svg"> <a target="_blank" follow="nofollow" href="<?php _e(get_field("odnosnik_google_maps", "options")); ?>">Google Maps</a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="contact-block">
						<?php $bl = get_field("blok_2"); ?>
						<?php _e(wp_get_attachment_image($bl['ikona'], 'full-size', '', array('class' => 'icon'))); ?>
						<h5><?php _e($bl['naglowek']); ?></h5>
						<p><?php _e($bl['tekst']); ?></p>
						<?php if ($bl['dodatkowe_dane'] == 'zabiegi') : ?>
							<div class="buttons">
								<a href="/darmowa-konsultacja/" class="button navy arrow"><?php _e("Zobacz zabiegi", "websitestyle"); ?></a>
							</div>
						<?php elseif ($bl['dodatkowe_dane'] == 'contact') : ?>
							<div class="contact-data">
								<a class="phone" href="tel: <?php _e(get_field("numer_telefonu", "options")); ?>"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftphone.svg"><?php _e(get_field("numer_telefonu", "options")); ?></a>
								<a class="mail" href="mailto: <?php _e(get_field("adres_e-mail", "options")); ?>"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftemail.svg"><?php _e(get_field("adres_e-mail", "options")); ?></a>
							</div>
						<?php elseif ($bl['dodatkowe_dane'] == 'address') : ?>
							<p><?php _e(get_field("dane_adresowe", "options")); ?></p>
							<?php if (get_field("odnosnik_google_maps", "options")) : ?>
								<div class="googlemaps-wrapper">
									<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/google-maps.svg"> <a target="_blank" follow="nofollow" href="<?php _e(get_field("odnosnik_google_maps", "options")); ?>">Google Maps</a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="contact-block">
						<?php $bl = get_field("blok_3"); ?>
						<?php _e(wp_get_attachment_image($bl['ikona'], 'full-size', '', array('class' => 'icon'))); ?>
						<h5><?php _e($bl['naglowek']); ?></h5>
						<?php if (isset($bl['tekst']) && !empty($bl['tekst'])) : ?>
							<p><?php _e($bl['tekst']); ?></p>
						<?php endif; ?>
						<?php if ($bl['dodatkowe_dane'] == 'zabiegi') : ?>
							<div class="buttons">
								<a href="/darmowa-konsultacja/" class="button navy arrow"><?php _e("Zobacz zabiegi", "websitestyle"); ?></a>
							</div>
						<?php elseif ($bl['dodatkowe_dane'] == 'contact') : ?>
							<div class="contact-data">
								<a class="phone" href="tel: <?php _e(get_field("numer_telefonu", "options")); ?>"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftphone.svg"><?php _e(get_field("numer_telefonu", "options")); ?></a>
								<a class="mail" href="mailto: <?php _e(get_field("adres_e-mail", "options")); ?>"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftemail.svg"><?php _e(get_field("adres_e-mail", "options")); ?></a>
							</div>
						<?php elseif ($bl['dodatkowe_dane'] == 'address') : ?>
							<p><?php _e(get_field("dane_adresowe", "options")); ?></p>
							<?php if (get_field("odnosnik_google_maps", "options")) : ?>
								<div class="googlemaps-wrapper">
									<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/google-maps-white.svg"> <a target="_blank" follow="nofollow" href="<?php _e(get_field("odnosnik_google_maps", "options")); ?>">Google Maps</a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="consultationform">
		<?php _e(do_shortcode("[wsshortcode_consultationform]")); ?>
	</section>
</div><!-- #page-wrapper -->
<?php
get_footer();
