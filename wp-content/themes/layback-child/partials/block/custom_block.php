<?php

	/**
	 * @param   array $block The block settings and attributes.
	 * @param   string $content The block inner HTML (empty).
	 * @param   bool $is_preview True during AJAX preview.
	 * @param   (int|string) $post_id The post ID this block is saved to.
	 */

	// create id attribute for specific styling
	$block_id 			= $block['id'];
	$block_filename 	= pathinfo(__FILE__, PATHINFO_FILENAME);

?>
<div id="<?php echo $block_id; ?>" class="block-<?php echo $block_filename; ?>">

	<!-- Insert block HTML here -->

</div>