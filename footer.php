<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="wrapper-footer">
	<div data-aos="fade-up" class="container-fluid">
		<div class="container wf-cont">
			<div class="ftcol1">
				<a href="<?php _e(get_bloginfo('url')); ?>/" class="homeurl-logo">
					<?php _e(wp_get_attachment_image(get_field("logotyp_w_stopce", "options"), 'full-size')); ?>
				</a>
				<p><?php _e(get_field("dane_adresowe", "options")); ?></p>
				<?php if (get_field("odnosnik_google_maps", "options")) : ?>
					<div class="googlemaps-wrapper">
						<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/google-maps.svg"> <a target="_blank" follow="nofollow" href="<?php _e(get_field("odnosnik_google_maps", "options")); ?>">Google Maps</a>
					</div>
				<?php endif; ?>
			</div>
			<div class="ftcol2">
				<?php if (get_field("kolumna_linkow_1", "options")) : ?>
					<h5><?php _e(get_field("kolumna_linkow_1", "options")['naglowek']); ?></h5>
					<div class="links-wrapper">
						<?php if (have_rows("kolumna_linkow_1", "options")) : while (have_rows("kolumna_linkow_1", "options")) : the_row();
								if (have_rows("linki")) : while (have_rows("linki")) : the_row(); ?>
										<a href="<?php _e(get_sub_field("odnosnik_linku")); ?>/"><?php _e(get_sub_field("etykieta_linku")); ?></a>
						<?php endwhile;
								endif;
							endwhile;
						endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="ftcol3">
				<?php if (get_field("kolumna_linkow_2", "options")) : ?>
					<h5><?php _e(get_field("kolumna_linkow_2", "options")['naglowek']); ?></h5>
					<div class="links-wrapper">
						<?php if (have_rows("kolumna_linkow_2", "options")) : while (have_rows("kolumna_linkow_2", "options")) : the_row();
								if (have_rows("linki")) : while (have_rows("linki")) : the_row(); ?>
										<a href="<?php _e(get_sub_field("odnosnik_linku")); ?>/"><?php _e(get_sub_field("etykieta_linku")); ?></a>
						<?php endwhile;
								endif;
							endwhile;
						endif; ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="ftcol4">
				<a class="button white arrow" href="/darmowa-konsultacja/?zabieg=33"><?php _e("Darmowa konsultacja", "websitestyle"); ?></a>
				<a class="phone" href="tel: <?php _e(get_field("numer_telefonu", "options")); ?>"><?php _e(get_field("numer_telefonu", "options")); ?><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftphone.svg"></a>
				<a class="mail" href="mailto: <?php _e(get_field("adres_e-mail", "options")); ?>"><?php _e(get_field("adres_e-mail", "options")); ?><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/ftemail.svg"></a>
			</div>

			<div class="flex mt-5 ftcolbottom">
				<?php
				$url = $_SERVER['REQUEST_URI'];

				?>
				<p class="w-100" style="color: white; ">TourEstetica podlega wpisowi do rejestru organizatorów turystycznych pod numerem: 0000000000</p>

				<div class="ue-baner flex flex-wrap">
					<?php echo wp_get_attachment_image(575, 'full'); ?>
					<?php echo wp_get_attachment_image(574, 'full'); ?>
					<?php echo wp_get_attachment_image(577, 'full'); ?>
					<?php echo wp_get_attachment_image(576, 'full'); ?>
				</div>
			</div>
		</div>
		<div class="bottom-info container">
			<p>© <?php _e(date("Y")); ?> TourEstetica / <a href="/polityka-prywatnosci"><?php _e("Polityka Prywatności", "websitestyle"); ?></a></p>
			<div class="social-media">
				<p><?php _e("Social media", "bnb"); ?></p>
				<div class="separator"></div>
				<?php if (have_rows("social_media", "options")) :
					while (have_rows("social_media", "options")) : the_row(); ?>
						<a href="<?php get_sub_field("odnosnik_do_medium") ? _e(get_sub_field("odnosnik_do_medium")) : false; ?>" class="sociallink" rel="nofollow">
							<?php _e(wp_get_attachment_image(get_sub_field("ikona_medium_biala"), 'full-size')); ?>
						</a>
				<?php endwhile;
				endif; ?>
			</div>
			<p><a href="https://www.websitestyle.pl/">Strony WWW - WebsiteStyle.pl</a></p>
		</div>
		<div id="toTop"><img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/backtotop.svg"></div>
	</div>

</div><!-- wrapper end -->
</div><!-- #page we need this extra closing tag here -->
<?php /*
<div class="yt-popup">
    <div class="popup-nav"><p>Zamknij X</p></div>
    <div id="ytplayer"></div>
	<div id="ytplayer1"></div>
	<div id="ytplayer2"></div>
	<div id="ytplayer3"></div>
	<div id="ytplayer4"></div>
</div>
*/ ?>
<script>
	var delayValue = window.innerWidth > 768 ? 400 : 0;
	var durationValue = window.innerWidth > 768 ? 1500 : 750;


	AOS.init({
		delay: delayValue, // Opóźnienie startu animacji
		duration: durationValue, // Czas trwania animacji
		once: false, // Czy animacja ma się wykonać tylko raz
		offset: 0, // Dostosuj do potrzeb, aby animacje aktywowały się na dole ekranu
	});

	document.addEventListener("DOMContentLoaded", function() {

		AOS.refresh();

		setInterval(() => {
			AOS.refresh();
		}, 1000); // Co sekundę; dostosuj według potrzeb

	});
</script>
<script type="text/javascript">
	function WHCreateCookie(name, value, days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
		document.cookie = name + "=" + value + expires + "; path=/";
	}

	function WHReadCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	}
	window.onload = WHCheckCookies;

	function WHCloseCookiesWindow() {
		WHCreateCookie('cookies_accepted', 'T', 365);
		document.getElementById('cookies-message-container').removeChild(document.getElementById('cookies-message'));
	}

	function WHCheckCookies() {
		if (WHReadCookie('cookies_accepted') != 'T') {
			var message_container = document.createElement('div');
			message_container.id = 'cookies-message-container';
			var html_code = '<div id="cookies-message">Akceptuję warunki zawarte w <a href="https://www.tourestetica.pl/polityka-prywatnosci/">"Polityce prywatności"</a>. <a href="javascript:WHCloseCookiesWindow();" onclick="javascript:WHCloseCookiesWindow();" id="accept-cookies-checkbox" name="accept-cookies" style="padding: 2px 5px; color: #FFF; display: inline-block; margin-left: 10px; text-decoration: none; cursor: pointer;border:1px solid #444;">Akceptuję</a></div>';
			message_container.innerHTML = html_code;
			document.body.appendChild(message_container);
		}
	}
</script>
<script>
	document.addEventListener('alpine:init', () => {
		Alpine.data('ytIframe', (id) => ({
			id: id,

			interval: null,
			open: false,
			init() {
				const self = this
				if (this.id) {
					this.interval = setInterval(() => {
						if (YT && YT.loaded) {
							clearInterval(self.interval)
							self.initIframe()
						}
					}, 500)
				}
			},

			initIframe() {
				const self = this
				this.player = new YT.Player(this.$refs.video, {
					height: '56.25vw',
					width: '100vw',
					videoId: this.id,
					events: {
						onStateChange: (event) => {
							if (event.data == YT.PlayerState.ENDED) {
								self.player.stopVideo()
							}
						}
					}
				})
			},

			openPopup() {
				console.log('open')
				this.open = true
				this.player.playVideo()
			},

			openNewPopup(id) {
				this.id = id
				this.open = true
				this.player = null;
				this.player = new YT.Player(this.$refs.video, {
					height: '56.25vw',
					width: '100vw',
					videoId: this.id,
					events: {
						onStateChange: (event) => {
							if (event.data == YT.PlayerState.ENDED) {
								self.player.stopVideo()
							}
						}
					},
					playerVars: {
						'autoplay': 1
					},
				})
				// this.player.playVideo()
			},

			close() {
				this.open = false
				this.player.stopVideo()
			},
		}))
	})

	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/player_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Dodajemy nasłuchiwanie na kliknięcia tylko w obrębie kontenerów wideo
		document.querySelectorAll('.video-container').forEach(function(container) {
			container.addEventListener('click', function(e) {
				// Sprawdzamy, czy kliknięto element z klasą video-overlay lub jego dziecko
				var overlay = e.target.closest('.video-overlay');
				if (overlay) {
					var videoUrl = overlay.getAttribute('data-video-url');
					// Upewniamy się, że videoUrl jest prawidłowym adresem URL
					if (videoUrl && videoUrl.startsWith('https://www.youtube.com/embed/')) {
						var iframe = document.createElement('iframe');
						iframe.setAttribute('src', videoUrl + "?autoplay=1&enablejsapi=1");
						iframe.setAttribute('frameborder', '0');
						iframe.setAttribute('allow', 'autoplay; encrypted-media');
						iframe.setAttribute('allowfullscreen', '');
						iframe.style.width = '100%';
						iframe.style.height = '100%';

						// Czyścimy kontener i dodajemy iframe
						container.innerHTML = '';
						container.appendChild(iframe);
					} else {
						console.error('Invalid video URL:', videoUrl);
					}
				}
			});
		});
	});
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Znajdź wszystkie labele wewnątrz .consultationform
		var labels = document.querySelectorAll('.consultationform label');

		labels.forEach(function(label) {
			// Dodaj nasłuchiwacz kliknięcia do każdego labela
			label.addEventListener('click', function() {
				// Pobierz wartość atrybutu 'for', który powinien odpowiadać id inputu
				var inputId = this.getAttribute('for');
				if (inputId) {
					// Znajdź input o tym id i ustaw na nim focus
					var input = document.getElementById(inputId);
					if (input) {
						input.focus();
					}
				}
			});
		});
	});
</script>

<style>
	#wrapper-navbar {
		transition: top 1s;
	}

	#wrapper-navbar.wrapper-navbar--hidden {
		top: -100%;
		/* Załóżmy, że nagłówek ma wysokość 100px */
	}
</style>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		var lastScrollTop = 0;
		var header = document.querySelector("#wrapper-navbar");

		window.addEventListener("scroll", function() {
			var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

			if (currentScroll > lastScrollTop) {
				// Scrollowanie w dół
				header.classList.add("wrapper-navbar--hidden");
			} else {
				// Scrollowanie w górę
				header.classList.remove("wrapper-navbar--hidden");
			}
			lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Dla przeglądarek mobilnych
		}, false);
	});
</script>
<script defer>
	document.addEventListener('DOMContentLoaded', function() {
		// Selektor dla linków w menu z dziećmi
		var menuLinks = document.querySelectorAll('.menu-item-has-children > a');

		// Dodajemy nasłuchiwanie zdarzeń dla każdego linku
		menuLinks.forEach(function(link) {
			var clicked = false; // Stan kliknięcia: false oznacza, że link nie był jeszcze kliknięty
			var originalHref = link.getAttribute('href'); // Zapisz oryginalny adres URL

			link.addEventListener('click', function(e) {
				if (!clicked) {
					// Usuwamy atrybut href, aby zapobiec nawigacji
					link.removeAttribute('href');
					clicked = true;
				} else {
					// Przywracamy oryginalny adres URL
					link.setAttribute('href', originalHref);
					clicked = false;
				}
			});
		});
	});
</script>


<?php wp_footer(); ?>
</body>

</html>