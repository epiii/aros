<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 100.1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


wp_enqueue_script('yith_wcas_jquery-autocomplete' );

?>

<div class="yith-ajaxsearchform-container">
<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
    <div>
        <label class="screen-reader-text" for="yith-s"><?php _e( 'Search for:', 'yit' ) ?></label>
        <input type="search" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>" />
        <?php
        
            $args = array(
                 'parent'    =>  0

            );
            $product_categories = get_terms( 'product_cat', $args );

        ?>
        <select name="product_cat" >
        <option value='' selected><?php _e( 'All categories', 'yit' ) ?></option>
        <?php foreach( $product_categories as $cat ) {
        echo '<option value="'. $cat->slug .'">' . $cat->name . '</option>';
        }
        ?>
        </select>


        <input type="submit" id="searchsubmit" value="<?php echo get_option('yith_wcas_search_submit_label') ?>" />
        <input type="hidden" name="post_type" value="product" />
    </div>
</form>
</div>
<script type="text/javascript">
jQuery(function($){
    var search_loader_url = <?php echo apply_filters('yith_wcas_ajax_search_icon', 'woocommerce_params.ajax_loader_url') ?>;

    $('#s').autocomplete({
        minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
        appendTo: '#searchform',
        serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
        onSearchStart: function(){
            $(this).css('background', 'url('+search_loader_url+') no-repeat right center');
        },
        onSearchComplete: function(){
            $(this).css('background', 'transparent');
        },
        onSelect: function (suggestion) {
            if( suggestion.id != -1 ) {
                window.location.href = suggestion.url;
            }
        }
    });
});
</script>