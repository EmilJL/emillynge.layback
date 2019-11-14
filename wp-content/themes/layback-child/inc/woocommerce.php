<?php

	// Support for galleri in W3.0 and newer
	// add_theme_support( 'wc-product-gallery-zoom' );
	// add_theme_support( 'wc-product-gallery-lightbox' );
	// add_theme_support( 'wc-product-gallery-slider' );

	// Remove connect to woocommerce message
	add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );

	// Woocommerce styling
	function layback_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );		// Remove the gloss
		unset( $enqueue_styles['woocommerce-layout'] );			// Remove the layout
		unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		return $enqueue_styles;
	}
	add_filter( 'woocommerce_enqueue_styles', 'layback_dequeue_styles' );
	
	// Change number or products per row to 3
	// add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns'))
	{
		function loop_columns() {
			return 3;
		}
	}

    //Change number of products per page to 18
    // add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
    if(!function_exists('new_loop_shop_per_page'))
	{
        function new_loop_shop_per_page() {
            return 18;
        }
    }

    // Remove breadcrumb-funcitonality
	// add_action( 'init', 'lb_remove_wc_breadcrumbs' );
    function lb_remove_wc_breadcrumbs()
	{
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    }

	// Allow only 1 item in cart
//	add_filter( 'woocommerce_add_to_cart_validation', 'lb_custom_add_to_cart_before' );
	function lb_custom_add_to_cart_before( $cart_item_data )
	{
		global $woocommerce;
		$woocommerce->cart->empty_cart();

		return true;
	}

	// Change currency-symbol from "DKK" to "kr."
	add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
	function change_existing_currency_symbol( $currency_symbol, $currency ) {
		switch( $currency ) {
			case 'DKK':
				$currency_symbol = 'kr.';
				break;
		}
		return $currency_symbol;
	}