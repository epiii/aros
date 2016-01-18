<?php
	/*
	Plugin Name: frar  okeh epiii
	URI: http://www.orangorangan.com
	Description: Plugin belajar
	Author: Jipeus Version: 1.0
	Author URI: http://www.orangorangan.com
	*/
	add_action('admin_menu', 'okeh_menu');
	function okeh_menu() {
	    // Plugin FRAR Menu = Page title , judul halaman
	    // frar Plugin = Menu Title, judul menu yang akan kita klik
	    // ’1′ = Capability, berhubungan dengan hak akses user atas plugin
	    // plugin_frar_menu = Slug name, hperlink (coba rollover di atas menu dan lihat hyperlinknya)
	    // okeh_options = function, nama function yang akan menjadi output ( dalam contoh ini, function menghasilkan teks “hahaha, plugin saya sukses!”
		
		add_options_page('Plugin FRAR', 'FRAR plugin', 1, 'plugin_frar_menu', 'frar_options');
		// add_options_page('Plugin okeh menu', 'Okeh Plugin', 1, 'plugin_okeh_menu', 'okeh_options');
	}
	function frar_options() {
		if (!current_user_can(1))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		echo '<div class="wrap">';
		echo 'HAHAHA! plugin saya sukses';
		echo '</div>';
	}
?>