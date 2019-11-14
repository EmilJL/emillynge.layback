<?php
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

	//Remember to add .php at the end of files
	$includes_skip = array();
	$functions_skip = array();
	$shortcodes_skip = array();

	// Required files
	foreach (glob(get_template_directory().'/inc/*.php') as $includes_filename)
	{
		if(in_array(basename($includes_filename), $includes_skip))
			continue;

		require_once($includes_filename);
	}

	foreach (glob(get_template_directory().'/shortcodes/*.php') as $shortcodes_filename)
	{
		if(in_array(basename($shortcodes_filename), $shortcodes_skip))
			continue;

		require_once($shortcodes_filename);
	}

	foreach (glob(get_template_directory().'/functions/*.php') as $functions_filename)
	{
		if(in_array(basename($functions_filename), $functions_skip))
			continue;

		require_once($functions_filename);
	}

	$MyUpdateChecker = new ThemeUpdateChecker(
		'layback',
		'https://kernl.us/api/v1/theme-updates/59e9f48412f7277508925c23/'
	);

	function layback_parent_style_enqueue()
	{
	    wp_enqueue_style('layback-parent-admin', get_template_directory_uri() . '/lib/css/admin.css', array(), filemtime(get_template_directory() . '/lib/css/admin.css'));
	}
	add_action('admin_enqueue_scripts', 'layback_parent_style_enqueue');

	function parent_enqueue_files()
	{
		wp_enqueue_script( 'function-scripts', get_template_directory_uri().'/lib/js/function-scripts.js', array('jquery'), filemtime(get_template_directory() . '/lib/js/function-scripts.js'), true );
	}
	add_action( 'wp_enqueue_scripts', 'parent_enqueue_files' );


	add_action('wp_ajax_lb_verify_domain', 'lb_verify_domain');
	add_action('wp_ajax_nopriv_lb_verify_domain', 'lb_verify_domain');
	function lb_verify_domain()
	{
		$domain = get_option('options_lb_sending_domain');
		$success = false;
		$msg = __('Du har ikke sat et afsender-domæne.', 'layback');
		$sp = '';
		
		if(isset($domain) && !empty($domain)){
			$payload = array(
				'dkim_verify' => true,
			);
			
			$sp = sparkpost('POST', 'sending-domains/'.$domain.'/verify', $payload, []);
			
			$sp_decoded = json_decode($sp);
			
			$success = $sp_decoded->results->dkim_status;
			$msg = $sp_decoded->results->dns->dkim_error;
		}
		
		update_option('lb_domain_verified', $success);
		update_option('lb_domain_verified_msg', $msg);

		echo json_encode(array(
			'domain'	=> $domain,
			'success'	=> $success,
			'msg'		=> $msg,
			'sp'		=> $sp_decoded,
		));
		die();
	}

	add_action('wp_ajax_lb_create_domain', 'lb_create_domain');
	add_action('wp_ajax_nopriv_lb_create_domain', 'lb_create_domain');
	function lb_create_domain(){
		$domain = $_POST['domain'];
		$success = false;

		$desc = '';
		$code = '';
		$msg = '';

		if(isset($domain) && !empty($domain)){
			update_option('options_lb_sending_domain', $domain);

			$payload = array(
				'domain'					=> $domain,
				'generate_dkim'				=> true,
				'shared_with_subaccounts'	=> false
			);
			
			$sp = sparkpost('POST', 'sending-domains', $payload, []);
			$sp_decoded = json_decode($sp);

			if(!isset($sp_decoded->errors) || empty($sp_decoded->errors)){
				$success = true;
			} else {
				$desc = $sp_decoded->errors[0]->description;
				$msg = $sp_decoded->errors[0]->message;
				$code = $sp_decoded->errors[0]->code;
			}
		}

		echo json_encode(array(
			'success'	=> $success,
			'sp'		=> $sp_decoded,
			'domain'	=> $domain,
			'msg'		=> $msg,
			'desc'		=> $desc,
			'code'		=> $code,
			'payload'	=> $payload,
		));
		die();
	}

	//Make it possible to upload SVG
	function lb_allow_svgs($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'lb_allow_svgs');

	// local json
	function layback_acf_json_load_point( $paths ) {
	    
	    // remove original path (optional)
	    unset($paths[0]);
	    
	    
	    // append path
	    $paths[] = get_template_directory() . '/acf-local-json';
	    $paths[] = get_stylesheet_directory() . '/acf-json';
	    
	    // var_dump($paths);
	    // die();
	    
	    // return
	    return $paths;
	    
	}
	add_filter('acf/settings/load_json', 'layback_acf_json_load_point');

	// Remove console notice for backwards comp. jQuery Migrate
	add_action( 'wp_default_scripts', function( $scripts ) {
		if ( ! empty( $scripts->registered['jquery'] ) ) {
			$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
		}
	});

	// Add role class to body
	if(!function_exists('lb_admin_add_role_to_body'))
	{
		function lb_admin_add_role_to_body($classes) {
			if(is_admin() && get_option('options_lb_pluginsupdates') == '1'){
				if( explode('.', $_SERVER['SERVER_NAME'])[0] == 'local'){
					$classes .= ' local-site';
				} else {
					$classes .= ' live-site';
				}
			}

			return $classes;
		}
		add_filter('admin_body_class', 'lb_admin_add_role_to_body');
	}

	add_filter( 'auto_update_plugin', '__return_false' );
	add_filter( 'auto_update_theme', '__return_false' );