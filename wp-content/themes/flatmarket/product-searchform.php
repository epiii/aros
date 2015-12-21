<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<div>
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search for products', 'woocommerce' ); ?>" /><?php
        
            $args = array(
                 'parent'    =>  0
            );
            $product_categories = get_terms( 'product_cat', $args );

        ?><select name="product_cat" >
        <option value='' selected><?php _e( 'All categories', 'flatmarket' ) ?></option>
        <?php foreach( $product_categories as $cat ) {
        echo '<option value="'. $cat->slug .'">' . $cat->name . '</option>';
        }
        ?>
        </select><input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search' ); ?>" /><input type="hidden" name="post_type" value="product" />
	</div>
</form>