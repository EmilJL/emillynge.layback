<?php
	// activating featured image
	add_theme_support( 'post-thumbnails' );

	// wp_head title tag
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'     		 => 100,
		'width'       		=> 400,
		'flex-height' 		=> true,
		'flex-width'  		=> true,
		'update_button'		=> __('Update'),
		'header-text' 		=> array( 'site-title', 'site-description' ),
	) );

	// HTML5 support
	add_theme_support( 'html5', array( 'gallery' ) );

	// Widgets
	// add_theme_support( 'customize-selective-refresh-widgets' );

	// RSS 
	add_theme_support( 'automatic-feed-links' );

	//Add Advanced Custom Field option-page
	if( function_exists('acf_add_options_page') ) {
		$parent = acf_add_options_page(array(
			'page_title' 	=> __('Settings', 'layback'),
			'menu_title' 	=> 'Layback',
			'redirect' 		=> false,
			'position' 			=> '998',
		));
		
		acf_add_options_sub_page(array(
			'page_title'	=> 'Scripts',
			'menu_title'	=> 'Scripts',
			'parent_slug'	=> $parent['menu_slug'],
			'capability'	=> 'administrator' // Change this if the client need to see the page.
		));
	}

	// Add menu separator above options
	add_action( 'admin_menu', function () {
	    $position = 997;
	    global $menu;
	    $separator = [
	        0 => '',
	        1 => 'read',
	        2 => 'separator' . $position,
	        3 => '',
	        4 => 'wp-menu-separator'
	    ];
	    if (isset($menu[$position])) {
	        $menu = array_splice($menu, $position, 0, $separator);
	    } else {
	        $menu[$position] = $separator;
	    }
	});