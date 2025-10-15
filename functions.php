<?php

/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
require('vendor/autoload.php');
// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ($understrap_includes as $file) {
	require_once get_theme_file_path($understrap_inc_dir . $file);
}

function ws_zabiegifunc()
{
	get_template_part('global-templates/zabiegi');
}
add_shortcode('wsshortcode_zabiegi', 'ws_zabiegifunc');

function ws_opiniefunc()
{
	get_template_part('global-templates/opinie');
}
add_shortcode('wsshortcode_opinie', 'ws_opiniefunc');

function ws_consultationformfunc()
{
	get_template_part('global-templates/consultationform');
}
add_shortcode('wsshortcode_consultationform', 'ws_consultationformfunc');

function ws_consultationformfunc_hair()
{
	get_template_part('global-templates/consultationform-hair');
}
add_shortcode('wsshortcode_consultationform_hair', 'ws_consultationformfunc_hair');

add_action('wp_ajax_ws_show_more', 'ws_show_more');
add_action('wp_ajax_nopriv_ws_show_more', 'ws_show_more');
function ws_show_more()
{
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ws_field_nonce')) {
		exit;
	}
	if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
		return;
	}
	$show = 2;
	$start = $_POST['offset'];
	$end = $start + $show;
	$post_id = $_POST['post_id'];
	ob_start();
	if ("have_rows('sesje', $post_id)" == 0) {
		$total = count(get_field('sesje', $post_id));
		$count = 0;
		while ("have_rows('sesje', $post_id)" == 0) {
			the_row();
			if ($count < $start) {
				$count++;
				continue;
			}
			get_template_part('global-templates/ws-ws-loop');
			$count++;
			if ($count == $end) {
				break;
			}
		}
	}
	$content = ob_get_clean();
	$more = false;
	if ($total > $count) {
		$more = true;
	}
	echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
	exit;
}

function is_a_bot()
{

	$is_bot = false;

	$user_agents = array('GTmetrix', 'Googlebot', 'Bingbot', 'BingPreview', 'msnbot', 'slurp', 'Ask Jeeves/Teoma', 'Baidu', 'DuckDuckBot', 'AOLBuild', 'Chrome-Lighthouse', 'Google PageSpeed Insights');

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	foreach ($user_agents as $agent) {
		if (strpos($user_agent, $agent)) {
			$is_bot = true;
		}
	}

	return $is_bot;
}

add_action('wp_ajax_wscustomproductinquiry', 'wscustomproductinquiry');
add_action('wp_ajax_nopriv_wscustomproductinquiry', 'wscustomproductinquiry');
function wscustomproductinquiry()
{
	$response = [];
	if (isset($_POST)) {
		$data = $_POST;
		$productid = $data['product'];
		$user = $data['user'];
		$email = $data['email'];
		$mailResult = false;
		$body = "";
		if (isset($email) && isset($productid)) {
			$to = get_option('admin_email');
			$subject = "Zapytanie o szyte na miarę - " . $email;
			if (!isset($user) || get_userdata($user) === false) {
				$body .= 'Zapytanie o możliwość uszycia produktu <a href="' . get_the_permalink($productid) . '" target="_blank">' . get_the_title($productid) . '</a>.</br>';
				$body .= 'Skontaktuj się pod adresem <a href="mailto:' . $email . '" target="_blank">' . $email . '</a> aby ustalić szczegóły.';
			} else {
				$userdata = get_userdata($user);
				$body .= 'Zapytanie o możliwość uszycia produktu <a href="' . get_the_permalink($productid) . '" target="_blank">' . get_the_title($productid) . '</a>.</br>';
				$body .= 'Skontaktuj się z użytkownikiem <a href="' . get_bloginfo('url') . '/wp-admin/user-edit.php?user_id=' . $user . '&wp_http_referer=%2Fwp-admin%2Fusers.php" target="_blank">' . $userdata->display_name . '</a> pod adresem <a href="mailto:' . $email . '" target="_blank">' . $email . '</a> aby ustalić szczegóły.';
			}
			$headers = array('Content-Type: text/html; charset=UTF-8');

			$mailResult = wp_mail($to, $subject, $body, $headers);
			if ($mailResult) {
				$response['status'] = "success";
				$response['msg'] = __("Dziękujemy za przesłanie zapytania. Wkrótce wrócimy do Ciebie z informacjami.", "websitestyle");
			} else {
				$response['status'] = "error";
				$response['msg'] = __("Błąd wysyłki wiadomości.", "websitestyle");
			}
		} else {
			$response['status'] = "error";
			$response['msg'] = __("Przesłano niepełne dane formularza.", "websitestyle");
		}
	} else {
		$response['status'] = "error";
		$response['msg'] = __("Błąd interpretacji zapytania.", "websitestyle");
	}
	_e(json_encode($response));
	wp_die();
}

function WebP_upload_mimes($existing_mimes)
{
	$existing_mimes['WebP'] = 'image/WebP';
	return $existing_mimes;
}
add_filter('mime_types', 'WebP_upload_mimes');

function WebP_is_displayable($result, $path)
{
	if ($result === false) {
		$displayable_image_types = array(IMAGETYPE_WebP);
		$info = @getimagesize($path);
		if (empty($info)) {
			$result = false;
		} elseif (!in_array($info[2], $displayable_image_types)) {
			$result = false;
		} else {
			$result = true;
		}
	}
	return $result;
}
add_filter('file_is_displayable_image', 'WebP_is_displayable', 10, 2);

add_action('phpmailer_init', 'my_phpmailer_init');
function my_phpmailer_init($phpmailer)
{
	//$phpmailer->Host = 'poczta.bajtkom.pl';
	//$phpmailer->Port = 587; // could be different
	//$phpmailer->Username = 'smtp@websitestyle.com'; // if required
	//$phpmailer->Password = ''; // if required
	//$phpmailer->SMTPAuth = true; // if required
	/// $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible value
	//$phpmailer->IsSMTP();
}


add_image_size('banner-img', 500, 500, array('center', 'center'));

function ws_featuerd_img_setup()
{
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'ws_featuerd_img_setup');

add_filter('duplicate_comment_id', '__return_false');

function ws_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'ws_remove_wp_block_library_css', 100);

function ha_add_honeypot($postID)
{
	echo '<p style="display:none">';
	echo '<textarea name="confirmemail" cols="100%" rows="10" autocomplete="off"> </textarea>';
	echo '<label  for="confirmemail">' . __("Please enter your email address again for confirmation", "ha-basic") . '</label>';
	echo '</p>';
}
add_action('comment_form', 'ha_add_honeypot');

function ha_detect_honeypot($comment_status)
{
	if (!empty($_POST['confirmemail'])) {
		$comment_status = 'spam';
	}
	return $comment_status;
}
add_filter('pre_comment_approved', 'ha_detect_honeypot');

function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

add_filter('allowed_block_types', 'wp_code_helper_allowed_block_types', 10, 2);

function wp_code_helper_allowed_block_types($allowed_blocks, $post)
{
	return array(
		'core/paragraph',       // Paragraph block
		'core/heading',         // Heading block
		'core/list',            // List block
		'core/image'            // Image block
	);
}
