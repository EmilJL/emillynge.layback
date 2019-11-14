<div id="colophon" class="site-footer">

	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="widgets">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<p class="copyright">Copyright &copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?> <?php _e( 'All rights reserved', 'layback' ); ?></p>

</div>

<?php wp_footer(); ?>

</body>
</html>