<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the COR Theme.
 *
 * @package COR
 * @author  Mark Corpuz
 * @license GPL-2.0+
 * @link    http://markcorpuz.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'base-starter', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'COR' );
define( 'CHILD_THEME_URL', 'http://smarterwebpackages.com' );
define( 'CHILD_THEME_VERSION', '2.3.0.1' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'basestarter_enqueue_scripts_styles' );
function basestarter_enqueue_scripts_styles() {

	wp_enqueue_style( 'basestarter-fonts', '//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Roboto+Condensed:300,400,700|Lato:100,300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'basestarter-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'basestarter-responsive-menu',
		'genesis_responsive_menu',
		basestarter_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function basestarter_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'base-starter' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'base-starter' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 405, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Top Menu', 'genesis-sample' ), 'secondary' => __( 'Header Menu', 'genesis-sample' ) ) );

// Reposition the primary navigation menu.
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_header_right', 'genesis_do_subnav', 5 );

// Reposition the secondary navigation menu.
//remove_action( 'genesis_after_header', 'genesis_do_subnav' );
//add_action( 'genesis_before_header', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

//* Customize the entire footer | functions-sitefooter
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'spt_sitefooter' );
function spt_sitefooter() {
	?>
	<div class="siteby"><a href="http://smarterwebpackages.com/">SmarterWebPackages.com</a></div>
	<div class="copyright">Copyright © 2016 UnderstandingRelatonships.com | All Rights Reserved | <a href="http://www.understandingrelationships.com/privacy-policy/">Privacy Policy</a><br>
	The Corey Wayne Companies | Orlando, FL USA</div>
	<?php
}








//* Remove p tags around images
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

//* Customize the post info function
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
	function sp_post_info_filter($post_info) {
		if ( !is_page() ) {
			$post_info = 'By [post_author_posts_link] | [post_comments] [post_edit]';
			return $post_info;
		}
	}

//* Customize the entry meta in the entry footer (requires HTML5 theme support)
add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
	function sp_post_meta_filter($post_meta) {
		$post_meta = '[post_categories before="Categories: "] [post_tags before="Tags: "]';
		return $post_meta;
	}

//* Apply widget area - beforecontent
add_action( 'genesis_before_content', 'base226_beforecontent' );
	function base226_beforecontent() {
		if (is_front_page()) {
			genesis_widget_area( 'beforecontent', array(
				'before' => '<div class="home beforecontent widget-area"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {}
	}

//* Apply widget area - cswbefore
add_action( 'genesis_before_content_sidebar_wrap', 'base226_cswbefore' );
	function base226_cswbefore() {
		if (is_front_page()) {
			genesis_widget_area( 'cswbefore-home', array(
				'before' => '<div class="cswbefore widget-area hide-desktop"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			genesis_widget_area( 'cswbefore', array(
				'before' => '<div class="cswbefore widget-area hide-desktop"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		}
	}

//* Apply widget area - cswafter
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

//* Apply widget area - subscribetop
add_action( 'genesis_before_content_sidebar_wrap', 'basic2124_subscribetop' );
    function basic2124_subscribetop() {
        if (is_front_page()) {
			genesis_widget_area( 'subscribetop', array(
				'before' => '<div class="subscribetop"><div class="areawrap">',
				'after' => '</div></div>',
			) );
        }
        if (is_page( 'free-ebook' )) {
			genesis_widget_area( 'subscribetop', array(
				'before' => '<div class="subscribetop"><div class="areawrap">',
				'after' => '</div></div>',
			) );
        }
    }

//* Apply widget area - belowcsw
add_action( 'genesis_after_content_sidebar_wrap', 'basic2124_belowcsw' );
	function basic2124_belowcsw() {
		if (is_front_page()) {
			genesis_widget_area( 'belowcsw', array(
				'before' => '<div class="belowcsw"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			genesis_widget_area( 'belowcsw', array(
				'before' => '<div class="belowcsw"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		}
	}

//* Apply widget area - aboveloop
add_action( 'genesis_before_loop', 'basic227_aboveloop' );
	function basic227_aboveloop() {
		if (is_front_page()) {
			genesis_widget_area( 'aboveloophome', array(
				'before' => '<div class="aboveloop"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		} else {
			genesis_widget_area( 'aboveloop', array(
				'before' => '<div class="aboveloop"><div class="areawrap">',
				'after' => '</div></div>',
			) );
		}
	}

// FEATURERIGHT (HOMEPAGE)
// FEATURELEFT (HOMEPAGE)
// FEATUREMAIN (HOMEPAGE)
add_action( 'genesis_after_loop', 'base226_belowloophome' );
	function base226_belowloophome() {
		if (is_front_page()) {
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
		} else {
			// nothing
		}
	}

// FEATUREINPOST (SINGLE POST)
add_action( 'genesis_entry_footer', 'base226_entryfooter' );
	function base226_entryfooter() {
	    if (is_single()) {
		    genesis_widget_area( 'featureinpost', array(
				'before' => '<div class="featureinpost featurearea feature-150x150"><div class="areawrap">',
				'after' => '</div></div>',	    	
	    	) ); 
		} else {
			// nothing
		}
	}

// ----- SIGNATURE SHORTCODE

function signature_shortcode() {
	return '<div class="divider-line space-bottom"></div><p>If you have a question you would like me to consider answering in a future Video Coaching Newsletter, you can send it <strong>(3-4 paragraphs/500 words max)</strong> to this email address: <a class="fontsize-xxsml" class="link2" href="mailto:questions@understandingrelationships.com">Questions@UnderstandingRelationships.com</a></p><p>If you feel I have added value to your life, you can show your appreciation by doing one of the following three things:</p><p><strong>1)</strong> Make a donation to my work by <strong><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LKGTSSLYJ93J6">clicking here to donate via PayPal</a></strong> anytime you feel I have added significant value to your life. You tip your favorite bartender, right? How about a buck… $2… $3… $5… $10… $20… what ever YOU feel its worth, every time you feel I have given you a good tip, new knowledge or helpful insight. Please feel free to donate any amount you think is equal to the value you received from my eBook & Home Study Course (audio lessons), articles, videos, emails, newsletters, etc.</p><p><strong>2)</strong> Referring your friends and family to this website so they can start learning and improving their dating and relationship life, happiness, balance and overall success in every area of their lives too!</p><p><strong>3)</strong>Purchase a phone/Skype coaching session or email coaching for yourself or a friend by <strong><a href="http://www.understandingrelationships.com/products">clicking here</a></strong>. Download the Amazon.com Kindle version of my book to your Kindle, Smartphone, Mac or PC for only <strong>$9.99</strong> by <strong><a href="http://www.amazon.com/gp/product/B004QOBAPK/ref=as_li_ss_tl?ie=UTF8&tag=understand0d4-20&linkCode=as2&camp=217145&creative=399373&creativeASIN=B004QOBAPK">clicking here</a></strong>. That way, you’ll always have it with you to reference when you need it most. Thank you for reading this message!</p><p>From my heart to yours,</p><p><img width="207" border="0" height="67" alt="" src="http://www.understandingrelationships.com/images/coreysig1.jpg"><br>Corey Wayne<br>Author, Speaker, Peak Performance Coach, Entrepreneur</p>';
}
add_shortcode('signature', 'signature_shortcode');

// -----

// ----- GRAVITY FORMS FILTER

//* Add html disclaimer below form 1
add_filter( 'gform_submit_button_1', 'add_html_below_submit_form_sidebar', 10, 2 );
function add_html_below_submit_form_sidebar( $button, $form ) {
   return $button .= '<p class="fontsize-xxsml space-top textleft space-bottom-zero">Enter your name & email in the boxes above to gain access to a FREE Digital Online Version of my popular eBook & audio course. You\'ll receive the link to access the eBook & Audio Lessons after confirming that your email is correct. After confirmation, you will gain access to the members area of my website to read my eBook, & listen to the audio lessons right in your web browser! You\'ll also get my best pickup, dating, relationship & life coaching secrets in my FREE newsletter. All information is 100% confidential. “Employ your time in improving yourself by other men\'s writings, so that you shall gain easily what others have labored hard for.” ~ Socrates. "The man who doesn\'t read good books has no advantage over the man who can\'t read them." ~ Mark Twain</p>';
}

//* Add html disclaimer below form 1
add_filter( 'gform_submit_button_4', 'add_html_below_submit_form_responsive', 10, 2 );
function add_html_below_submit_form_responsive( $button, $form ) {
   return $button .= '<p class="fontsize-xxsml space-top textleft space-bottom-zero">Enter your name & email in the boxes above to gain access to a FREE Digital Online Version of my popular eBook & audio course. You\'ll receive the link to access the eBook & Audio Lessons after confirming that your email is correct. After confirmation, you will gain access to the members area of my website to read my eBook, & listen to the audio lessons right in your web browser! You\'ll also get my best pickup, dating, relationship & life coaching secrets in my FREE newsletter. All information is 100% confidential. “Employ your time in improving yourself by other men\'s writings, so that you shall gain easily what others have labored hard for.” ~ Socrates. "The man who doesn\'t read good books has no advantage over the man who can\'t read them." ~ Mark Twain</p>';
}

// -----

//* Register widget area - aboveloop
genesis_register_sidebar( array(
	'id'            => 'aboveloop',
	'name'          => __( 'Above Loop', 'base-227' ),
	'description'   => __( 'This is a widget area that can be placed above the loop', 'basic-227' ),
) );

//* Register widget area - aboveloophome
genesis_register_sidebar( array(
	'id'            => 'aboveloophome',
	'name'          => __( 'Above Loop Home', 'base-227' ),
	'description'   => __( 'This is a widget area that can be placed above the loop', 'basic-227' ),
) );

//* Register widget area - subscribetop
genesis_register_sidebar( array(
	'id'            => 'subscribetop',
	'name'          => __( 'Subscribe', 'basic-2123' ),
	'description'   => __( 'This is a widget area assigned specifically for subscriptions above the fold', 'basic-2123' ),
) );

//* Register widget area - entryfooter
genesis_register_sidebar( array(
	'id'            => 'entryfooter',
	'name'          => __( 'Entry Footer', 'base226' ),
	'description'   => __( 'This is a widget area that can be placed immediately below the post ends', 'base226' ),
) );

//* Register widget area - belowloop
genesis_register_sidebar( array(
	'id'            => 'belowloop',
	'name'          => __( 'Below Loop', 'basic-2123' ),
	'description'   => __( 'This is a widget area that can be placed below the header', 'basic-2123' ),
) );

//* Register widget area - belowloop
genesis_register_sidebar( array(
	'id'            => 'belowloop-home',
	'name'          => __( 'Below Loop Home', 'basic-2123' ),
	'description'   => __( 'This is a widget area that can be placed below the header', 'basic-2123' ),
) );

// UPDATED WIDGETS

//* Register widget area - minisidebar
genesis_register_sidebar( array(
	'id'            => 'minisidebar',
	'name'          => __( 'Mini Sidebar', 'base-227' ),
	'description'   => __( 'This is a widget area that can be placed before the csw', 'base-227' ),
) );

//* Register widget area - beforecontent
genesis_register_sidebar( array(
	'id'            => 'beforecontent',
	'name'          => __( 'Before Content', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed before the content area', 'base-226' ),
) );

//* Register widget area - cswbefore
genesis_register_sidebar( array(
	'id'            => 'cswbefore',
	'name'          => __( 'CSW Before', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed before content sidebar wrap area', 'base-226' ),
) );

//* Register widget area - cswbefore-home
genesis_register_sidebar( array(
	'id'            => 'cswbefore-home',
	'name'          => __( 'CSW Before Home', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed before content sidebar wrap area', 'base-226' ),
) );

//* Register widget area - cswafter
genesis_register_sidebar( array(
	'id'            => 'cswafter',
	'name'          => __( 'CSW After', 'base-226' ),
	'description'   => __( 'This is a widget area that can be placed after content sidebar wrap area', 'base-226' ),
) );

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

// FEATUREINPOST (SINGLE POST)
//* Register widget area - featureinpost
genesis_register_sidebar( array(
	'id'            => 'featureinpost',
	'name'          => __( 'Feature Inpost', 'basic-226' ),
	'description'   => __( 'This is a widget area that displays the feature area after post entries', 'basic-226' ),
) );