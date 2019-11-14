<?php

	add_action('wp_footer', 'mobile_ui');
	function mobile_ui(){
		
		get_template_part( 'partials/mobile-ui');
		
	}