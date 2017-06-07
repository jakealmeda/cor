/* BASE_226 | WIDGETAREA | 226_BASE | CSWBEFORE - 2016-03-24 */

//* Apply widget area - beforecsw
add_action( 'genesis_before_content_sidebar_wrap', 'base226_beforecsw' );
	function base226_beforecsw() {
		if (is_front_page()) {
			genesis_widget_area( 'beforecsw', array(
				'before' => '<div class="beforecsw widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			genesis_widget_area( 'beforecsw', array(
				'before' => '<div class="beforecsw widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		}
	}

//* Register widget area - beforecsw
genesis_register_sidebar( array(
	'id'            => 'beforecsw',
	'name'          => __( 'Before CSW', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed before content sidebar wrap area', 'base-226' ),
) );