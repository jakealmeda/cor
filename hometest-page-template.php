<?php

/**
* Template Name: HomeTest
* Description: Template used for the about page
*/

// Add custom body class to the head
add_filter( 'body_class', 'sk_add_body_class' );
function sk_add_body_class( $classes ) {
   $classes[] = 'sk-sales';
   return $classes;
}

//* Apply widget area - cswbefore
add_action( 'genesis_before_content_sidebar_wrap', 'swp_cswbefore' );
function swp_cswbefore() {
	genesis_widget_area( 'cswbefore-home', array(
		'before' => '<div class="cswbefore widget-area hide-desktop"><div class="areawrap">',
		'after' => '</div></div>',
	) );
}

// FEATURERIGHT (HOMEPAGE)
// FEATURELEFT (HOMEPAGE)
// FEATUREMAIN (HOMEPAGE)
add_action( 'genesis_after_loop', 'swp_belowloophome' );
function swp_belowloophome() {
	genesis_widget_area( 'featureleft', array(
		'before' => '<div class="featureleft featurearea feature-60x60"><div class="areawrap">',
		'after' => '</div></div>',
	) );
	genesis_widget_area( 'featureright', array(
		'before' => '<div class="featureright featurearea feature-60x60"><div class="areawrap">',
		'after' => '</div></div>',
	) );
	genesis_widget_area( 'featuremain', array(
		'before' => '<div class="featuremain featurearea feature-150x150"><div class="areawrap">',
		'after' => '</div></div>',
	) );
}

// FEATURELEFT (HOMEPAGE)
//* Register widget area - featureleft
genesis_register_sidebar( array(
	'id'            => 'featureleft',
	'name'          => __( 'Feature Left', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the left feature area', 'basic-226' ),
) );

// FEATURERIGHT (HOMEPAGE)
//* Register widget area - featureright
genesis_register_sidebar( array(
	'id'            => 'featureright',
	'name'          => __( 'Feature Right', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the right feature area', 'basic-226' ),
) );

// FEATUREMAIN (HOMEPAGE)
//* Register widget area - featuremain
genesis_register_sidebar( array(
	'id'            => 'featuremain',
	'name'          => __( 'Feature Main', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the main feature area', 'basic-226' ),
) );

genesis();