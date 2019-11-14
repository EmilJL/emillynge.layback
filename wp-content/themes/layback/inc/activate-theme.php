<?php
	add_action( 'activated_plugin', 'detect_plugin_activation', 10, 2 );
	function detect_plugin_activation($plugin, $network_activation ) 
	{
		if($plugin == 'cookie-notice/cookie-notice.php')
		{
			$aOpnions = get_option('cookie_notice_options');
			$aOpnions['message_text'] = __('Vi anvender cookies til at sikre dig en god oplevelse på hjemmesiden.', 'layback');
			$aOpnions['refuse_text'] = __('Nej', 'layback');
			update_option('cookie_notice_options', $aOpnions, 'yes');
		}
	}

	add_action( 'after_setup_theme', 'the_theme_setup' );
	function the_theme_setup(){
		// First we check to see if our default theme settings have been applied.
		$the_theme_status = get_option( 'theme_setup_status' );
		
		// If the theme has not yet been used we want to run our default settings.
		if ( $the_theme_status !== '1' ) {
			$core_settings = array();


			foreach ( $core_settings as $k => $v ) {
				update_option( $k, $v );
			}
			// Delete dummy post, page and comment.
			wp_delete_post( 1, true );
			wp_delete_post( 2, true );
			wp_delete_comment( 1 );

			// Disable admin bar by default
			update_user_meta( $user_id = 1, 'show_admin_bar_front', $adminbar = false );

			// Change permalinks to "name on post"
			function reset_permalinks() {
			    global $wp_rewrite;
			    $wp_rewrite->set_permalink_structure( '/%postname%/' );
			}
			add_action( 'init', 'reset_permalinks' );
			
			// create new page
			$new_page_title = 'Forside';
			$new_page_content = file_get_contents( dirname(__FILE__) . '/text/front-page.php');
			$new_page_template = '';
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
				'post_type' => 'page',
				'post_title' => $new_page_title,
				'post_content' => $new_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
			);
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				if(!empty($new_page_template)){
					update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
			
			$std_page_title = 'Underside';
			$std_page_content = file_get_contents( dirname(__FILE__) . '/text/formatting-text.php');
			$page_check = get_page_by_title($std_page_title);
			$std_page = array(
				'post_type' => 'page',
				'post_title' => $std_page_title,
				'post_content' => $std_page_content,
				'post_status' => 'publish',
				'post_author' => 1,
			);
			if(!isset($page_check->ID)){
				$std_page_id = wp_insert_post($std_page);
			}

			// Once done, we register our setting to make sure we don't duplicate everytime we activate.
			update_option( 'theme_setup_status', '1' );
			
			// Lets let the admin know whats going on.
			$msg = '
			<div class="updated">
				<p>Tillykke! ' . get_option( 'current_theme' ) . 's tema er installeret og har nulstillet din side.</p>
			</div>';
//			add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
			add_action( 'admin_notices', 'lb_admin_notices_reactivate' );

			// Change reading option to static page
			$homepage = get_page_by_title( 'Forside' );

			if ( $homepage ){
			    update_option( 'page_on_front', $homepage->ID );
			    update_option( 'show_on_front', 'page' );
			}
		}
		// Else if we are re-activing the theme
		elseif ( $the_theme_status === '1' and isset( $_GET['activated'] ) ) {
			$msg = '
			<div class="updated">
					<p>Sådan! ' . get_option( 'current_theme' ) . ' er gen-aktiveret.</p>
			</div>';
//			add_action( 'admin_notices', $c = create_function( '', 'echo "' . addcslashes( $msg, '"' ) . '";' ) );
			add_action( 'admin_notices', 'lb_admin_notices_reactivate' );
		}

		// disable color scheme adminpanel
		remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
		
	}

	function lb_admin_notices_activate($msg){
		$msg = '
		<div class="updated">
			<p>Tillykke! ' . get_option( 'current_theme' ) . 's tema er installeret og har nulstillet din side.</p>
		</div>';

		echo addcslashes( $msg, '"' );
	}

	function lb_admin_notices_reactivate($msg){
		$msg = '
		<div class="updated">
				<p>Sådan! ' . get_option( 'current_theme' ) . ' er gen-aktiveret.</p>
		</div>';

		echo addcslashes( $msg, '"' );
	}
