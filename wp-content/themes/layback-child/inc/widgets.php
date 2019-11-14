<?php
	
	// WIDGETS
	function widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'layback' ),
			'id'            => 'sidebar',
			'description'   => __( 'Place your widgets here', 'layback' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Footer widgets', 'layback' ),
			'id'            => 'footer',
			'description'   => __( 'Place your widgets here', 'layback' ),
			'before_widget' => '<div id="%1$s" class="col-xs-12 col-sm-12 col-md col-lg widget %2$s">', // this line is replaced by layback_dynamic_sidebar_params() further down
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	// add_action( 'widgets_init', 'widgets_init' );


	// function layback_dynamic_sidebar_params( $params ) {

	// 	// get widget vars
	// 	$sidebar_id = $params[0]['id'];
	// 	$widget_id = $params[0]['widget_id'];
	// 	$widget_name = $params[0]['widget_name'];
	// 	$class = 'class="' . get_field('widget_class', 'widget_' . $widget_id) . ' ';

	// 	// check if our class exist and it's the right sidebar
	// 	if( $class && $sidebar_id == 'footer')
	// 	{
	// 		$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']);
	// 	}
		
	// 	// return
	// 	return $params;

	// }
	// add_filter('dynamic_sidebar_params', 'layback_dynamic_sidebar_params');