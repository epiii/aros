<?php
	/*
	Plugin Name: frar  (Fitting Room Augmented Reality)
	URI: http://www.yukbikinweb.com
	Description: Plugin belajar
	Author: Elfrianto Version: 1.0
	Author URI: http://www.yukbikinweb.com
	*/

	// epi ------
	function frar_include_js() {
		if(is_page('virtual-fitting-room')){
			wp_enqueue_script('compatibility',plugin_dir_url(__FILE__).'/js/compatibility.js', array(), '1.0.0', true );
			wp_enqueue_script('smoother',plugin_dir_url(__FILE__).'/js/smoother.js', array(), '1.0.0', true );
			wp_enqueue_script('objectdetect',plugin_dir_url(__FILE__).'/js/js-objectdetect/objectdetect.js', array(), '1.0.0', true );
			wp_enqueue_script('upperbody',plugin_dir_url(__FILE__).'/js/js-objectdetect/objectdetect.upperbody.js', array(), '1.0.0', true );
			wp_enqueue_script('shirtupperbody5',plugin_dir_url(__FILE__).'/js/shirtupperbody5.js', array(), '1.0.0', true );
		}
	}add_action( 'wp_print_scripts', 'frar_include_js' );

	function frar_display($atts, $content = null) {
		extract( shortcode_atts( array('url' => '#'), $atts ) );
		$ret ='<video xcontrols id="video" style="float: right; margin-right: 1em;"></video>';
		$ret.='<a href="#" style="" class="button" id="fullscreenbtn"> <i class="im-icon-fullscreen"></i></a>';
		$ret.='<img id="shirt" xsrc="../../latihan/CV/FP/img/img2/s001.png" xstyle="position: absolute; display:block;">';
		$ret.='<div id="list"></div>';
    	$ret.='<br><div class="overlay">
					<b>Recommended Size :</b>  
   			     	<p id="sizeInfoT" style="float:right;position:absolute;z-index:1;color:red;font-size:30px;z-index:1;">...</p>
    		   </div>';
		return $ret;
	}add_shortcode('frarDisplay', 'frar_display');
	
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

	function button_saya($atts, $content = null) {
		extract( shortcode_atts( array('url' => '#'), $atts ) );
		return '<a href="'.$url.'" class="button"><span>'.do_shortcode($content).'</span></a>';
	}
	?>
