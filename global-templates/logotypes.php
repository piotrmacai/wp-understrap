<?php

/**
 * Logotypes WS
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (get_field("naglowek_i_logotypy", "options")) :
    $scod = get_field("naglowek_i_logotypy", "options");
?>
    <section class="logotypes">
        <div data-aos="fade-up" class="container-fluid">
            <div class="container">
                <h3><?php isset($scod['naglowek']) ? _e($scod['naglowek']) : false; ?></h3>
                <div class="logo-carousel owl-carousel">
                    <?php foreach ($scod['logotypy'] as $logo) : ?>
                        <?php isset($logo['link_opcjonalnie']) && !empty($logo['link_opcjonalnie']) ? _e('<a href="' . $logo['link_opcjonalnie'] . '" target="_blank" rel="nofollow">') : false; ?>
                        <div>
                            <?php _e(wp_get_attachment_image($logo['logotyp'], 'full-size', '', array('class' => 'logotype'))); ?>
                        </div>
                        <?php isset($logo['link_opcjonalnie']) && !empty($logo['link_opcjonalnie']) ? _e('</a>') : false; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" defer>
        jQuery(function($) {
            $('.logo-carousel.owl-carousel').owlCarousel({
                loop: false,
                dots: false,
                nav: false,
                autoplay: false,
                autoplayTimeout: 4000,
                responsive: {
                    0: {
                        margin: 20,
                        items: 3,
                    },
                    768: {
                        margin: 50,
                        items: 5,
                    },
                    1100: {
                        margin: 70,
                        items: 5,
                    },
                    1400: {
                        margin: 100,
                        items: 5,
                    },
                    1700: {
                        margin: 130,
                        items: 5,
                    },
                    1900: {
                        margin: 150,
                        items: 5,
                    },
                }
            });
        });
    </script>
<?php
endif;
