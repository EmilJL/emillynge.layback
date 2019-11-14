<?php
		
	/* 
	 * Hide upate buttons on everything that isn't a local environment
	 * 
	 * Checks the $_SERVER_ADDR address for ::! or 127.0.0.1.
	*/

	$serverinfo = $_SERVER;
	$addr = $serverinfo['SERVER_ADDR'];

	if($addr != '::1' && $addr != '127.0.0.1' ){

		add_action('admin_enqueue_scripts', 'admin_style');
		function admin_style() {
?>

	<style type="text/css">
		.plugins .plugin-update-tr .notice,
		.wp-menu-name .update-plugins,
		#update-nag,
		.update-nag,
		a[href="update-core.php"]{
			display: none !important;
		}
	</style>

<?php 
		}
	}