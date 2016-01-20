<?php
/*
Plugin Name: React Webcam
Version: 1.1.0
Author: Radek Matej
Description: Add auto-refreshing image from your webcam to any page.
*/

namespace ReactWebcam;

const WEBCAM_DIR = 'webcam';
const REFRESHINT_ATTNAME = 'refreshinterval';
const REFRESHINT_DEFAULT = 60; // seconds


function init($atts) {

	$atts = shortcode_atts(array(
		REFRESHINT_ATTNAME => REFRESHINT_DEFAULT
	), $atts);

	wp_register_script('react', plugins_url('js/vendor/react.min.js', __FILE__));
	wp_enqueue_script('ReactWebcam_ActualImage', plugins_url('js/ActualImage.js', __FILE__), array('react'));

	$upload_dir = wp_upload_dir();

   	$ajax_url = admin_url('admin-ajax.php');
   	$webcam_url = $upload_dir['baseurl'] . '/' . WEBCAM_DIR . '/';
	$initial_image_url = $webcam_url . '/' . get_last_filename();

	return '
		<script type="text/javascript">
			var global = {
				ajaxUrl: "' . $ajax_url . '",
				webcamUrl: "' . $webcam_url . '",
				initialImageUrl: "' . $initial_image_url . '",
				refreshInterval: ' . $atts[REFRESHINT_ATTNAME] . '
			};
		</script>

		<div id="webcam">
			<img src="' . $initial_image_url . '" />
		</div">';

};


// Returns filename of the last webcam image.
function get_last_filename() {

	$filenames = get_filenames();

	$last_filename = end($filenames);
	reset($filenames);
	return $last_filename;

};


// Returns list of all webcam image filenames.
function get_filenames() {

   	$upload_dir = wp_upload_dir();
   	$webcam_dir = $upload_dir['basedir'] . '/' . WEBCAM_DIR . '/';

	$filenames = array();
	foreach (glob($webcam_dir . '*') as $path) {
		array_push($filenames, basename($path));
	}

	return $filenames;

};

// AJAX call handler to return last webcam image filename.
function last_image() {
	echo get_last_filename();
	wp_die();
}


add_action('wp_ajax_last_image', 'ReactWebcam\last_image');
add_action('wp_ajax_nopriv_last_image', 'ReactWebcam\last_image');

add_shortcode('reactwebcam', 'ReactWebcam\init');

?>
