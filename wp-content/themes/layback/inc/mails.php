<?php
	// DISABLE default WordPress change password notifications
	if (!function_exists('wp_password_change_notification')) {
	    function wp_password_change_notification($user) {
	    	return;
	    }
	}
	if (!function_exists('wp_new_user_notification')) {
	    function wp_new_user_notification($user) {
	    	return;
	    }
	}