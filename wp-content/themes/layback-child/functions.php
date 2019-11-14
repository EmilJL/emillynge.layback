<?php
/*
 * If you want to use date() (PHP) and not of current_time() (WP)
 * You have to uncomment the line below.
 */
//	date_default_timezone_set(get_option( 'timezone_string' )); //Current timezone selected in WP Admin
//	date_default_timezone_set('Europe/Copenhagen'); //Copenhagen timezone

	if(!function_exists('lb_is_plugin_active_for_network'))
	{
		function lb_is_plugin_active_for_network( $plugin )
		{
			if ( !is_multisite() )
				return false;

			$plugins = get_site_option( 'active_sitewide_plugins');
			if ( isset($plugins[$plugin]) )
				return true;

			return false;
		}
	}

	if(!function_exists('lb_is_plugin_active'))
	{
		function lb_is_plugin_active( $plugin )
		{
			return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || lb_is_plugin_active_for_network( $plugin );
		}
	}

	///////////////////////////////////////////////////////////////////////
	//////////////////////////////  FUNCTIONS /////////////////////////////
	///////////////////////////////////////////////////////////////////////

	//Remember to add .php at the end of files
	$skip_functions = array(
		// 'woocommerce.php',
	);

	// Required files
	foreach (glob(get_stylesheet_directory().'/inc/*.php') as $function_filename)
	{
		if(in_array(basename($function_filename), $skip_functions))
			continue;

		require_once($function_filename);
	}

	///////////////////////////////////////////////////////////////////////
	///////////////////////////////  BLOCKS ///////////////////////////////
	///////////////////////////////////////////////////////////////////////

	//Remember to add .php at the end of files
	$skip_blocks = array(
		// 'custom_block.php',
	);

	// Required files
	foreach (glob(get_stylesheet_directory().'/blocks/*.php') as $block_filename)
	{
		if(in_array(basename($block_filename), $skip_blocks))
			continue;

		require_once($block_filename);
	}

	///////////////////////////////////////////////////////////////////////
	//////////////////////////////  BODY TAG //////////////////////////////
	///////////////////////////////////////////////////////////////////////
	function lb_after_body_tag()
	{
		echo stripslashes(get_field('body_top_scripts', 'option'));
	}
	add_action('lb_after_body_tag', 'lb_after_body_tag');