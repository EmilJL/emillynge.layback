<?php
	add_action( 'wp_footer', 'script_in_footer', 100);
	function script_in_footer() {
		echo stripslashes(get_field('footer_scripts', 'option'));
	}

	add_action( 'wp_head', 'script_in_header');
	function script_in_header() {
		echo stripslashes(get_field('header_scripts', 'option'));
	}