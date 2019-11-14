<?php

	//Add Advanced Custom Field option-page
	if( function_exists('acf_add_options_page') ) {

		$childoptions = acf_add_options_page(array(
			'page_title' 		=> __('Theme setup', 'layback'),
			'menu_title' 		=> __('Theme setup', 'layback'),
			'menu_slug'			=> 'client-theme-options',
			'redirect' 			=> false,
			'icon_url'			=> 'dashicons-businessman',
			'update_button'		=> __('Update'),
			'position' 			=> '999',
		));
		
		acf_add_options_sub_page(array(
			'page_title'	=> 'Kontakt',
			'menu_title'	=> 'Kontakt',
			'parent_slug'	=> $childoptions['menu_slug']
		));
		
	}