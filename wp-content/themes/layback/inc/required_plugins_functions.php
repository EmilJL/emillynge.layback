<?php

/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', 'lb_register_required_plugins' );
function lb_register_required_plugins() {

	$plugins = array(
		array(
			'name' 				=> 'Advanced Custom Fields PRO',
			'slug' 				=> 'advanced-custom-fields-pro',
			'required' 			=> true,
			'force_activation'	=> true,
			'source'			=> 'https://connect.advancedcustomfields.com/index.php?a=download&p=pro&k=b3JkZXJfaWQ9NjQyMDd8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE1LTA5LTE1IDA0OjU5OjI3',
			'external_url'		=> 'https://advancedcustomfields.com/',
		),

		array(
			'name'              => 'Formidable Forms',
			'slug'              => 'formidable',
			'required'          => false,
			'force_activation'  => false,
			'external_url'		=> 'https://formidableforms.com/',
		),
		
		array(
			'name'              => 'Cookie Notice by dFactory',
			'slug'              => 'cookie-notice',
			'required'          => false,
			'force_activation'  => false,
			'external_url'		=> 'https://wordpress.org/plugins/cookie-notice/',
		),

		array(
			'name' 				=> 'WordPress SEO by Yoast',
			'slug' 				=> 'wordpress-seo',
			'required' 			=> false,
			'force_activation'	=> false,
			'is_callable'		=> 'wpseo_init',
		),
		
		array(
			'name' 				=> 'Mailgun for WordPress',
			'slug' 				=> 'mailgun',
			'required' 			=> false,
			'force_activation'	=> false,
		),
		
		array(
			'name' 				=> 'Simple 301 Redirects',
			'slug' 				=> 'simple-301-redirects',
			'required' 			=> false,
			'force_activation'	=> false,
		),
		
		array(
			'name' 				=> 'Really Simple SSL',
			'slug' 				=> 'really-simple-ssl',
			'required' 			=> false,
			'force_activation'	=> false,
		),
		
		array(
			'name' 				=> 'Safe SVG',
			'slug' 				=> 'safe-svg',
			'required' 			=> false,
			'force_activation'	=> false,
			'external_url'		=> 'https://da.wordpress.org/plugins/safe-svg/',
		),

		// array(
		// 	'name' 				=> 'WooCommerce Google Analytics Integration',
		// 	'slug' 				=> 'woocommerce-google-analytics-integration',
		// 	'required' 			=> false,
		// 	'force_activation'	=> false,
		// ),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
			'installing'                      => __( 'Installing Plugin: %s', 'theme-slug' ), // %s = plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'theme-slug' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'theme-slug'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'theme-slug'
			),
			'update_link'                     => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'theme-slug'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'theme-slug'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'theme-slug' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'theme-slug' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'theme-slug' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'theme-slug' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'theme-slug' ),  // %1$s = plugin name(s).
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'theme-slug' ), // %s = dashboard link.
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'tgmpa' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
		*/
	);

	tgmpa( $plugins, $config );

}

register_activation_hook( plugin_dir_path('') . '/cookie-notice/cookie-notice.php', 'lb_cookie_plugin_activated' );
function lb_cookie_plugin_activated()
{
	$cookie_options = array (
		'message_text'			=> 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.',
		'accept_text'			=> 'Acceptér',
		'see_more_opt'			=>  array (
			'text'					=> 'Read more',
			'link_type'				=> 'custom',
			'id'					=> 'empty',
			'link'					=> 'http://empty',
		),
		'link_target'			=> '_blank',
		'refuse_text'			=> 'No',
		'refuse_code'			=> '',
		'on_scroll_offset'		=> 100,
		'time'					=> 'month',
		'script_placement'		=> 'footer',
		'position'				=> 'bottom',
		'hide_effect'			=> 'fade',
		'css_style'				=> 'wp-default',
		'colors'				=> array (
			'text'					=> '#fff',
			'bar'					=> '#000',
		),
		'refuse_opt'			=> 'no',
		'on_scroll'				=> 'no',
		'redirection'			=> false,
		'deactivation_delete'	=> 'no',
		'see_more'				=> 'no',
		'translate'				=> false,
	);

	update_option('cookie_notice_options', $cookie_options, false);
}
