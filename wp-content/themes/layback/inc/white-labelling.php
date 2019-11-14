<?php
	// Admin footer modification
	function remove_footer_admin () {
		echo '<span id="footer-thankyou">' . esc_html__('Developed by', 'laybackparent') . ' <a href="https://www.laybackcph.dk" target="_blank">Layback ApS</a></span>';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');
?>