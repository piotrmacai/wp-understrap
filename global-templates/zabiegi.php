<?php

/**
 * Logotypes WS
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$sekcje = get_field("sekcje");

foreach ($sekcje as $sekcja) {
	if (isset($sekcja['wybrana_niestandardowa_sekcja']) && $sekcja['wybrana_niestandardowa_sekcja'] == 'zabiegi') {
		$zabiegi_ids =  $sekcja['wybrane_zabiegi'];
		break;
	}
}


$argsallExe = array(
	'post_type' => 'zabiegi',
	'post_status' => 'publish',
	'post_parent' => 0,
	'posts_per_page' => -1,
	'orderby' => 'menu_order',
	'order' => 'ASC',
	'exclude' => [39],
);

// Jeśli $zabiegi_ids jest ustawione i nie jest puste, dodaj je do zapytania
if (!empty($zabiegi_ids)) {
	$argsallExe['post__in'] = $zabiegi_ids;
	$argsallExe['orderby'] = 'post__in'; // Aby zachować kolejność z $zabiegi_ids
}


$allExertions = new WP_Query($argsallExe); ?>
<section class="exertions">
	<div data-aos="fade-up" class="container-fluid gold">
		<div class="container">
			<h2 class="centered"><?php _e("Oferowane <b>zabiegi</b>", "websitestyle"); ?></h2>
			<div class="exertions-list owl-carousel <?php if (count($zabiegi_ids) <= 4) {
														echo 'no-carousel';
													} ?>">
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
			</div>
			<div class="separator"></div>
			<div class="exertions-contents">
				<?php if ($allExertions->have_posts()) :
					while ($allExertions->have_posts()) : $allExertions->the_post();
						$si = get_field("skrocone_informacje", $post->ID); ?>
						<div class="exertion-content" data-changeexertion="<?php _e($post->ID); ?>">
							<div class="img-wrapper">
								<?php _e(wp_get_attachment_image($si['zdjecie'], 'full-size', '', array('class' => 'featuredimg'))); ?>
								<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu", $post->ID), 'full-size', '', array('class' => 'icon'))); ?>
							</div>
							<div class="contents-wrapper ">
								<h3><?php _e(get_the_title($post->ID)); ?></h3>
								<?php if (empty(get_children(array('post_type' => 'zabiegi', 'post_status' => 'publish', 'post_parent' => $post->ID)))) : ?>
									<p><?php _e($si['krotki_opis']); ?></p>
								<?php else : ?>
									<p><?php _e("Oferowane zabiegi:", "websitestyle"); ?></p>
								<?php endif; ?>
								<div class="features">
									<?php if (empty(get_children(array('post_type' => 'zabiegi', 'post_status' => 'publish', 'post_parent' => $post->ID)))) : ?>
										<?php foreach ($si['wyroznione_informacje'] as $shortinfo) : ?>
											<div class="feature">
												<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/check.svg">
												<p><?php _e($shortinfo['tekst']); ?></p>
											</div>
										<?php endforeach; ?>
									<?php else : ?>
										<?php foreach (get_children(array('post_type' => 'zabiegi', 'post_status' => 'publish', 'post_parent' => $post->ID)) as $childexertion) :
											if ($childexertion->post_type == "zabiegi") : ?>
												<div class="feature fullwidth">
													<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/check.svg">
													<p><a href="<?php _e(get_the_permalink($childexertion->ID)); ?>"><?php _e($childexertion->post_title); ?></a></p>
												</div>
										<?php endif;
										endforeach; ?>
									<?php endif; ?>
								</div>
								<div class="buttons">
									<a href="/darmowa-konsultacja?zabieg=<?php _e($post->ID); ?>" class="button orange arrow"><?php _e($si['tekst_przycisku']); ?></a>
									<a href="<?php _e(get_the_permalink($post->ID)); ?>" class="button white arrow"><?php _e("Dowiedz się więcej", "websitestyle"); ?></a>
								</div>
							</div>
							<?php if (have_rows("metamorfozy", $post->ID)) : ?>
								<div class="transformations-heading">
									<h4><?php _e("Metamorfozy", "websitestyle"); ?></h4>
									<div class="separator"></div>
									<a href="<?php echo get_permalink(17) ?>" class="arrow"><?php _e("Zobacz wszystkie", "websitestyle"); ?></a>
								</div>
								<div class="example-transformations">
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
											<p><?php _e(get_sub_field("imie")); ?>
												<?php foreach (get_sub_field("specyfikacja_metamorfozy") as $spec) :
													_e("<sep></sep>" . $spec['tekst']);
												endforeach; ?>
											</p>
										</div>
										<script type="text/javascript">
											jQuery(function($) {
												$("#slider<?php _e($i); ?>").on("input change", function(e) {
													const sliderPos = e.target.value / 10;
													$(this).parent().find(".icimg.photo1").css('width', `${sliderPos}%`);
													if ($(window).width() < 980) {
														$(this).parent().find('.slider-button').css('left', `calc(${sliderPos}% - 1.875rem)`)
													} else {
														$(this).parent().find('.slider-button').css('left', `calc(${sliderPos}% - 1.375rem)`)
													}
												});
											})
										</script>
									<?php $i++;
									endwhile; ?>
								</div>
								<a href="<?php echo get_permalink(17) ?>" class="arrow bottom"><?php _e("Zobacz wszystkie", "websitestyle"); ?></a>

							<?php endif; ?>
						</div>
				<?php endwhile;
				endif; ?>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" defer>
	jQuery(function($) {
		function activateCarousel() {
			var screenWidth = $(window).width();
			var slideCount = $('.exertions-list.owl-carousel .exertion-nav').length;

			var options = {
				loop: true,
				dots: false,
				nav: true,
				autoplay: false,
				autoWidth: false, // Wyłącz autoWidth
				items: 1, // Domyślnie pokazuje tylko 1 slajd
				center: true,
				margin: 13,
				onTranslated: function(event) { // Dodane zdarzenie po zmianie slajdu
					autoClickActiveSlide();
				}
			};

			// Aktywacja karuzeli z odpowiednimi ustawieniami
			if ((screenWidth < 980 && slideCount >= 2) || (screenWidth >= 980 && slideCount > 4)) {
				$('.exertions-list.owl-carousel').owlCarousel(options);
			}
		}

		// Funkcja do automatycznego "kliknięcia" na aktywnym (widocznym) slajdzie
		function autoClickActiveSlide() {
			if ($(window).width() < 980) { // Sprawdzenie dla urządzeń mobilnych
				var activeSlide = $('.exertions-list.owl-carousel .owl-item.active').find('>div'); // Znajdź aktywny slajd
				if (activeSlide.length) {
					activeSlide[0].click(); // Symuluj kliknięcie na aktywnym slajdzie
				}
			}
		}

		activateCarousel();

		$(window).resize(function() {
			activateCarousel(); // Aktualizacja karuzeli przy zmianie rozmiaru okna
		});
	});
</script>


<script type="text/javascript" defer>
	jQuery(function($) {

		$(".exertion-content").first().addClass("show");
		$(".exertion-nav").first().addClass("active");
		$(document).on('click', '.exertions-list.owl-carousel .owl-item>div', function() {
			$thisel = $(this).closest(".exertions-list.owl-carousel");
			$thisel.trigger('to.owl.carousel', $(this).data('position'));
		});
	});
</script>
<?php
