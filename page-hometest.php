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

genesis();