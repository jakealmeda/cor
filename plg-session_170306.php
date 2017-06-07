<?php
/**
 * Plugin Name: SPK - Sessions
 * Description: Sessions
 * Version: 1.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

/* ----------------------------------------------------------------------------
 * add function upon initial WP load
 * ------------------------------------------------------------------------- */
//add_action( 'init', 'spk_sessions_func', 1 );
add_action( 'send_headers', 'spk_sessions_func' );
function spk_sessions_func() {

	if( ! is_admin() ) {
		
		if( !isset( $_COOKIE[ 'understandingrelationships' ] ) ) {
			
			setcookie( 'understandingrelationships', 'Value', time() + 30, "/" );

			//echo 'Session: '.$_COOKIE[ 'understandingrelationships' ];

			//* Apply widget area - cswbefore
			add_action( 'genesis_before_content_sidebar_wrap', 'base226_cswbefore' );
			function base226_cswbefore() {
				if (is_front_page()) {
					genesis_widget_area( 'cswbefore-home', array(
						'before' => '<div class="hide-desktop cswbefore widget-area"><div class="areawrap"><section class="widget"><div class="widget-wrap"><div class="cswbefore widget-area"><div class="areawrap">'.spk_get_specific_post_content(),
						'after' => '</div></div></div></section></div></div>',
					) );
				} else {
					genesis_widget_area( 'cswbefore', array(
						'before' => '<div class="hide-desktop cswbefore widget-area"><div class="areawrap"><section class="widget hide-desktop"><div class="widget-wrap"><div class="cswbefore widget-area"><div class="areawrap">'.spk_get_specific_post_content(),
						'after' => '</div></div></div></section></div></div>',
					) );
				}
			}

		}    

	}
}

function spk_get_specific_post_content() {
	return do_shortcode( get_post_field( 'post_content', 22811, $context = 'display' ) );
}