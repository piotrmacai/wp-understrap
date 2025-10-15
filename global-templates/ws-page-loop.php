<?php

/**
 * WS Pages sections loop
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (get_field("sekcje")) :
	$dupsection = 0;
	foreach (get_field("sekcje") as $s) :
		if ($s['acf_fc_layout'] == "baner_zdjeciowy") : ?>
			<section class="baner photos" x-data="ytIframe(null)">
				<div :style="open && 'display:block!important;'" class="yt-popup">
					<div class="popup-nav" @click="close()">
						<p>Zamknij X</p>
					</div>
					<div x-ref="video" class=""></div>
				</div>
				<div data-aos="fade-up" class="container-fluid owl-carousel">
					<?php $i = 1;
					foreach ($s['slajdy'] as $slideid) :
						$slidedata = get_field("dane_do_slidera", $slideid); ?>
						<div class="slide" data-dot="<span><?php _e($i); ?></span>">
							<?php if (isset($slidedata['zdjecie_w_tle_mobile']) && NULL !== $slidedata['zdjecie_w_tle_mobile']) : ?>
								<?php _e(wp_get_attachment_image($slidedata['zdjecie_w_tle'], 'full-size', '', array('class' => 'bg desk-only'))); ?>
								<?php _e(wp_get_attachment_image($slidedata['zdjecie_w_tle_mobile'], 'full-size', '', array('class' => 'bg mobi-only'))); ?>
							<?php else : ?>
								<?php _e(wp_get_attachment_image($slidedata['zdjecie_w_tle'], 'full-size', '', array('class' => 'bg'))); ?>
							<?php endif; ?>
							<div class="slide-contents-wrapper" style="<?php echo $slidedata['ukryj_poswiate_na_mobile'] ? 'background: unset!important; ' : ''; ?>">
								<h2><?php _e($slidedata['naglowek']); ?></h2>
								<?php if ($slidedata['dopisek']) : ?>
									<p class="description"><?php _e($slidedata['dopisek']); ?></p>
								<?php endif; ?>
								<?php if ($slidedata['cena']) : ?>
									<div class="price"> <img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/check.svg">
										<p><?php _e($slidedata['cena']); ?><span><?php _e($slidedata['cena_skreslona']); ?></span></p>
									</div>
								<?php endif; ?>
								<?php if ($slidedata['krotka_oferta']) : ?>
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
											endforeach;
											?>
										</p>
									</div>
								<?php endif; ?>
								<div class="buttons">
									<a href="/darmowa-konsultacja?zabieg=<?php _e($slideid); ?>" class="button orange arrow"><?php _e($slidedata['tekst_przycisku']); ?></a>
									<a href="<?php _e(get_the_permalink($slideid)); ?>" class="button white arrow"><?php _e("Dowiedz się więcej", "websitestyle"); ?></a>
								</div>
								<div @click="openNewPopup('<?php echo str_replace("https://www.youtube.com/embed/", "", $slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>')" class="video playvidonclick" data-ytlink="<?php _e($slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>">
									<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/play-button.svg">
									<p><?php _e("Zobacz video", "websitestyle"); ?></p>
								</div>
								<script>
									// Load the IFrame Player API code asynchronously.
									// var tag = document.createElement('script');
									// tag.src = "https://www.youtube.com/player_api";
									// var firstScriptTag = document.getElementsByTagName('script')[0];
									// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
									// var player;
									// function onYouTubePlayerAPIReady() {
									//     console.log('load player1')
									//     player = new YT.Player('ytplayer<?php _e($i); ?>', {
									//         height: '56.25vw',
									//         width: '100vw',
									//         videoId: '<?php echo str_replace("https://www.youtube.com/embed/", "", $slidedata['odnosnik_do_osadzenia_filmu_yt']); ?>',
									//         events: {
									//             'onStateChange': onPlayerStateChange
									//         }
									//     });
									// }
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
									//         if (jQuery("iframe#ytplayer<?php _e($i); ?>").length > 0) {
									//             player.stopVideo();
									//         }
									//         jQuery(".yt-popup").fadeOut(500);
									//     })
									// })
								</script>
							</div>
						</div>
					<?php $i++;
					endforeach; ?>
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
			<script type="text/javascript">
				jQuery(function($) {
					$('.baner.photos .owl-carousel').owlCarousel({
						loop: true,
						margin: 0,
						items: 1,
						autoplay: true,
						autoplayTimeout: 7000,
						autoplayHoverPause: true,
						smartSpeed: 1000,
						dots: true,
						dotsData: true,
					});
					$('.baner.photos .owl-dot').click(function() {
						$('.baner.photos .owl-dot').trigger('to.owl.carousel', [$(this).index(), 1000]);
					})
				});
			</script>
		<?php elseif ($s['acf_fc_layout'] == "naglowek_z_przyciskiem") : ?>
			<section class="heading-and-button">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<h1><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
							endif; ?></h1>
						<div class="separator"></div>
						<?php if (isset($s['odnosnik_przycisku']) && !empty($s['odnosnik_przycisku'])) : ?>
							<div class="buttons">
								<a href="<?php _e($s['odnosnik_przycisku']); ?>" class="button navy arrow"><?php _e($s['tekst_przycisku']); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		<?php elseif ($s['acf_fc_layout'] == "bloki_tekstowe_polowki") : ?>
			<section class="text-blocks-halves">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<?php foreach ($s['bloki_tekstowe'] as $textblock) : ?>
							<div class="text-block">
								<h3><?php if (isset($textblock['naglowek']) && !empty($textblock['naglowek'])) : _e($textblock['naglowek']);
									endif; ?></h3>
								<p><?php if (isset($textblock['tekst']) && !empty($textblock['tekst'])) : _e($textblock['tekst']);
									endif; ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php elseif ($s['acf_fc_layout'] == "osadzenie_video") : ?>
			<section class="videoembed">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<div class="video-container">
							<div class="video-overlay" data-video-url="<?php echo $s['link_do_video_embed']; ?>">
								<?php echo wp_get_attachment_image($s['zdjecie_zastepcze'], 'full-size', '', array('class' => 'ytplaceholder')); ?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/ytplay.svg" alt="Play" class="play-icon">
								<p class="play-icon-text">OBEJRZYJ WIDEO</p>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php if (!is_a_bot()) : ?>
				<script>
					// var player;
					// function onYouTubePlayerAPIReady() {
					// // function onYouTubeIframeAPIReady () {
					//     console.log('load player2')
					//     player = new YT.Player('ytplayer', {
					//         height: '56.25vw',
					//         width: '100vw',
					//         videoId: '<?php echo str_replace("https://www.youtube.com/embed/", "", $s['link_do_video_embed']); ?>',
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
					//     jQuery(".ytplayer").click(function() {
					//         var ytid = '<?php echo str_replace("https://www.youtube.com/embed/", "", $s['link_do_video_embed']); ?>';
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
		<?php elseif ($s['acf_fc_layout'] == "ikony_z_liczbami") : ?>
			<section class="blocks-numbers-icons">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<?php foreach ($s['ikony_z_liczbami'] as $numbericon) : ?>
							<div class="block-number-icons">
								<div class="icon">
									<?php _e(wp_get_attachment_image($numbericon['ikona'], 'full-size')); ?>
								</div>
								<div class="prefixednumber">
									<div class="prefix"><?php _e($numbericon['prefix']); ?></div>
									<div class="number" data-count="<?php _e($numbericon['liczba']); ?>"> </div>
								</div>
								<div class="text"><?php _e($numbericon['tekst']); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
			<script type="text/javascript">
				jQuery(function($) {
					$(window).on("scroll", function() {
						$('.number').each(function() {
							var $this = $(this),
								countTo = $this.attr('data-count');
							var startCount = countTo - 10;

							// Sprawdzenie, czy animacja powinna zostać uruchomiona
							var isInViewport = ($(window).height() + $(window).scrollTop() > $this.offset().top);
							var hasNotAnimated = !$this.hasClass("countinup");

							if (isInViewport && hasNotAnimated) {
								$this.text(Math.floor(startCount)); // Ustawienie tekstu na 90% wartości końcowej przed rozpoczęciem animacji

								$({
									countNum: startCount
								}).animate({ // Rozpoczęcie od 90%
									countNum: countTo
								}, {
									duration: 1000, // Zmienione na wolniejszą animację
									easing: 'linear',
									step: function() {
										$this.text(Math.floor(this.countNum));
									},
									complete: function() {
										$this.text(this.countNum);
										// Dodanie klasy po zakończeniu animacji, aby uniknąć ponownego uruchamiania
										$this.addClass("countinup");
									}
								});
							}
						});
					});
				});
			</script>
		<?php elseif ($s['acf_fc_layout'] == "przyciski") : ?>
			<section class="buttons">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<div class="buttons">
							<?php foreach ($s['przyciski'] as $button) : ?>
								<a href="<?php _e($button['odnosnik_przycisku']); ?>" class="button <?php _e($button['dodatkowe_klasy_przycisku']); ?>"><?php _e($button['tekst_przycisku']); ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
		<?php elseif ($s['acf_fc_layout'] == "niestandardowa_sekcja") : ?>
			<?php _e(do_shortcode("[wsshortcode_" . $s['wybrana_niestandardowa_sekcja'] . "]")); ?>
		<?php elseif ($s['acf_fc_layout'] == "hero_baner") : ?>
			<section class="baner single-photo ">
				<div data-aos="fade-up" class="container-fluid">
					<div class="slide <?php if ($s['naglowek'] == '') {
											echo 'low-height';
										} ?>">
						<?php if (isset($s['zdjecie_w_tle_mobile']) && NULL !== $s['zdjecie_w_tle_mobile']) : ?>
							<?php _e(wp_get_attachment_image($s['zdjecie_w_tle'], 'full-size', '', array('class' => 'bg desk-only'))); ?>
							<?php _e(wp_get_attachment_image($s['zdjecie_w_tle_mobile'], 'full-size', '', array('class' => 'bg mobi-only'))); ?>
						<?php else : ?>
							<?php _e(wp_get_attachment_image($s['zdjecie_w_tle'], 'full-size', '', array('class' => 'bg'))); ?>
						<?php endif; ?>
						<?php if ($s['naglowek'] !== '') : ?>
							<div class="overlay"></div>
						<?php endif; ?>
						<div class="slide-contents-wrapper">
							<h1><?php _e($s['naglowek']); ?></h1>
							<p><?php _e($s['tekst']); ?></p>
						</div>
					</div>
				</div>
			</section>
		<?php elseif ($s['acf_fc_layout'] == "klinika") : ?>
			<section class="clinic <?php if ($s['galeria_rozwijania']) {
										echo 'hidden-gallery';
									} ?>">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<h2><?php if (isset($s['nazwa_kliniki']) && !empty($s['nazwa_kliniki'])) : _e($s['nazwa_kliniki']);
							endif; ?></h2>
						<div class="separator"></div>
					</div>
					<div class="container">
						<div class="clinic-info">
							<div class="video-overlay" x-data="ytIframe('<?php echo str_replace("https://www.youtube.com/embed/", "", $s['link_do_video_embed']); ?>')">
								<div class="inner-box">
									<div class="hero-overlay"></div>
									<?php echo wp_get_attachment_image($s['zdjecie_zastepcze'], 'full-size', '', array('class' => 'ytplaceholder')); ?>
									<img width="150px" height="auto" @click="openPopup()" class="play ytplayer" ytid="<?php _e($s['link_do_video_embed']); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/ytplay.svg" />
								</div>
								<div :style="open && 'display:block!important;'" class="yt-popup">
									<div class="popup-nav" @click="close()">
										<p>Zamknij X</p>
									</div>
									<div x-ref="video" class=""></div>
								</div>
							</div>
							<script>
								// Load the IFrame Player API code asynchronously.
								// var tag = document.createElement('script');
								// tag.src = "https://www.youtube.com/player_api";
								// var firstScriptTag = document.getElementsByTagName('script')[0];
								// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
								// var player;
								// function onYouTubePlayerAPIReady() {
								//     console.log('load player3')
								//     player = new YT.Player('ytplayer', {
								//         height: '56.25vw',
								//         width: '100vw',
								//         videoId: '<?php echo str_replace("https://www.youtube.com/embed/", "", $s['link_do_video_embed']); ?>',
								//         events: {
								//             'onStateChange': onPlayerStateChange
								//         }
								//     });

								//     console.log(player)
								// }
								// function onPlayerStateChange(event) {
								//     if (event.data == YT.PlayerState.ENDED) {
								//         player.stopVideo();
								//         jQuery(".yt-popup").fadeOut(500);
								//     }
								// }
								// jQuery(function($) {
								//     jQuery(".ytplayer").click(function() {
								//         console.log(player)
								//         var ytid = '<?php echo str_replace("https://www.youtube.com/embed/", "", $s['link_do_video_embed']); ?>';
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
							<p><?php _e($s['tekst']); ?>
								<?php if ($s['galeria_rozwijania']) {
								?> <span class="show-gallery"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
											<g id="Group_2141" data-name="Group 2141" transform="translate(-978 -67)">
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
										</svg>
										<span>Rozwiń galerię</span>
									</span><?php
										} ?>
							</p>
						</div>
					</div>
					<div class="container gallery <?php if ($s['galeria_rozwijania']) {
														echo '';
													} ?>">
						<div class="gallery-heading">
							<h4><?php _e("Galeria", "websitestyle"); ?></h4>
							<div class="separator"></div>
						</div>
						<div class="galler-wrapper owl-carousel">
							<?php foreach ($s['galeria'] as $galimg) : ?>
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

							$('.gallery').hide(); // Początkowo ukryj galerię

							$('.show-gallery').click(function() {
								$(this).slideUp('slow', function() { // Płynne zwijanie elementu .show-gallery
									// Po zakończeniu zwijania .show-gallery, rozpoczynamy rozwijanie .gallery
									$('.gallery').slideDown('slow');
								});
							});
						});
					</script>
				</div>
			</section>
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
						items: 3,
						autoplay: false,
						dots: false,
						nav: true
					});
				});
			</script>
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
		<?php elseif ($s['acf_fc_layout'] == "blog-big") : ?>
			<section class="blog-big">
				<div data-aos="fade-up" class="container-fluid">
					<div class="container">
						<h2 class="centered"><?php if (isset($s['naglowek']) && !empty($s['naglowek'])) : _e($s['naglowek']);
												endif; ?></h2>
						<div class="blog-container">
							<?php
							// Define the query
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => -1,
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
		<?php else : ?>
	<?php endif;
	endforeach;
else : ?>
	<div data-aos="fade-up" class="container-fluid" id="content" tabindex="-1">

		<div class="container">

			<!-- Do the left sidebar check -->
			<?php get_template_part('global-templates/left-sidebar-check'); ?>

			<main class="site-main" id="main">

				<?php
				while (have_posts()) {
					the_post();
					get_template_part('loop-templates/content', 'page');

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
				}
				?>

			</main><!-- #main -->

			<!-- Do the right sidebar check -->
			<?php get_template_part('global-templates/right-sidebar-check'); ?>

		</div><!-- .row -->

	</div><!-- #content -->
<?php endif;
