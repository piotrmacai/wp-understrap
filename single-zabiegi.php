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
$slidedata = get_field("dane_do_slidera", get_the_ID());
?>

<div class="wrapper" id="frontPage" x-data="ytIframe('<?php echo str_replace("https://www.youtube.com/embed/", "", $slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>')">
	<div :style="open && 'display:block!important;'" class="yt-popup">
		<div class="popup-nav" @click="close()">
			<p>Zamknij X</p>
		</div>
		<div x-ref="video" class=""></div>
	</div>
	<section class="baner photos">
		<div data-aos="fade-up" class="container-fluid">
			<div class="slide">
				<div class="dis-overlay"></div>
				<?php if (isset($slidedata['zdjecie_w_tle_mobile']) && NULL !== $slidedata['zdjecie_w_tle_mobile']) : ?>
					<?php _e(wp_get_attachment_image($slidedata['zdjecie_w_tle'], 'full-size', '', array('class' => 'bg desk-only'))); ?>
					<?php _e(wp_get_attachment_image($slidedata['zdjecie_w_tle_mobile'], 'full-size', '', array('class' => 'bg mobi-only'))); ?>
				<?php else : ?>
					<?php _e(wp_get_attachment_image($slidedata['zdjecie_w_tle'], 'full-size', '', array('class' => 'bg'))); ?>
				<?php endif; ?>
				<div class="slide-contents-wrapper" style="<?php echo $slidedata['ukryj_poswiate_na_mobile'] ? 'background: unset!important; ' : ''; ?>">
					<?php if (!empty(get_ancestors(get_the_ID(), 'zabiegi'))) :
						$parentid = get_ancestors(get_the_ID(), 'zabiegi')[0]; ?>
						<div class="parent-tag">
							<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu", $parentid), 'full-size', '', array('class' => 'dark'))); ?>
							<p><?php _e(get_the_title($parentid)); ?></p>
						</div>
					<?php endif; ?>
					<h2><?php _e($slidedata['naglowek']); ?></h2>
					<?php if ($slidedata['dopisek']) : ?>
						<p class="description"><?php _e($slidedata['dopisek']); ?></p>
					<?php endif; ?>
					<?php if ($slidedata['cena']) : ?>
						<div class="price"> <img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/check.svg">
							<p><?php _e($slidedata['cena']); ?><span><?php _e($slidedata['cena_skreslona']); ?></span></p>
						</div>
					<?php endif; ?>
					<?php if (isset($slidedata['krotka_oferta']) && (is_array($slidedata['krotka_oferta']) || is_object($slidedata['krotka_oferta'])) && count($slidedata['krotka_oferta']) > 0 && (get_the_ID() == 33 || get_the_ID() == 34)) : ?>
						<div class="features">
							<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/check.svg">
							<p>
								<?php $featurecount = count($slidedata['krotka_oferta']);
								$featurei = 1;
								foreach ($slidedata['krotka_oferta'] as $feature) : ?>
									<?php _e($feature['element_krotkiej_oferty']); ?>
									<?php if ($featurei < $featurecount) {
										_e("<span>|</span>");
									}; ?>
								<?php $featurei++;
								endforeach; ?>
							</p>
						</div>
					<?php endif; ?>
					<div class="buttons">
						<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button orange arrow"> <?php if ($slidedata['tekst_przycisku'] == '') {
																															echo "Darmowa konsultacja";
																														} else {
																															_e($slidedata['tekst_przycisku']);
																														} ?></a>
					</div>
					<?php if (isset($slidedata['odnosnik_do_osadzenia_filmu_yt']) && !empty($slidedata['odnosnik_do_osadzenia_filmu_yt'])) : ?>
						<div class="">
							<div @click="openPopup()" class="video playvidonclick" dis-data-ytlink="<?php _e($slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>">
								<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/play-button.svg">
								<p><?php _e("Zobacz video", "websitestyle"); ?></p>
							</div>
						</div>
						<?php if (!is_a_bot()) : ?>
							<script>
								// var player;
								// function onYouTubePlayerAPIReady() {
								//     player = new YT.Player('ytplayer', {
								//         height: '56.25vw',
								//         width: '100vw',
								//         videoId: '<?php echo str_replace("https://www.youtube.com/embed/", "", $slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>',
								//         events: {
								//             'onStateChange': onPlayerStateChange
								//         }
								//     });
								// }
								// // Load the IFrame Player API code asynchronously.
								// var tag = document.createElement('script');
								// tag.src = "https://www.youtube.com/player_api";
								// var firstScriptTag = document.getElementsByTagName('script')[0];
								// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

								// function onPlayerStateChange(event) {
								//     if (event.data == YT.PlayerState.ENDED) {
								//         player.stopVideo();
								//         jQuery(".yt-popup").fadeOut(500);
								//     }
								// }
								// jQuery(function($) {
								//     jQuery(".playvidonclick").click(function() {
								//         var ytid = '<?php echo str_replace("https://www.youtube.com/embed/", "", $slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>';
								//         player.loadVideoById({
								//             videoId:ytid
								//         })
								//         jQuery(".yt-popup").fadeIn(500);
								//         player.playVideo();
								//     })
								//     jQuery(".play").on('click touch', function(even) {
								//         jQuery(".yt-popup").fadeIn(500);
								//         player.playVideo();
								//     });
								//     jQuery(".popup-nav").on('click touch', function() {
								//         if (jQuery("iframe#ytplayer").length > 0) {
								//             player.stopVideo();
								//         }
								//         jQuery(".yt-popup").fadeOut(500);
								//     })
								// })
							</script>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="social-vertical">
			<div class="inner">
				<?php if (have_rows("social_media", "options")) :
					while (have_rows("social_media", "options")) : the_row(); ?>
						<a href="<?php get_sub_field("odnosnik_do_medium") ? _e(get_sub_field("odnosnik_do_medium")) : false; ?>" class="sociallink" rel="nofollow">
							<?php _e(wp_get_attachment_image(get_sub_field("ikona_medium_czarna"), 'full-size')); ?>
						</a>
				<?php endwhile;
				endif; ?>
				<div class="separator"></div>
				<p><?php _e("Social media", "websitestyle"); ?></p>
			</div>
		</div>
	</section>
	<?php if (get_field("tresci")) :
		foreach (get_field("tresci") as $s) :
			if ($s['acf_fc_layout'] == "blok_zabiegu") : ?>
				<section class="exortion-block">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<div class="exortion-info">
								<div class="img-wrapper">
									<?php echo wp_get_attachment_image($s['zdjecie'], 'full-size'); ?>
								</div>
								<div class="texts-wrapper">
									<h3><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
										endif; ?></h3>
									<p><?php if (isset($s['tekst']) && !empty($s['tekst'])) : _e($s['tekst']);
										endif; ?></p>
									<div class="specification">
										<?php foreach ($s['specyfikacja'] as $spec) : ?>
											<div class="lefthand">
												<?php echo wp_get_attachment_image($spec['ikona'], 'full-size'); ?>
												<p><?php if (isset($spec['specyfikacja']) && !empty($spec['specyfikacja'])) : _e($spec['specyfikacja']);
													endif; ?></p>
											</div>
											<div class="righthand">
												<p><?php if (isset($spec['wartosc_specyfikacji']) && !empty($spec['wartosc_specyfikacji'])) : _e($spec['wartosc_specyfikacji']);
													endif; ?></p>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "blok_zabiegu_bez_zdjecia") : ?>
				<section class="exortion-block">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<div class="exortion-info noimg">
								<h2><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
									endif; ?></h2>
								<div class="img-wrapper">
									<p><?php if (isset($s['tekst']) && !empty($s['tekst'])) : _e($s['tekst']);
										endif; ?></p>
									<div class="buttons">
										<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button navy arrow"><?php _e("Darmowa konsultacja", "websitestyle"); ?></a>
									</div>
								</div>
								<div class="texts-wrapper">
									<p><?php if (isset($s['tekst_2']) && !empty($s['tekst_2'])) : _e($s['tekst_2']);
										endif; ?></p>
									<div class="specification">
										<?php foreach ($s['specyfikacja'] as $spec) : ?>
											<div class="lefthand">
												<?php echo wp_get_attachment_image($spec['ikona'], 'full-size'); ?>
												<p><?php if (isset($spec['specyfikacja']) && !empty($spec['specyfikacja'])) : _e($spec['specyfikacja']);
													endif; ?></p>
											</div>
											<div class="righthand">
												<p><?php if (isset($spec['wartosc_specyfikacji']) && !empty($spec['wartosc_specyfikacji'])) : _e($spec['wartosc_specyfikacji']);
													endif; ?></p>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "blok_zabiegu_tylko_tekst") : ?>
				<section class="exortion-block">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<div class="exortion-info noimg">
								<h2><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
									endif; ?></h2>
								<div class="img-wrapper">
									<p><?php if (isset($s['tekst']) && !empty($s['tekst'])) : _e($s['tekst']);
										endif; ?></p>
									<div class="buttons">
										<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button navy arrow"><?php _e("Darmowa konsultacja", "websitestyle"); ?></a>
									</div>
								</div>
								<div class="texts-wrapper">
									<p><?php if (isset($s['tekst_2']) && !empty($s['tekst_2'])) : _e($s['tekst_2']);
										endif; ?></p>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "blok_zabiegu_ze_zdjeciami") : ?>
				<section class="exortion-block-with-galleries">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container title">
							<h2><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
								endif; ?></h2>
						</div>
						<div class="container">
							<div class="exortion-info">
								<div data-aos="fade-up" class="img-wrapper left">
									<div class="container-fluid owl-carousel">
										<?php
										foreach ($s['galeria_1'] as $slide) :
										?><img src="<?php _e($slide['url']) ?>" alt="<?php _e($slide['alt']) ?>">
										<?php endforeach ?>
									</div>
								</div>
								<div class="texts-wrapper">
									<p><?php if (isset($s['tekst']) && !empty($s['tekst'])) : _e($s['tekst']);
										endif; ?></p>

									<div class="specification">
										<?php foreach ($s['specyfikacja'] as $spec) : ?>
											<div class="lefthand">
												<?php echo wp_get_attachment_image($spec['ikona'], 'full-size'); ?>
												<p><?php if (isset($spec['specyfikacja']) && !empty($spec['specyfikacja'])) : _e($spec['specyfikacja']);
													endif; ?></p>
											</div>
											<div class="righthand">
												<p><?php if (isset($spec['wartosc_specyfikacji']) && !empty($spec['wartosc_specyfikacji'])) : _e($spec['wartosc_specyfikacji']);
													endif; ?></p>
											</div>
										<?php endforeach; ?>
									</div>

									<div class="buttons">
										<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button orange arrow"><?php _e($s['tekst_przycisku_1']) ?></a>
										<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button navy arrow"><?php _e($s['tekst_przycisku_2']) ?></a>
									</div>
								</div>

							</div>
							<div class="container">
								<div class="exortion-info">

									<div class="texts-wrapper">
										<p><?php if (isset($s['tekst_2']) && !empty($s['tekst_2'])) : _e($s['tekst_2']);
											endif; ?></p>
									</div>

									<div class="img-wrapper right">
										<div data-aos="fade-up" class="container-fluid owl-carousel">
											<?php
											foreach ($s['galeria_2'] as $slide) :
											?><img src="<?php _e($slide['url']) ?>" alt="<?php _e($slide['alt']) ?>">
											<?php endforeach ?>
										</div>
									</div>
								</div>
							</div>
						</div>
				</section>
				<script type="text/javascript">
					jQuery(function($) {
						$('.exortion-block-with-galleries .owl-carousel').owlCarousel({
							loop: true,
							margin: 0,
							items: 1,
							lazyLoad:false,
							autoplay: true,
							autoplayTimeout: 7000,
							autoplayHoverPause: true,
							smartSpeed: 1000,
							dots: false,
							dotsData: false,
							nav: true,
						});
						$('.exortion-block-with-galleries .owl-dot').click(function() {
							$('.exortion-block-with-galleries .owl-dot').trigger('to.owl.carousel', [$(this).index(), 1000]);
						})
					});
				</script>
			<?php elseif ($s['acf_fc_layout'] == "ikony_z_liczbami") : ?>
				<section class="blocks-numbers-icons">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<?php $ini = 1;
							foreach ($s['ikony_z_liczbami'] as $numbericon) : ?>
								<div class="block-number-icons">
									<div class="icon">
										<?php _e(wp_get_attachment_image($numbericon['ikona'], 'full-size')); ?>
									</div>
									<div class="prefixednumber">
										<div class="prefix"><?php _e($numbericon['prefix_liczby']); ?></div>
										<div class="number" id="number<?php _e($ini); ?>" data-count="<?php _e($numbericon['liczba']); ?>">0</div>
									</div>
									<div class="text"><?php _e($numbericon['tekst']); ?></div>
								</div>
							<?php $ini++;
							endforeach; ?>
						</div>
						<div class="container">
							<div class="buttons">
								<!-- <a href="#metamorfozy" class="button navy arrow"><?php _e("Zobacz metamorfozy", "websitestyle"); ?></a> -->
								<a href="#opinie" class="button trans arrow"><?php _e("Przeczytaj opinie", "websitestyle"); ?></a>
							</div>
						</div>
					</div>
				</section>
				<script type="text/javascript">
					jQuery(function($) {
						$(window).on("scroll", function() {
							$('.number').each(function() {
								var $this = $(this),
									countTo = $this.attr('data-count');
								var startCount = countTo * 0.9; // Rozpoczyna odliczanie od 90% wartości końcowej

								if (($(window).height() + $(window).scrollTop() > $(".number").offset().top) && !$this.hasClass("countinup")) {
									$({
										countNum: startCount
									}).animate({ // Zmiana z $this.text() na startCount
										countNum: countTo
									}, {
										duration: 2000, // Skrócenie czasu trwania do 2000 ms
										easing: 'linear',
										step: function() {
											$this.text(Math.floor(this.countNum));
										},
										complete: function() {
											$this.text(this.countNum);
										}
									});
									$this.addClass("countinup");
								} else if (($(window).height() + $(window).scrollTop() < $(".number").offset().top) && $this.hasClass("countinup")) {
									$({
										countNum: $this.text()
									}).animate({
										countNum: startCount // Zmienia wartość końcową na 90% przy zwijaniu
									}, {
										duration: 2000, // Skrócenie czasu trwania do 2000 ms
										easing: 'linear',
										step: function() {
											$this.text(Math.floor(this.countNum));
										},
										complete: function() {
											$this.text(this.countNum);
										}
									});
									$this.removeClass("countinup");
								}
							});
						})
					});
				</script>
			<?php elseif ($s['acf_fc_layout'] == "naglowek_z_kolumnami") : ?>
				<section class="heading-columns <?php echo $s['wyswietl_bloki_z_ikona'] == true ? 'has-icons' : '' ?> <?php echo $s['wyswietl_lekarzy'] == true ? 'has-persons' : '' ?>">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
													endif; ?></h2>
							<div class="cols-wrapper">
								<?php foreach ($s['kolumny'] as $col) : ?>
									<div class="goldcol">
										<?php if (isset($col['ikona'])) : ?>
											<img class="icon" src="<?php _e($col['ikona']['url']) ?>" alt="<?php _e($col['ikona']['alt']) ?>">
										<?php
										endif; ?>
										<?php if (isset($col['ikona'])) : ?>
											<img class="person" src="<?php _e($col['zdjecie_lekarza']['url']) ?>" alt="<?php _e($col['zdjecie_lekarza']['alt']) ?>">
										<?php
										endif; ?>
										<h5><?php if (isset($col['tekst_nad_naglowkiem']) && !empty($col['tekst_nad_naglowkiem'])) : _e($col['tekst_nad_naglowkiem']);
											endif; ?></h5>
										<h4><?php if (isset($col['naglowek']) && !empty($col['naglowek'])) : _e($col['naglowek']);
											endif; ?></h4>
										<p><?php if (isset($col['tekst']) && !empty($col['tekst'])) : _e($col['tekst']);
											endif; ?></p>
										<?php if (isset($col['tekst_-_po_rozwinieciu']) && !empty($col['tekst_-_po_rozwinieciu'])) : ?>
											<p class="show-more"><?php if (isset($col['tekst_-_po_rozwinieciu']) && !empty($col['tekst_-_po_rozwinieciu'])) : echo '<u>rozwiń</u>';
																	endif; ?></p>
											<p class="show-more-content hidden "><?php if (isset($col['tekst_-_po_rozwinieciu']) && !empty($col['tekst_-_po_rozwinieciu'])) : _e($col['tekst_-_po_rozwinieciu']);
																					endif; ?></p>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</section>
				<script>
					jQuery(function($) {
						$(document).ready(function() {
							$('.show-more').click(function() {
								// Ukrywa wszystkie elementy .show-more
								$('.show-more').addClass('hidden');

								// Usuwa klasę .hidden z .show-more-content i dodaje płynne przejście dla max-height
								// Ustawienie bardzo dużej wartości max-height, np. 2000px, może pomóc w pokryciu różnych wysokości zawartości
								// Alternatywnie, można obliczyć wymaganą wysokość dynamicznie
								$('.show-more-content').removeClass('hidden').css('max-height', '0px').animate({
									'max-height': '2000px' // Wartość większa niż spodziewana maksymalna wysokość zawartości
								}, 500); // Czas trwania animacji (500 ms) - dostosuj do potrzeb
							});
						});

					})
				</script>
			<?php elseif ($s['acf_fc_layout'] == "przycisk_do_konsultacji") : ?>
				<section class="button-section">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<?php if ($s['pokaz_przycisk_do_konsultacji']) : ?>
								<div class="buttons">
									<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button orange arrow <?php if ($s['wysrodkuj_przycisk']) {
																																	echo 'center';
																																} ?>">

										<?php
										if ($s['tekst_przycisku']) {
											_e($s['tekst_przycisku']);
										} else {
											_e("Darmowa konsultacja", "websitestyle");
										} ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "faq") : ?>
				<section class="faq-block">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<div class="question-wrapper">
								<div class="question">
									<div class="q-wrapper">
										<p class="q"><?php _e($s['pytanie']); ?></p>
										<div class="a-toggle">
											<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/dropdown.svg" class="dark">
											<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/dropdownwhite.svg" class="white">
											<p class="slideUp hide"><?php _e("Zwiń", "websitestyle"); ?></p>
											<p class="slideDown show"><?php _e("Rozwiń", "websitestyle"); ?></p>
										</div>
									</div>
									<div class="a-wrapper">
										<?php foreach ($s['bloki_odpowiedzi'] as $ablock) : ?>
											<?php if ($ablock['typ_bloku_odpowiedzi'] == "photo-text") : ?>
												<?php $c = $ablock['zdjecie_tekst']; ?>
												<div class="a-info">
													<div class="img-wrapper">
														<?php echo wp_get_attachment_image($c['zdjecie'], 'full-size'); ?>
													</div>
													<div class="texts-wrapper">
														<p><?php if (isset($c['tekst']) && !empty($c['tekst'])) : _e($c['tekst']);
															endif; ?></p>
														<div class="buttons">
															<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button navy arrow"><?php _e("Darmowa konsultacja", "websitestyle"); ?></a>
														</div>
													</div>
												</div>
											<?php elseif ($ablock['typ_bloku_odpowiedzi'] == "text-photo") : ?>
												<?php $c = $ablock['tekst_zdjecie']; ?>
												<div class="a-info">
													<div class="texts-wrapper">
														<p><?php if (isset($c['tekst']) && !empty($c['tekst'])) : _e($c['tekst']);
															endif; ?></p>
														<div class="buttons">
															<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button navy arrow"><?php _e("Darmowa konsultacja", "websitestyle"); ?></a>
														</div>
													</div>
													<div class="img-wrapper">
														<?php echo wp_get_attachment_image($c['zdjecie'], 'full-size'); ?>
													</div>
												</div>
											<?php elseif ($ablock['typ_bloku_odpowiedzi'] == "wysiwyg") : ?>
												<?php $c = $ablock['edytor_tekstowy']; ?>
												<div class="wysiwyg">
													<?php print_r($c); ?>
												</div>
											<?php elseif ($ablock['typ_bloku_odpowiedzi'] == "trisection") : ?>
												<?php $c = $ablock['kolumny']; ?>
												<div class="cols-wrapper">
													<?php foreach ($c as $col) : ?>
														<div class="goldcol">
															<h4><?php if (isset($col['naglowek']) && !empty($col['naglowek'])) : _e($col['naglowek']);
																endif; ?></h4>
															<p><?php if (isset($col['tekst']) && !empty($col['tekst'])) : _e($col['tekst']);
																endif; ?></p>
														</div>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "metamorfozy") : ?>
				<?php if (have_rows("metamorfozy", get_the_ID())) : ?>
					<section class="exertions" id="metamorfozy">
						<div data-aos="fade-up" class="container-fluid">
							<div class="container">
								<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
														endif; ?></h2>
								<div class="exertions-contents">
									<div class="exertion-content show">
										<div class="featured-transformation">
											<?php $fi = 0;
											while (have_rows("metamorfozy", get_the_ID())) : the_row(); ?>
												<?php if ($fi == 0) : ?>
													<div class="example-transformation big">
														<?php if (NULL !== get_sub_field("zdjecie_2") && !empty(get_sub_field("zdjecie_2"))) : ?>
															<div class="image-comparison">
																<div class="icimg photo1" style="background-image:url(<?php _e(get_sub_field("zdjecie_1")); ?>);"></div>
																<div class="icimg photo2" style="background-image:url(<?php _e(get_sub_field("zdjecie_2")); ?>);"></div>
																<input type="range" min="1" max="1000" value="500" class="compareslider" name='compareslider' id="sliderbig">
																<div class='slider-button'></div>
															</div>
														<?php else : ?>
															<div class="image-comparison">
																<?php _e(wp_get_attachment_image(get_sub_field("zdjecie_1"), 'full-size', '', array('class' => 'photo1'))); ?>
															</div>
														<?php endif; ?>
													</div>
													<script type="text/javascript">
														jQuery(function($) {
															$("#sliderbig").on("input change", function(e) {
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
												<?php endif; ?>
											<?php $fi++;
											endwhile; ?>
										</div>
										<div class="transformations-heading">
											<h4><?php _e("Metamorfozy", "websitestyle"); ?></h4>
											<div class="separator"></div>
											<a href="<?php echo get_permalink(17) ?>" class="arrow"><?php _e("Zobacz wszystkie", "websitestyle"); ?></a>
										</div>
										<div class="example-transformations">
											<?php $i = 0;
											while (have_rows("metamorfozy", get_the_ID())) : the_row(); ?>
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
									</div>
									<a href="<?php echo get_permalink(17) ?>" class="button navy arrow"><?php _e("Zobacz wszystkie", "websitestyle"); ?></a>
								</div>


							</div>
						</div>
					</section>
				<?php endif; ?>
			<?php elseif ($s['acf_fc_layout'] == "wyroznione_zabiegi") : ?>
				<section class="free-consultation">
					<div data-aos="fade-up" class="container-fluid gold">
						<div class="container pick-exertion">
							<h3><?php _e($s['naglowek']); ?></h3>
							<?php $featuredexertions = $s['wyroznione_zabiegi'];
							foreach ($featuredexertions as $fe) : ?>
								<div class="exertion-block-wrapper">
									<div class="exertion-block">
										<div class="heading">
											<p><?php _e(get_the_title($fe)); ?></p>
										</div>
										<a href="<?php _e(get_the_permalink($fe)); ?>" class="button white arrow">
											<?php _e("Dowiedz się więcej", "websitestyle"); ?>
										</a>
										<div class="img-wrapper">
											<?php _e(wp_get_attachment_image(get_field("zdjecie_wyroznione_zabiegu", $fe), 'full-size', '', array('class' => 'featuredimg'))); ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "cennik") : ?>
				<section class="pricing">
					<div data-aos="fade-up" class="container-fluid navy">
						<div class="container">
							<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
													endif; ?></h2>
							<div class="pricing-cols">
								<?php foreach ($s['kolumna'] as $pcol) : ?>
									<div class="pricing-col">
										<div class="pc-heading" style="background: <?php if (isset($pcol['kolor_tla_naglowka']) && !empty($pcol['kolor_tla_naglowka'])) : _e($pcol['kolor_tla_naglowka']);
																					endif; ?>;">
											<h5 class="centered" style="color: <?php if (isset($pcol['kolor_czcionki_naglowka']) && !empty($pcol['kolor_czcionki_naglowka'])) : _e($pcol['kolor_czcionki_naglowka']);
																				endif; ?>;"><?php if (isset($pcol['naglowek_kolumny']) && !empty($pcol['naglowek_kolumny'])) : _e($pcol['naglowek_kolumny']);
																							endif; ?></h5>
										</div>
										<div class="price-wrapper">
											<del><?php if (isset($pcol['cena_stara_opcjonalnie']) && !empty($pcol['cena_stara_opcjonalnie'])) : _e($pcol['cena_stara_opcjonalnie']);
													endif; ?></del>
											<p><?php if (isset($pcol['cena']) && !empty($pcol['cena'])) : _e($pcol['cena']);
												endif; ?></p>
										</div>
										<div class="features">
											<?php foreach ($pcol['co_zawiera_pakiet'] as $czp) : ?>
												<?php if ($czp['w_cenie'] == "tak") : ?>
													<div class="feature included">
														<p><?php _e($czp['tekst']); ?></p>
													</div>
												<?php else : ?>
													<div class="feature additional">
														<p><?php _e($czp['tekst']); ?></p>
													</div>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<!-- <div class="buttons">
								<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button white arrow"><?php _e("Darmowa konsultacja", "websitestyle"); ?></a>
							</div> -->
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "tresc_z_zakladkami_i_akordeonem") : ?>
				<section class="tabs-and-accordions">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<h2 class="centered"><?php if (isset($s['glowny_tytul']) && !empty($s['glowny_tytul'])) : _e($s['glowny_tytul']);
													endif; ?></h2>
						</div>

						<div class="columns">
							<div class="column column-1">
								<?php
								$content_of_tab_nr = 1;
								foreach ($s['zakladki'] as $tab) : ?>
									<img class="content_of_tab_nr-<?php echo $content_of_tab_nr ?> content_of_tab" src="<?php _e($tab['zdjecie_zakladki']['url']) ?>" alt="<?php _e($tab['zdjecie_zakladki']['alt']) ?>">
								<?php
									$content_of_tab_nr++;
								endforeach; ?>
							</div>
							<div class="column column-2">
								<div class="column-inner-content">
									<div class="tabs">
										<?php
										$content_of_tab_nr = 1;
										foreach ($s['zakladki'] as $tab) : ?>
											<div class="tab tab_nr-<?php echo $content_of_tab_nr ?>">
												<?php _e($tab['tytul_zakladki']) ?>
											</div>
										<?php
											$content_of_tab_nr++;
										endforeach; ?>
									</div>
									<?php
									$content_of_tab_nr = 1;
									foreach ($s['zakladki'] as $tab) : ?>
										<div class="content content_of_tab_nr-<?php echo $content_of_tab_nr ?> content_of_tab">
											<p><?php _e($tab['tekst_zakladki']) ?></p>
											<div class="accordion">
												<?php
												foreach ($tab['akordeon'] as $accordion_item) : ?>
													<div class="accordion-item">
														<div class="top">
															<h3><?php _e($accordion_item['tytul_akordeonu']) ?></h3><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
																<g id="Group_2518" data-name="Group 2518" transform="translate(12736 -8126)">
																	<g id="Group_2141" data-name="Group 2141" transform="translate(-13714 8059)">
																		<g id="right-arrow" transform="translate(1000.156 80.773) rotate(90)">
																			<g id="Group_1988" data-name="Group 1988" transform="translate(0 0)">
																				<path id="Path_5579" data-name="Path 5579" d="M5.9,5.536h0L.883.187A.481.481,0,0,0,.175.129.559.559,0,0,0,.121.883.516.516,0,0,0,.175.941l4.161,4.44a.817.817,0,0,1,.278.532.836.836,0,0,1-.278.538L.175,10.886a.56.56,0,0,0-.055.754.481.481,0,0,0,.708.058.518.518,0,0,0,.055-.058L5.9,6.29A.56.56,0,0,0,5.9,5.536Z" fill="#313448" />
																			</g>
																		</g>
																		<g id="Ellipse_21" data-name="Ellipse 21" transform="translate(978 67)" fill="none" stroke="#313448" stroke-width="1">
																			<circle cx="16" cy="16" r="16" stroke="none" />
																			<circle cx="16" cy="16" r="15.5" fill="none" />
																		</g>
																	</g>
																</g>
															</svg>
														</div>
														<p><?php _e($accordion_item['tekst_akordeonu']) ?></p>
													</div>
												<?php endforeach; ?>
											</div>
										</div>
									<?php
										$content_of_tab_nr++;
									endforeach; ?>
									<div class="buttons">
										<a href="/darmowa-konsultacja?zabieg=<?php _e(get_the_ID()); ?>" class="button orange arrow"><?php if (isset($s['tekst_przycisku']) && !empty($s['tekst_przycisku'])) : _e($s['tekst_przycisku']);
																																		endif; ?></a>
									</div>
								</div>
							</div>
						</div>

					</div>
				</section>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						// Ustawienie domyślnie aktywnego pierwszego tabu i treści
						$('.tab:first').addClass('active');
						$('.content_of_tab_nr-1').addClass('active');
						$('.column-1 img:first').addClass('active'); // Aktywacja pierwszego obrazu

						// Domyslne zamknięcie wszystkich akordeonów
						$('.accordion-item p').hide();

						// Obsługa zakładek
						$('.tab').on('click', function() {
							// Usuwanie klasy active z wszystkich tabów i ich treści oraz obrazów w pierwszej kolumnie
							$('.tab, .content, .column-1 img').removeClass('active');

							// Dodawanie klasy active do klikniętego tabu
							$(this).addClass('active');

							// Pobieranie numeru klikniętego tabu
							var tabNum = $(this).attr('class').match(/tab_nr-(\d+)/)[1];

							// Dodawanie klasy active do odpowiadającej treści
							$(".content_of_tab_nr-" + tabNum).addClass('active');

							// Dodawanie klasy active do odpowiadającego obrazu w pierwszej kolumnie
							$(".column-1 .content_of_tab_nr-" + tabNum).addClass('active');
						});

						// Obsługa akordeonu
						$('.accordion-item .top').on('click', function() {
							var $content = $(this).next('p');

							// Sprawdzanie, czy kliknięty element jest już aktywny
							var isActive = $(this).parent().hasClass('active');

							// Zamykanie wszystkich elementów akordeonu
							$('.accordion-item').removeClass('active');
							$('.accordion-item p').slideUp();

							// Jeśli kliknięty element nie był aktywny, rozwijamy go
							if (!isActive) {
								$(this).parent().addClass('active');
								$content.slideDown();
							}
						});
					});
				</script>
			<?php elseif ($s['acf_fc_layout'] == "niestandardowa_sekcja") : ?>
				<?php _e(do_shortcode("[wsshortcode_" . $s['wybrana_niestandardowa_sekcja'] . "]")); ?>
			<?php elseif ($s['acf_fc_layout'] == "ikony_z_tekstem") : ?>
				<section class="icons-with-text">
					<div data-aos="fade-up" class="container-fluid">
						<?php if ($s['polozenie_zdjecia'] == 'right') : ?>
							<div class="container">
								<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
														endif; ?></h2>
							</div>
						<?php endif; ?>
						<div class="columns <?php 'image-on-' . _e($s['polozenie_zdjecia']) ?>">
							<div class="column column-1">
								<?php if ($s['polozenie_zdjecia'] == 'left') : ?>

									<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
															endif; ?></h2>

								<?php endif; ?>
								<?php if ($s['lista_ikon_z_tekstem']) :
									foreach ($s['lista_ikon_z_tekstem'] as $item) :
								?>
										<div class="content-item">
											<img src="<?php _e($item['ikona']['url']) ?>" alt="<?php _e($item['ikona']['alt']) ?>">
											<p><?php _e($item['tekst']) ?></p>
										</div>
								<?php
									endforeach;
								endif; ?>
							</div>
							<div class="column column-2">
								<img src="<?php _e($s['zdjecie']['url']) ?>" alt="<?php _e($s['zdjecie']['alt']) ?>">
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "tekst_ze_zdjeciem_osoby") : ?>
				<section class="text-and-person-photo">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<div class="columns">
								<div class="column column-1">
									<h2><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
										endif; ?></h2>
									<div class="text"><?php _e($s['tresc']) ?></div>
									<?php if ($s['dodatkowy_blok_tresci_-_tekst']) : ?>
										<div class="content-block">
											<img src="<?php _e($s['dodatkowy_blok_tresci_-_logo']['url']) ?>" alt="<?php _e($s['dodatkowy_blok_tresci_-_logo']['alt']) ?>">
											<p><?php _e($s['dodatkowy_blok_tresci_-_tekst']) ?></p>
										</div>
									<?php endif; ?>
								</div>
								<div class="column column-2">
									<img src="<?php _e($s['zdjecie_obok_tresci']['url']) ?>" alt="<?php _e($s['zdjecie_obok_tresci']['alt']) ?>">
								</div>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "filmy") : ?>
				<section class="video-clips">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">

							<h2><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
								endif; ?></h2>
							<div class="videos">
								<?php foreach ($s['lista_filmow'] as $video) : ?>
									<div class="video"><?php
														_e($video['kod_osadzenia_filmu']);
														_e($video['opis_filmu']);
														?></div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "formularz_konsultacji") : ?>
				<section id="formularz" class="consultationform <?php if ($s['rodzaj'] == 'hair') {
																	echo 'consultationform--hair';
																}; ?>">
					<?php if ($s['rodzaj'] == 'hair') {
						_e(do_shortcode("[wsshortcode_consultationform_hair]"));
					} else {
						_e(do_shortcode("[wsshortcode_consultationform]"));
					} ?>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "ikony_z_tekstem_bloki_przesuwane_w_bok") : ?>
				<section class="icon-blocks-with-side-scroll">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<div class="top">
								<h2><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
									endif; ?></h2>
								<div class="buttons">
									<a href="<?php _e($s['link_przycisku']) ?>" class="button navy arrow"><?php if (isset($s['tekst_przycisku']) && !empty($s['tekst_przycisku'])) : _e($s['tekst_przycisku']);
																											endif; ?></a>
								</div>
							</div>
							<div class="cols-wrapper" <?php if (count($s['kolumny']) > 3) {
															echo 'style="overflow-x: auto;"';
														}; ?>>
								<?php foreach ($s['kolumny'] as $col) : ?>
									<div class="goldcol">
										<h4><?php if (isset($col['naglowek']) && !empty($col['naglowek'])) : _e($col['naglowek']);
											endif; ?></h4>

										<?php if (isset($col['ikona'])) : ?>
											<div class="icon-wrap">
												<img class="icon" src="<?php _e($col['ikona']['url']) ?>" alt="<?php _e($col['ikona']['alt']) ?>">
											</div>
										<?php
										endif; ?>

										<?php if (isset($col['tekst']) && !empty($col['tekst'])) :
											foreach ($col['tekst'] as $item) : ?>
												<div class="list-item">
													<div class="icon"><svg id="Group_2496" data-name="Group 2496" xmlns="http://www.w3.org/2000/svg" width="17.653" height="8.802" viewBox="0 0 17.653 8.802">
															<g id="Group_5" data-name="Group 5" transform="translate(0 0)">
																<path id="Path_25" data-name="Path 25" d="M17.451,3.9h0L13.847.207a.676.676,0,0,0-.975,0,.725.725,0,0,0,0,1l2.419,2.478H.69a.71.71,0,0,0,0,1.42h14.6L12.874,7.589a.725.725,0,0,0,0,1,.676.676,0,0,0,.975,0L17.45,4.9h0A.725.725,0,0,0,17.451,3.9Z" transform="translate(0 0)" fill="#313448" />
															</g>
														</svg>
													</div>
													<p><?php _e($item['tresc']) ?></p>
												</div>
										<?php endforeach;
										endif; ?>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "hotele") : ?>
				<section class="hotels">

					<div data-aos="fade-up" class="container-fluid">

						<div class="container title">
							<h2><?php _e($s['naglowek']); ?></h2>
						</div>

						<div class="container">

							<div class=" description">
								<p><?php _e($s['tekst']) ?></p>
							</div>

							<div class=" hotels-list">
								<?php foreach ($s['hotele'] as $hotel) : ?>
									<div class="hotel">
										<img src="<?php _e($hotel['zdjecie']['url']) ?>" alt="<?php _e($hotel['zdjecie']['alt']) ?>">
										<div class="buttons">
											<a href="<?php _e($hotel['link']) ?>" class="button orange arrow"><?php _e($hotel['tekst']) ?></a>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>


				</section>
			<?php elseif ($s['acf_fc_layout'] == "blog-small") : ?>
				<section class="blog-small">
					<div data-aos="fade-up" class="container-fluid">
						<div class="container">
							<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
													endif; ?></h2>
							<div class="blog-container">
								<?php
								// Define the query
								$args = array(
									'post_type' => 'post',
									'posts_per_page' => 3,
									'no_found_rows' => true
								);

								$blog_posts = new WP_Query($args);

								// Start the loop
								if ($blog_posts->have_posts()) : while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
										<div class="blog-post">
											<?php if (has_post_thumbnail()) : ?>
												<div class="post-image">
													<?php the_post_thumbnail(); ?>
												</div>
											<?php endif; ?>
											<div class="post-content">
												<h2><?php the_title(); ?></h2>
												<p><?php the_excerpt(); ?></p>
											</div>
										</div>
								<?php endwhile;
								endif; ?>
							</div>
						</div>
					</div>
				</section>
			<?php elseif ($s['acf_fc_layout'] == "tekst_galeria_i_lista_publikacji") : ?>
				<section class="text-gallery-and-articles">

					<div data-aos="fade-up" class="container-fluid">

						<div class="container container-title">
							<h2><?php _e($s['naglowek']); ?></h2>
						</div>

						<div class="container container-text">
							<?php if ($s['zdjecie']) { ?><img src="<?php echo $s['zdjecie']['url']; ?>" alt="<?php echo $s['zdjecie']['alt']; ?>"> <?php } ?>
							<div class="text"><?php _e($s['tekst']); ?></div>
						</div>

						<?php
						if ($s['galeria']) : ?>

							<div class="container container-gallery">
								<div class="gallery-top">
									<p>Galeria</p>
								</div>
								<div class="text-gallery-and-articles-gallery owl-carousel">
									<?php foreach ($s['galeria'] as $gallery_item) : ?>
										<a href="<?php _e(wp_get_attachment_url($gallery_item['ID'], 'full-size')); ?>" data-lightbox="gallery">
											<?php _e(wp_get_attachment_image($gallery_item['ID'], 'full-size')); ?>
										</a>
									<?php endforeach; ?>
								</div>
							</div>

						<?php
						endif;
						if ($s['lista_publikacji']) : ?>

							<div class="container container-articles">
								<div class="articles-top">
									<h3 class="articles-text"><?php _e($s['tytul_listy_publikacji']); ?></h3>
								</div>

								<div class="articles-list">
									<?php foreach ($s['lista_publikacji'] as $article_item) : ?>
										<div class="article-item">
											<?php _e(wp_get_attachment_image($article_item['logo']['ID'], 'full-size')); ?>

											<p><?php _e($article_item['tresc']); ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							</div>

						<?php
						endif; ?>

					</div>
				</section>
				<script type="text/javascript">
					jQuery(function($) {
						$('.text-gallery-and-articles-gallery').owlCarousel({
							loop: true,
							margin: 25,
							autoplay: false,
							dots: false,
							nav: true,
							items: 3, // Domyślna liczba elementów
							responsive: {
								0: {
									items: 1 // Na urządzeniach poniżej 980px pokazuje 1 element
								},
								980: {
									items: 3 // Na urządzeniach 980px i większych pokazuje 3 elementy
								}
							}
						});
					});
				</script>

			<?php else : ?>
	<?php endif;
		endforeach;
	endif; ?>
	<?php if (have_rows("metamorfozy", get_the_ID()) && get_the_ID() !== 33 && get_the_ID() !== 34) : ?>
		<section class="metamorphosis">
			<div data-aos="fade-up" class="container-fluid gold">
				<div class="container">
					<div class="metamorphosis-contents">
						<div class="metamorphosis-content show" data-changeexertion="<?php _e(get_the_ID()); ?>">
							<?php $i = 0;
							while (have_rows("metamorfozy", get_the_ID())) : the_row(); ?>
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
										<p class="quote">
											<?php _e(get_sub_field("opis")); ?>
										</p>
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
													items: 3,
													autoplay: false,
													dots: false,
													nav: true
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
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php
	global $post;

	if ($post->ID !== 33) {
	?> <section class="consultationform">
			<?php _e(do_shortcode("[wsshortcode_consultationform]"));
			?>
		</section> <?php
					_e(do_shortcode("[wsshortcode_opinie]"));
				} ?>
	<section class="blog-small">
		<div data-aos="fade-up" class="container-fluid">
			<div class="container">
				<h2 class="centered">Blog</h2>
				<div class="blog-container">
					<?php
					// Define the query
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'no_found_rows' => true
					);

					$blog_posts = new WP_Query($args);

					// Start the loop
					if ($blog_posts->have_posts()) : while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
							<div class="blog-post">
								<?php if (has_post_thumbnail()) : ?>
									<div class="post-image">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php endif; ?>
								<div class="post-content">
									<h2><?php the_title(); ?></h2>
									<p><?php the_excerpt(); ?></p>
								</div>
							</div>
					<?php endwhile;
					endif; ?>
				</div>
			</div>
		</div>
	</section>
</div><!-- #page-wrapper -->
<?php
get_footer();
