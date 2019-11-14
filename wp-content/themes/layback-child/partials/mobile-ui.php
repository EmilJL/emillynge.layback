<div id="mobileicon" class="mobileicon">
	<span class="open"><?php _e( 'Menu', 'layback' ); ?></span>
	<span class="closed"><?php _e( 'Close', 'layback' ); ?></span>
</div>

<div id="mobilemenu" class="mobilemenu">
	
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

	<nav>
		<?php wp_nav_menu( array( 'theme_location' => 'mainmenu', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu-mobile', 'after' => '<span></span>' ) ); ?>
	</nav>

</div>