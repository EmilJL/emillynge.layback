<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php wp_head(); ?>
	
	<?php $http = isset($_SERVER["HTTPS"]) ? 'https' : 'http'; ?>
	<script>
		var ajaxurl = '<?php echo strtolower($http).'://'.$_SERVER['HTTP_HOST'].'/wp-admin/admin-ajax.php';  ?>';
	</script>
</head>
<body <?php body_class(); ?>>
	
	<?php do_action('lb_after_body_tag'); ?>

	<div id="header" class="site-header">

		<div class="container">

			<a class="site-logo" href="<?php echo get_bloginfo('url'); ?>">
				<?php 
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					if($custom_logo_id)
					{
						svgimage($custom_logo_id);
					}
					else
					{
						echo '<h1>' . get_bloginfo('name') . '</h1>';
					}
				?>
			</a>

		</div>

		<div class="container">
			<div class="hidden-xs hidden-sm hidden-md">
				<nav class="site-navigation">
					<?php 
						$args = array(
							'container'			=> 'ul',
							'theme_location' 	=> 'mainmenu',
							'menu_class' 		=> 'nav-menu',
							'menu_id' 			=> 'primary-menu-mobile',
							'after' 			=> '<span></span>'
						);
						wp_nav_menu( $args );
					?>
				</nav>
			</div>
		</div>
	</div>