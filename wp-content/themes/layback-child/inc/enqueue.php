<?php 

	/* *******************************************************************************************
	********************************* Add CSS and JS files ***************************************
	******************************************************************************************* */
	add_action( 'wp_enqueue_scripts', 'enqueue_files' );
	function enqueue_files() 
	{

		wp_register_script( 'testScriptEmil', 'https://local.app.callanalytics.dk/client-scripts/15/emillyngelaybackdevdk.js', null, null, true );
		wp_enqueue_script('testScriptEmil');
		// wp_register_script('testScriptEmil', 'https://local.app.callanalytics.dk/client-scripts/15/emillyngelaybackdevdk.js', array('jquery'));
		// wp_enqueue_script('testScriptEmil');

// 		Normalize
		wp_enqueue_style( 'normalizecss', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css', false, '8.0.1', 'all' );
		
// 		Slick slideshow - https://github.com/kenwheeler/slick/
//		wp_enqueue_style( 'slickcss', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', false, '1.8.1', 'all' );
//		wp_enqueue_script( 'slickjs', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true );

//		jQuery cookies - https://github.com/js-cookie/js-cookie
//		wp_enqueue_script( 'cookiesjs', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array('jquery', 'site'), '1.0', true );
		
// 		Stylesheet for this site
//		wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:400,700', false, '1.0.0', 'all' );
//		wp_enqueue_style( 'woocommerce-style', get_stylesheet_directory_uri() . '/lib/css/woocommerce/woocommerce.css', false, filemtime(get_stylesheet_directory() . '/lib/css/woocommerce/woocommerce.css'), 'all' );
		wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/lib/css/style.css', false, filemtime(get_stylesheet_directory() . '/lib/css/style.css'), 'all' );

// 		This sites default javascript file
//		wp_enqueue_script( 'easing', get_stylesheet_directory_uri().'/lib/js/jquery.easing.1.3.js', array('jquery'), filemtime(get_stylesheet_directory() . '/lib/js/jquery.easing.1.3.js'), true );
		wp_enqueue_script( 'fontawesome', 'https://kit.fontawesome.com/4a41e46424.js', array('jquery'), '5.11.2', true );
		wp_enqueue_script( 'site', get_stylesheet_directory_uri().'/lib/js/site.js', array('jquery'), filemtime(get_stylesheet_directory() . '/lib/js/site.js'), true );
	}


	add_action( 'customize_preview_init', 'customizer_live_preview' );
	function customizer_live_preview()
	{
		wp_enqueue_script('theme-customizer', get_stylesheet_directory_uri() . '/lib/js/theme-customizer.js', array( 'jquery', 'customize-preview' ), filemtime(get_stylesheet_directory() . 'lib/js/theme-customizer.js'), true);
	}

	/* *******************************************************************************************
	************************************ Enqueues Admin ******************************************
	******************************************************************************************* */

	add_action('admin_enqueue_scripts', 'lb_enqueueStyle_admin');
	function lb_enqueueStyle_admin()
	{
		wp_enqueue_style('layback-admin', get_stylesheet_directory_uri() . '/lib/css/admin.css', array(), filemtime(get_stylesheet_directory() . '/lib/css/admin.css'));
	}

	// add_action('init', 'custom_editor_styles');
	function custom_editor_styles() {
		add_editor_style(get_stylesheet_directory_uri() . '/lib/css/editor.css');
	}

	/* *******************************************************************************************
	********************************* Defer and async scripts ************************************
	******************************************************************************************* */

	add_filter('script_loader_tag', 'lb_defer_attribute', 10, 2);
	add_filter('script_loader_tag', 'lb_async_attribute', 10, 2);
	function lb_defer_attribute($tag, $handle)
	{
		// add script handles to the array below
		$scripts_to_defer = array(
			'easing'
		);
		foreach($scripts_to_defer as $defer_script)
		{
			if ($defer_script === $handle) {
				return str_replace(' src', ' defer="defer" src', $tag);
			}
		}
		return $tag;
	}

	function lb_async_attribute($tag, $handle)
	{
		$scripts_to_async = array(
			'fontawesome',
			'easing',
		);

		foreach($scripts_to_async as $async_script)
		{
			if ($async_script === $handle)
			{
				return str_replace(' src', ' async="async" src', $tag);
			}
		}
		return $tag;
	}