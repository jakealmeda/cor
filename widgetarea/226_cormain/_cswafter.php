/* BASE_226 | WIDGETAREA | 226_BASE | CSWAFTER - 2016-03-24 */

//* Apply widget area - aftercsw
add_action( 'genesis_after_content_sidebar_wrap', 'base226_cswafter' );
	function base226_cswafter() {
		if (is_front_page()) {
			genesis_widget_area( 'cswafter', array(
				'before' => '<div class="cswafter widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			genesis_widget_area( 'cswafter', array(
				'before' => '<div class="cswafter widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		}
	}

//* Register widget area - cswafter
genesis_register_sidebar( array(
	'id'            => 'cswafter',
	'name'          => __( 'After CSW', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed after content sidebar wrap area', 'base-226' ),
) );