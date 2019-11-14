<?php
	//Disable update_meta_cache if more than 3 posts on page
	function cache_meta_data( $posts, $object ) {
	    $posts_to_cache = array();
	    // this usually makes only sense when we have a bunch of posts
	    if ( empty( $posts ) || is_wp_error( $posts ) || is_single() || is_page() || count( $posts ) < 3 )
	        return $posts;

	    foreach( $posts as $post ) {
	        if ( isset( $post->ID ) && isset( $post->post_type ) ) {
	            $posts_to_cache[$post->ID] = 1;
	        }
	    }

	    if ( empty( $posts_to_cache ) )
	        return $posts;

	    update_meta_cache( 'post', array_keys( $posts_to_cache ) );
	    unset( $posts_to_cache );

	    return $posts;
	}
	add_filter( 'posts_results', 'cache_meta_data', 9999, 2 );