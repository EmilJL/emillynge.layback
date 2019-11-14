<?php
	function lb_get_url()
	{
		$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
		$url .= '://' . $_SERVER['SERVER_NAME'];
		$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
		$url .= $_SERVER['REQUEST_URI'];
		return $url;
	}

	function lb_forcelogin()
	{
		$maintenance = get_option('options_lb_maintenancemode');

		if( !is_user_logged_in() && $maintenance == 1) {
			$url = lb_get_url();
			$whitelist = apply_filters('v_forcelogin_whitelist', array());
			$redirect_url = apply_filters('v_forcelogin_redirect', $url);
			
			if( preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', wp_login_url()) && !in_array($url, $whitelist) ) {
				wp_safe_redirect( wp_login_url( $redirect_url ), 302 ); exit();
			}
		}
	}
	add_action('init', 'lb_forcelogin');