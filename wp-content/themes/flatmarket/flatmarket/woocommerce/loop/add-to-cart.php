<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $theme_options;

if(is_plugin_active('woo_quickview/jck_woo_quickview.php')) {
	global $jckqv;
	$jckqv->displayBtn($product->id); 
}

echo '<div class="product-buttons">';

// Catalog mode
if(isset($theme_options['shop_catalog_mode_enable']) && $theme_options['shop_catalog_mode_enable']) {

	$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
	$link['label'] 	= apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );

	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
		sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
			esc_url( $link['url'] ),
			esc_attr( $product->id ),
			esc_attr( $product->get_sku() ),
			$product->is_purchasable() ? 'product_type_simple' : '',
			esc_attr( $product->product_type ),
			esc_html( $link['label'] )
		),
	$product );

} else {
	echo apply_filters( 'woocommerce_loop_add_to_cart_link',
		sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( $product->id ),
			esc_attr( $product->get_sku() ),
			$product->is_purchasable() ? 'add_to_cart_button' : '',
			esc_attr( $product->product_type ),
			esc_html( $product->add_to_cart_text() )
		),
	$product );
}

// Wishlist and Compare
if(is_plugin_active('yith-woocommerce-compare/init.php')) {
	echo do_shortcode('[yith_compare_button]');
}
if(is_plugin_active('yith-woocommerce-wishlist/init.php')) {
	echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}

echo '</div>';