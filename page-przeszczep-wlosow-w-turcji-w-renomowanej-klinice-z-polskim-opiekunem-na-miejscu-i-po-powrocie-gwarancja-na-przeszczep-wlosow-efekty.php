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
$argsallExe = array(
	'post_type'     =>  'zabiegi',
	'post_status'   =>  'publish',
	'post_parent'   =>  0,
	'posts_per_page'    =>  -1,
	'order_by'      =>  'menu_order',
	'order'         =>  'ASC'
);
$allExertions = new WP_Query($argsallExe); ?>
<div class="wrapper" id="frontPage">
	<section class="metamorphosis">
		<div data-aos="fade-up" class="container-fluid gold">
			<div class="container">
				<h1><?php _e("Zobacz <b>metamorfozy</b>", "websitestyle"); ?></h1>
				<!-- <div class="exertions-list owl-carousel">
                    <?php if ($allExertions->have_posts()) :
						$ei = 0;
						while ($allExertions->have_posts()) : $allExertions->the_post(); ?>
                            <div class="exertion-nav" data-changeexertion="<?php _e($post->ID); ?>" data-position="<?php _e($ei); ?>">
                                <?php _e(wp_get_attachment_image(get_field("ikona_zabiegu_biala", $post->ID), 'full-size', '', array('class' => 'white'))); ?>
                                <?php _e(wp_get_attachment_image(get_field("ikona_zabiegu", $post->ID), 'full-size', '', array('class' => 'dark'))); ?>
                                <p><?php _e(get_the_title($post->ID)); ?></p>
                            </div>
                    <?php $ei++;
						endwhile;
					endif; ?>
                </div> -->
			</div>
		</div>
		<div data-aos="fade-up" class="container-fluid">
			<div class="container">
				<div class="metamorphosis-contents">
					<?php $ija = 0;
					if ($allExertions->have_posts()) :
						while ($allExertions->have_posts()) : $allExertions->the_post(); ?>
							<div class="metamorphosis-content show" data-changeexertion="<?php _e($post->ID); ?>">
								<?php if (have_rows("metamorfozy", $post->ID)) : ?>
									<?php $i = 0;
									while (have_rows("metamorfozy", $post->ID)) : the_row(); ?>
										<div class="example-transformation">
											<?php if (NULL !== get_sub_field("zdjecie_2") && !empty(get_sub_field("zdjecie_2"))) : ?>
												<div class="image-comparison">
													<div class="icimg photo1" style="background-image:url(<?php _e(get_sub_field("zdjecie_1")); ?>);"></div>
													<div class="icimg photo2" style="background-image:url(<?php _e(get_sub_field("zdjecie_2")); ?>);"></div>
													<input type="range" min="1" max="1000" value="500" class="compareslider" name='compareslider' id="slider<?php _e($i); ?>">
													<div class='slider-button'></div>
												</div>
											<?php else : ?>
												<div class="image-comparison">
													<?php _e(wp_get_attachment_image(get_sub_field("zdjecie_1"), 'full-size', '', array('class' => 'photo1'))); ?>
												</div>
											<?php endif; ?>
											<div class="metamorphosis-info">
												<h3><?php _e(get_sub_field("imie")); ?></h3>
												<p class="specs">
													<?php if (get_sub_field("specyfikacja_metamorfozy")) : ?>
														<?php $ijo = 0;
														foreach (get_sub_field("specyfikacja_metamorfozy") as $spec) :
															if ($ijo != 0) {
																_e("<sep></sep>");
															};
															_e($spec['tekst']);
															$ijo++;
														endforeach; ?>
													<?php endif; ?>
												</p>
												<?php if (get_sub_field("opis")) : ?>
													<p class="quote">
														<?php _e(get_sub_field("opis")); ?>
													</p>
												<?php endif; ?>
												<?php if (get_sub_field("galeria")) : ?>
													<div class="gallery-toggle">
														<img class="ddblack" src="<?php _e(get_stylesheet_directory_uri()); ?>/img/dropdown.svg">
														<img class="ddwhite hide" src="<?php _e(get_stylesheet_directory_uri()); ?>/img/dropdownwhite.svg">
														<p class="slideUp<?php $i == 0 ? _e(' show') : _e(' hide'); ?>"><?php _e("Zwiń galerię", "websitestyle"); ?></p>
														<p class="slideDown<?php $i == 0 ? _e(' hide') : _e(' show'); ?>"><?php _e("Rozwiń galerię", "websitestyle"); ?></p>
													</div>
												<?php endif; ?>
											</div>
											<?php if (get_sub_field("galeria")) : ?>
												<div class="container gallery" <?php if ($i > 0) : _e('style="display: none;"');
																				endif; ?>>
													<div class="gallery-heading">
														<h4><?php _e("Galeria", "websitestyle"); ?></h4>
														<div class="separator"></div>
													</div>
													<div class="galler-wrapper owl-carousel">
														<?php foreach (get_sub_field("galeria") as $galimg) : ?>
															<a href="<?php _e(wp_get_attachment_url($galimg, 'full-size')); ?>" data-lightbox="gallery">
																<?php _e(wp_get_attachment_image($galimg, 'full-size')); ?>
															</a>
														<?php endforeach; ?>
													</div>
												</div>
												<script type="text/javascript">
													jQuery(function($) {
														$('.galler-wrapper.owl-carousel').owlCarousel({
															loop: true,
															margin: 25,
															items: 1.3,
															autoplay: false,
															dots: false,
															nav: true,
															responsive: {
																992: {
																	items: 3,
																}
															}
														});
													});
												</script>
											<?php endif; ?>
										</div>
										<script type="text/javascript">
											jQuery(function($) {
												$("#slider<?php _e($i); ?>").on("input change", function(e) {
													const sliderPos = e.target.value / 10;
													$(this).parent().find(".icimg.photo1").css('width', `${sliderPos}%`);
													$(this).parent().find('.slider-button').css('left', `calc(${sliderPos}% - 1.375rem)`)
												});
											})
										</script>
									<?php $i++;
									endwhile; ?>
								<?php endif; ?>
							</div>
					<?php $ija++;
						endwhile;
					endif; ?>
				</div>
			</div>

		</div>
	</section>
	<?php _e(do_shortcode("[wsshortcode_consultationform]")); ?>
</div><!-- #page-wrapper -->
<script type="text/javascript" defer>
	jQuery(function($) {
		$('.exertions-list.owl-carousel').owlCarousel({
			loop: true,
			dots: false,
			nav: true,
			autoplay: false,
			autoWidth: true,
			center: true,
			margin: 13
		});
		$(document).on('click', '.exertions-list.owl-carousel .owl-item>div', function() {
			$thisel = $(this).closest(".exertions-list.owl-carousel");
			$thisel.trigger('to.owl.carousel', $(this).data('position'));
		});
	});
</script>
<?php
get_footer();
