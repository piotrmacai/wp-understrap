<?php

/**
 * Logotypes WS
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$testimonials = get_field('opinie', 'options')
?>


<section class="testimonials" id="opinie">

	<div data-aos="fade-up" class="container-fluid">
		<div class="container">
			<h2 class="centered"><?php _e("Przeczytaj <b>opinie</b>", "websitestyle"); ?></h2>
		</div>
	</div>

	<div data-aos="fade-up" class="container-fluid">
		<div class="container">
			<div data-aos="fade-up" class="container-fluid owl-carousel">
				<?php
				foreach ($testimonials as $testimonial) :

				?>
					<div class="testimonial">
						<div class="testimonial__image-wrap"><?php echo wp_get_attachment_image($testimonial['awatar'], 'full') ?></div>
						<div class="testimonial__google-icon"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="26" viewBox="0 0 28 26">
								<g id="Group_11328" data-name="Group 11328" transform="translate(-326 -76)">
									<g id="Ellipse_32" data-name="Ellipse 32" transform="translate(326 76)" fill="#fff" stroke="#f1f1f1" stroke-width="1">
										<ellipse cx="14" cy="13" rx="14" ry="13" stroke="none" />
										<ellipse cx="14" cy="13" rx="13.5" ry="12.5" fill="none" />
									</g>
									<g id="google" transform="translate(329.559 79)">
										<path id="Path_5602" data-name="Path 5602" d="M276.1,211.479H267.8a.643.643,0,0,0-.664.62v2.476a.643.643,0,0,0,.664.62h4.677a5.957,5.957,0,0,1-2.688,2.939l1.994,3.221a9.227,9.227,0,0,0,5.091-8.147,5.871,5.871,0,0,0-.114-1.217A.656.656,0,0,0,276.1,211.479Z" transform="translate(-256.507 -203.631)" fill="#167ee6" />
										<path id="Path_5603" data-name="Path 5603" d="M43.224,336.741a6.287,6.287,0,0,1-5.36-2.894L34.411,335.7a10.316,10.316,0,0,0,8.813,4.754,10.729,10.729,0,0,0,5.091-1.273v0L46.32,335.96A6.491,6.491,0,0,1,43.224,336.741Z" transform="translate(-33.042 -321.458)" fill="#12b347" />
										<path id="Path_5604" data-name="Path 5604" d="M261.091,394v0l-1.994-3.221a6.491,6.491,0,0,1-3.1.781v3.717A10.729,10.729,0,0,0,261.091,394Z" transform="translate(-245.819 -376.277)" fill="#0f993e" />
										<path id="Path_5605" data-name="Path 5605" d="M3.984,132.865a5.45,5.45,0,0,1,.837-2.889l-3.452-1.857a8.912,8.912,0,0,0,0,9.491l3.452-1.857A5.45,5.45,0,0,1,3.984,132.865Z" transform="translate(0 -123.365)" fill="#ffd500" />
										<path id="Path_5606" data-name="Path 5606" d="M43.224,3.717a6.443,6.443,0,0,1,3.935,1.318A.7.7,0,0,0,48.048,5l1.88-1.754a.6.6,0,0,0-.038-.913A10.583,10.583,0,0,0,43.224,0a10.316,10.316,0,0,0-8.813,4.754l3.452,1.857A6.287,6.287,0,0,1,43.224,3.717Z" transform="translate(-33.042 0)" fill="#ff4b26" />
										<path id="Path_5607" data-name="Path 5607" d="M259.935,5.035a.7.7,0,0,0,.89-.037l1.88-1.754a.6.6,0,0,0-.038-.913A10.582,10.582,0,0,0,256,0V3.717A6.443,6.443,0,0,1,259.935,5.035Z" transform="translate(-245.819)" fill="#d93f21" />
									</g>
								</g>
							</svg>
						</div>
						<p class="testimonial__name"><?php echo $testimonial['imie_i_nazwisko'] ?></p>
						<p class="testimonial__date"><?php echo $testimonial['date'] ?></p>
						<div class="testimonial__stars">
							<svg xmlns="http://www.w3.org/2000/svg" width="109.671" height="17.03" viewBox="0 0 109.671 17.03">
								<g id="stars" transform="translate(-158.254 -159)">
									<path id="star" d="M17.793,6.106l-5.619-.8L9.655.3A.616.616,0,0,0,8.622.3L6.1,5.3l-5.619.8A.524.524,0,0,0,.163,7l4.082,3.9-.965,5.52a.565.565,0,0,0,.84.552l5.019-2.588,5.019,2.589a.565.565,0,0,0,.84-.552l-.965-5.52,4.082-3.9a.525.525,0,0,0-.322-.9Z" transform="translate(158.254 158.981)" fill="#ffc107" />
									<path id="star-2" data-name="star" d="M17.793,6.106l-5.619-.8L9.655.3A.616.616,0,0,0,8.622.3L6.1,5.3l-5.619.8A.524.524,0,0,0,.163,7l4.082,3.9-.965,5.52a.565.565,0,0,0,.84.552l5.019-2.588,5.019,2.589a.565.565,0,0,0,.84-.552l-.965-5.52,4.082-3.9a.525.525,0,0,0-.322-.9Z" transform="translate(181.102 158.981)" fill="#ffc107" />
									<path id="star-3" data-name="star" d="M17.793,6.106l-5.619-.8L9.655.3A.616.616,0,0,0,8.622.3L6.1,5.3l-5.619.8A.524.524,0,0,0,.163,7l4.082,3.9-.965,5.52a.565.565,0,0,0,.84.552l5.019-2.588,5.019,2.589a.565.565,0,0,0,.84-.552l-.965-5.52,4.082-3.9a.525.525,0,0,0-.322-.9Z" transform="translate(203.949 158.981)" fill="#ffc107" />
									<path id="star-4" data-name="star" d="M17.793,6.106l-5.619-.8L9.655.3A.616.616,0,0,0,8.622.3L6.1,5.3l-5.619.8A.524.524,0,0,0,.163,7l4.082,3.9-.965,5.52a.565.565,0,0,0,.84.552l5.019-2.588,5.019,2.589a.565.565,0,0,0,.84-.552l-.965-5.52,4.082-3.9a.525.525,0,0,0-.322-.9Z" transform="translate(226.797 158.981)" fill="#ffc107" />
									<path id="star-5" data-name="star" d="M17.793,6.106l-5.619-.8L9.655.3A.616.616,0,0,0,8.622.3L6.1,5.3l-5.619.8A.524.524,0,0,0,.163,7l4.082,3.9-.965,5.52a.565.565,0,0,0,.84.552l5.019-2.588,5.019,2.589a.565.565,0,0,0,.84-.552l-.965-5.52,4.082-3.9a.525.525,0,0,0-.322-.9Z" transform="translate(249.646 158.981)" fill="#ffc107" />
								</g>
							</svg>
						</div>
						<p class="testimonial__text"><?php echo $testimonial['tekst'] ?></p>
						<?php
						if ($testimonial['tekst_wiecej']) : ?>
							<p class="testimonial__text-more"><?php echo $testimonial['tekst_wiecej'] ?></p>
							<p class="testimonial__text-read-more">Rozwiń</p>
						<?php endif; ?>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>

</section>
<script type="text/javascript">
	jQuery(function($) {
		$('.testimonials .owl-carousel').owlCarousel({
			loop: true,
			margin: 30,
			items: 3, // Default number of items
			autoplay: true,
			autoplayTimeout: 7000,
			autoplayHoverPause: true,
			smartSpeed: 1000,
			dots: false,
			nav: true,
			responsive: {
				0: {
					items: 1, // Show 1 slide on small screens (mobile)

				},
				600: {
					items: 2, // Show 2 slides on medium screens (tablets)
				},
				1000: {
					items: 3 // Show 3 slides on large screens (desktop)
				}
			}
		});

		// JavaScript for toggling "Read More" section
		$('.testimonial__text-read-more').click(function() {
			// Toggle the "text-more" visibility
			$(this).siblings('.testimonial__text-more').slideToggle();

			// Update the text of the button
			if ($(this).text() === 'Rozwiń') {
				$(this).text('Zwiń');
			} else {
				$(this).text('Rozwiń');
			}
		});
	});
</script>

<?php
