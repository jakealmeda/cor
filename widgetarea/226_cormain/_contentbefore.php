/* BASE_226 | WIDGETAREA | 226_BASE | CONTENTBEFORE - 2016-03-24 */

//* Apply widget area - beforecontent
add_action( 'genesis_before_content', 'base226_beforecontent' );
	function base226_beforecontent() {
		if (is_front_page()) {
			genesis_widget_area( 'beforecontent', array(
				'before' => '<div class="beforecontent widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			genesis_widget_area( 'beforecontent', array(
				'before' => '<div class="beforecontent widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		}
	}

//* Register widget area - beforecontent
genesis_register_sidebar( array(
	'id'            => 'beforecontent',
	'name'          => __( 'Before Content', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed before content sidebar wrap area', 'base-226' ),
) );