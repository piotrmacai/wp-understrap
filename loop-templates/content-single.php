<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<div class="meta-element">
				<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/list-text.svg">
				<p><?php _e(get_the_category()[0]->name); ?></p>
			</div>
			<div class="meta-element">
				<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/readtime.svg">
				<p><?php _e(do_shortcode("[rt_reading_time postfix='minut czytania']")); ?></p>
			</div>
			<div class="meta-element">
				<img src="<?php _e(get_stylesheet_directory_uri()); ?>/img/calendar.svg">
				<p><?php _e(get_the_date('j F Y')); ?></p>
			</div>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php //echo get_the_post_thumbnail( $post->ID, 'full-size' ); ?>

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<div class="author-box">
			<div class="author-img">
				<?php $authorid = get_post_field( 'post_author', $post->ID );
				get_field("zdjecie_uzytkownika", "user_".$authorid) ? _e(wp_get_attachment_image(get_field("zdjecie_uzytkownika", "user_".$authorid))) : _e(wp_get_attachment_image(18273)); ?>
			</div>
			<div class="author-meta">
				<h5><?php _e("Autor: ", "websitestyle"); ?><?php _e(get_the_author_meta("first_name", $authorid)); ?><?php get_field("krotkie_zdanie_opisujace_uzytkownika", "user_".$authorid) ? _e(", ".get_field("krotkie_zdanie_opisujace_uzytkownika", "user_".$authorid)) : false; ?></h5>
				<p><?php _e(get_the_author_meta("description", $authorid)); ?></p>
			</div>
		</div>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
