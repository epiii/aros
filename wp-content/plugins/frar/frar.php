<?php
	/*
	Plugin Name: frar  okeh epiii
	URI: http://www.orangorangan.com
	Description: Plugin belajar
	Author: Jipeus Version: 1.0
	Author URI: http://www.orangorangan.com
	*/
	/*add_action('publish_post', 'frar_menu');
	// add_action('admin_menu', 'frar_menu');
	function frar_menu() {
	    // Plugin FRAR Menu = Page title , judul halaman
	    // frar Plugin = Menu Title, judul menu yang akan kita klik
	    // ’1′ = Capability, berhubungan dengan hak akses user atas plugin
	    // plugin_frar_menu = Slug name, hperlink (coba rollover di atas menu dan lihat hyperlinknya)
	    // okeh_options = function, nama function yang akan menjadi output ( dalam contoh ini, function menghasilkan teks “hahaha, plugin saya sukses!”
		
		add_options_page('Plugin FRAR', 'FRAR plugin', 1, 'plugin_frar_menu', 'frar_options');
		// add_options_page('Plugin okeh menu', 'Okeh Plugin', 1, 'plugin_okeh_menu', 'okeh_options');
	}*/
	function frar_options() {
		if (!current_user_can(1))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		echo '<div class="wrap">';
		echo 'HAHAHA! plugin saya sukses';
		echo '</div>';
	}

	Function testCode($atts){
		return "Ini adalah shortcode pertama EPI.";
	}

	function button_saya($atts, $content = null) {
		extract( shortcode_atts( array('url' => '#'), $atts ) );
		return '<a href="'.$url.'" class="button"><span>'.do_shortcode($content).'</span></a>';
	}
	
		// epi ------
	function frar_display($atts, $content = null) {
		extract( shortcode_atts( array('url' => '#'), $atts ) );
		$ret = '<video id="video" style="float: right; margin-right: 1em;"></video>';
		$ret.='<button id="fullscreenbtn"> X </button>';
		// $x=plugin_dir_path( __FILE__ ).'/js/epiJS.js';
		// $x=plugin_dir_url(__FILE__);
		// var_dump($x);
		return $ret;
	}add_shortcode('frarDisplay', 'frar_display');
	
	function frar_include_js() {
		// wp_enqueue_style( 'style-name', get_stylesheet_uri() );
		// wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/testJS.js', array(), '1.0.0', true );
		wp_enqueue_script('jquery',plugin_dir_url(__FILE__).'/js/jquery.js', array(), '1.0.0', true );
		wp_enqueue_script('smoother',plugin_dir_url(__FILE__).'/js/smoother.js', array(), '1.0.0', true );
		wp_enqueue_script('compatibility',plugin_dir_url(__FILE__).'/js/compatibility.js', array(), '1.0.0', true );
		wp_enqueue_script('objectdetect',plugin_dir_url(__FILE__).'/js/js-objectdetect/objectdetect.js', array(), '1.0.0', true );
		wp_enqueue_script('upperbody',plugin_dir_url(__FILE__).'/js/js-objectdetect/objectdetect.upperbody.js', array(), '1.0.0', true );
	}
	add_action( 'wp_enqueue_scripts', 'frar_include_js' );
	
	function frar_display_products(){
		$ul='<ul id="list" class="products">';
		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => 2
		);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : 
				$loop->the_post();
				// var_dump($loop->the_post());
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
		$ul.='</ul>';	
		return $ul;
	}add_shortcode('frarDisplayProducts','frar_display_products');
	// epi ------
	
	// add_shortcode('download', 'button_saya');
	// add_shortcode("frarDisplay2", "testcode2");
	// add_shortcode("frarDisplay", "testCode");
?>
