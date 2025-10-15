<?php

/**
 * Logotypes WS
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$argsallExe = array(
	'post_type'     =>  'zabiegi',
	'post_status'   =>  'publish',
	'post_parent'   =>  0,
	'posts_per_page'    =>  -1,
	'order_by'      =>  'menu_order',
	'order'         =>  'ASC'
);
$allExertions = new WP_Query($argsallExe); ?>

<div data-aos="fade-up" class="container-fluid consformwrapper">
	<?php $consultingform = get_field("formularz_darmowa_konsultacja", 'options'); ?>
	<div class="container">
		<div class="consultation-form">
			<div class="conform-heading">
				<h2><?php _e($consultingform['naglowek']); ?></h2>
				<?php _e(wp_get_attachment_image($consultingform["ikona_przy_naglowku"])); ?>
			</div>
			<?php echo do_shortcode('[contact-form-7 id="39677e4" title="Formularz konsultacji - ogólny"]'); ?>
		</div>
	</div>
</div>
<?php
