<?php

	// add_action('acf/init', 'lb_block_');
	// function lb_block_() {

	// 	// check function exists.
	// 	if( function_exists('acf_register_block') ) {

	// 		$block_name 			= ''; // block_name must be the same as the rendered filename
	// 		$block_friendlyname 	= __('', 'layback');
	// 		$block_description 		= __('A block created for this website');
	// 		$block_keywords 		= array($block_friendlyname);
	// 		// $block_post_types		= array('post', 'page');
	// 		$block_svg				= '';

	// 		// register a hero block.
	// 		acf_register_block(array(
	// 			'name'              => $block_name,
	// 			'title'             => $block_friendlyname,
	// 			'description'       => $block_description,
	// 			'keywords'			=> $block_keywords,
	// 			'render_template'   => 'partials/block/' . $block_name . '.php',
	// 			'icon'              => $block_svg,
	// 			'category'          => 'layback',
	// 			// 'post_types' 		=> $block_post_types,
	// 			'mode' 				=> 'edit',
	// 			'supports' 			=> array(
	// 				'align' => false,
	// 			),
	// 		));
	// 	}
	// }