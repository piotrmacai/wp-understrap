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
	<?php $consultingform = get_field("formularz_darmowa_konsultacja_-_wlosy", 'options'); ?>
	<div class="container">
		<div class="consultation-form">
			<div class="conform-heading">
				<div class="heading-content">
					<h2><?php _e($consultingform['naglowek']); ?></h2>
					<p class="text text-big"><?php _e($consultingform['podtytul']); ?></p>
					<p class="text text-small"><?php _e($consultingform['tekst']); ?></p>

				</div>
				<?php _e(wp_get_attachment_image($consultingform["ikona_przy_naglowku"])); ?>
			</div>

			<?php if ($consultingform['ikony_z_tekstem']) : ?>
				<div class="heading-icons">
					<?php foreach ($consultingform['ikony_z_tekstem'] as $item) : ?>
						<div class="icon-item">
							<img src="<?php echo $item['ikona']['url'] ?>" alt="<?php echo $item['ikona']['alt'] ?>">
							<p><?php _e($item['tekst']); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php echo do_shortcode('[contact-form-7 id="1d9b8ec" title="Formularz konsultacji - włosy"]'); ?>

		</div>
	</div>
</div>
<?php
