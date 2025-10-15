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
?>
<?php if (isset($_GET['zabieg']) && !empty($_GET['zabieg'])) :
	$zabiegid = htmlspecialchars($_GET['zabieg']); ?>
	<div class="wrapper" id="frontPage">
		<section class="free-consultation">
			<div data-aos="fade-up" class="container-fluid gold">
				<div class="container">
					<h1 class="centered"><?php _e(get_field("naglowek")); ?></h1>
					<div class="exertion-wrapper">
						<div class="img-wrapper">
							<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu", $zabiegid), 'full-size', '', array('class' => 'dark'))); ?>
							<?php _e(wp_get_attachment_image(get_field("zdjecie_wyroznione_zabiegu", $zabiegid), 'full-size', '', array('class' => 'featuredimg'))); ?>
						</div>
						<div class="texts-wrapper">
							<h3><?php _e(get_the_title($zabiegid)); ?></h3>
							<p><?php _e(get_field("skrocone_informacje", $zabiegid)['krotki_opis']); ?></p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php // Sprawdź, czy parametr 'zabieg' istnieje w URL
		if (isset($_GET['zabieg'])) {
			$zabieg = $_GET['zabieg'];
		}
		?>
		<section style="margin-bottom:4rem" id="formularz" class="consultationform <?php if ($zabieg == 33) {
																						echo 'consultationform--hair';
																					}; ?>">
			<?php if ($zabieg == 33) {
				_e(do_shortcode("[wsshortcode_consultationform_hair]"));
			} else {
				_e(do_shortcode("[wsshortcode_consultationform]"));
			} ?>
		</section>
	</div>
	<script type="text/javascript">
		jQuery(function($) {
			$("input#name1").val("<?php isset($_GET['fcname']) && !empty($_GET['fcname']) ? _e(htmlspecialchars($_GET['fcname'])) : false; ?>");
			$("input#phone1").val("<?php isset($_GET['fcphone']) && !empty($_GET['fcphone']) ? _e(htmlspecialchars($_GET['fcphone'])) : false; ?>");
			$("input#email1").val("<?php isset($_GET['fcemail']) && !empty($_GET['fcemail']) ? _e(filter_var($_GET['fcemail'], FILTER_SANITIZE_EMAIL)) : false; ?>");
			$("input#zabieg1").val("<?php isset($_GET['zabieg']) && !empty($_GET['zabieg']) ? _e(get_the_title(htmlspecialchars($_GET['zabieg']))) : false; ?>");
			$("input#zabieg1").attr("disabled", true);
		})
	</script>
<?php else : ?>
	<div class="wrapper" id="frontPage">
		<section class="free-consultation">
			<div data-aos="fade-up" class="container-fluid gold">
				<div class="container">
					<h1><?php _e(get_field("naglowek")); ?></h1>
					<div class="video-with-text">
						<div class="videoembed">
							<div x-data="ytIframe('<?php echo str_replace("https://www.youtube.com/embed/", "", get_field('link_do_video_embed')); ?>')" class="video-overlay">
								<div class="inner-box">
									<div class="hero-overlay"></div>
									<?php echo wp_get_attachment_image(get_field('zdjecie_zastepcze'), 'full-size', '', array('class' => 'ytplaceholder')); ?>
									<img @click="openPopup()" width="150px" height="auto" class="play ytplayer" ytid="<?php _e(get_field('link_do_video_embed')); ?>" src="<?php echo get_stylesheet_directory_uri(); ?>/img/ytplay.svg" />
								</div>

								<div :style="open && 'display:block!important;'" class="yt-popup">
									<div class="popup-nav" @click="close()">
										<p>Zamknij X</p>
									</div>
									<div x-ref="video" class=""></div>
								</div>
							</div>
							<?php if (!is_a_bot()) : ?>
								<script>
									// var player;
									// function onYouTubePlayerAPIReady() {
									//     console.log('load player')
									//     player = new YT.Player('ytplayer', {
									//         height: '56.25vw',
									//         width: '100vw',
									//         videoId: '<?php echo str_replace("https://www.youtube.com/embed/", "", get_field('link_do_video_embed')); ?>',
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
									//         console.log(player)
									//         var ytid = '<?php echo str_replace("https://www.youtube.com/embed/", "", get_field('link_do_video_embed')); ?>';
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
						</div>
						<div class="text">
							<p><?php _e(get_field("tekst")); ?></p>
						</div>
					</div>
				</div>
				<div class="container pick-exertion">
					<h3><?php _e("Wybierz zabieg by przesłać zdjęcia do konsultacji", "websitestyle"); ?></h3>
					<?php $argsallExe = array(
						'post_type'     =>  'zabiegi',
						'post_status'   =>  'publish',
						'post_parent'   =>  0,
						'posts_per_page'    =>  -1,
						'order_by'      =>  'menu_order',
						'order'         =>  'ASC'
					);
					$allExertions = new WP_Query($argsallExe);
					if ($allExertions->have_posts()) :
						while ($allExertions->have_posts()) : $allExertions->the_post(); ?>
							<div class="exertion-block-wrapper">
								<div class="exertion-block">
									<div class="heading">
										<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu", $post->ID), 'full-size', '', array('class' => 'dark'))); ?>
										<?php _e(wp_get_attachment_image(get_field("ikona_zabiegu_biala", $post->ID), 'full-size', '', array('class' => 'white'))); ?>
										<p><?php _e(get_the_title($post->ID)); ?></p>
									</div>
									<a href="/darmowa-konsultacja?zabieg=<?php _e($post->ID); ?>" class="button white arrow">
										<?php _e("Konsultacja", "websitestyle"); ?>
									</a>
									<div class="img-wrapper">
										<?php _e(wp_get_attachment_image(get_field("zdjecie_wyroznione_zabiegu", $post->ID), 'full-size', '', array('class' => 'featuredimg'))); ?>
									</div>
								</div>
							</div>
					<?php endwhile;
					endif; ?>
				</div>
			</div>
		</section>
	</div><!-- #page-wrapper -->
<?php endif; ?>
<?php
get_footer();
