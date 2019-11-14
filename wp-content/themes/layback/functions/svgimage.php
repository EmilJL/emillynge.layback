<?php

function scaled_image_path($attachment_id, $size = 'thumbnail') {
    $file = get_attached_file($attachment_id, true);
    if (empty($size) || $size === 'full') {
        // for the original size get_attached_file is fine
        return realpath($file);
    }
    if (! wp_attachment_is_image($attachment_id) ) {
        return false; // the id is not referring to a media
    }
    $info = image_get_intermediate_size($attachment_id, $size);
    if (!is_array($info) || ! isset($info['file'])) {
        return false; // probably a bad size argument
    }

    return realpath(str_replace(wp_basename($file), $info['file'], $file));
}


	function svgimage($image_id, $echo = true){
		$image = wp_get_attachment_image( $image_id , 'full' );
		$imagetype = get_post_mime_type( $image_id );


		if(strpos($imagetype, 'svg') !== false)
		{

			$svglogo = scaled_image_path( $image_id , 'full' );

			echo file_get_contents($svglogo);

			
			/*
				Old function
			*/
			 // $svglogo = wp_get_attachment_image_src( $image_id , 'full' );

			 // if(defined('WP_SITEURL')){
			 // 	global $wpdb,$table_prefix;
			 // 	$prefix = $wpdb->prefix;
			 // 	$query = $wpdb->get_results("SELECT * FROM {$prefix}options WHERE option_name = 'siteurl' LIMIT 1");
			 	
			 // 	$dB_url = $query[0]->option_value;
			 	
			 // 	$http = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
			 // 	$this_url = $http.'://'.$_SERVER['HTTP_HOST'];
			 // 	$svg_logourl = str_replace($this_url, $dB_url, $svglogo);
			 	
			 // 	if($echo){
			 // 		echo file_get_contents($svg_logourl);
			 // 	} else {
			 // 		return file_get_contents($svg_logourl);
			 // 	}
			 // } else {
			 //	 echo file_get_contents($svglogo);
			 // }
		}
		else
		{
			if($echo){
				echo $image;
			} else {
				return $image;
			}
		}
	}
?>