<?php
/**
 * prismOs functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prismOs
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function prismos_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on prismOs, use a find and replace
		* to change 'prismos' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'prismos', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'prismos' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'prismos_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'prismos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function prismos_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'prismos_content_width', 640 );
}
add_action( 'after_setup_theme', 'prismos_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function prismos_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'prismos' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'prismos' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'prismos_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function prismos_scripts() {
	wp_enqueue_style( 'prismos-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'prismos-style', 'rtl', 'replace' );

	wp_enqueue_script( 'prismos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'prismos_scripts' );
function enqueue_theme_styles() {
    // Get the theme directory URI
    $theme_dir = get_template_directory_uri();

    // Array of stylesheets to enqueue
    $stylesheets = array(
        'common-style'    => '/css/common.css',
        'custom-style'    => '/css/custom.css',
    );

    // Enqueue each stylesheet
    foreach ($stylesheets as $handle => $path) {
        wp_enqueue_style($handle, $theme_dir . $path, array(), '1.0', 'all');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_styles');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
// register header mega menu
// register menu location
function prismos_register_menus() {
    register_nav_menus([
        'primary_menu' => __('Primary Menu', 'prismos')
    ]);
}
add_action('init', 'prismos_register_menus');

// include the walker file
require_once get_template_directory() . '/inc/class-prismos-mega-menu-walker.php';

// enqueue menu css + js
function prismos_enqueue_menu_assets() {
    wp_enqueue_style('prismos-menu-css', get_template_directory_uri() . '/assets/css/menu.css', array(), '1.0');
    wp_enqueue_script('prismos-menu-js', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'prismos_enqueue_menu_assets');

//footer menu
// Register Footer Menus
function register_footer_menus() {
    register_nav_menus(array(
        'footer-services' => __('Footer Services Menu'),
        'footer-platform' => __('Footer Platform Menu'),
        'footer-whyus' => __('Footer Why Us Menu'),
        'footer-resources' => __('Footer Resources Menu'),
        'footer-company' => __('Footer Company Menu'),
    ));
}
add_action('init', 'register_footer_menus');

// youtube video popup
function load_video_popup_script() {
    wp_enqueue_script(
        'video-popup',
        get_template_directory_uri() . '/js/video-popup.js',
        array('jquery'),
        null,
        true // load in footer
    );
}
add_action('wp_enqueue_scripts', 'load_video_popup_script');
//slick slider
function enqueue_slick_slider() {
    // Enqueue Slick CSS files
    wp_enqueue_style('slick-css', get_template_directory_uri() . '/slick/slick.css');
    wp_enqueue_style('slick-theme-css', get_template_directory_uri() . '/slick/slick-theme.css');
    wp_enqueue_style('slick-font-override', get_template_directory_uri() . '/css/slick-font-override.css', array('slick-theme-css'), null);

    
    // Enqueue Slick JS file
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), null, true);

    // Initialize Slick Slider
   wp_add_inline_script(
    'slick-js',
    'jQuery(document).ready(function($){
        $(".testimonial-slider").slick({
            autoplay: true,
            dots: false,
            arrows: false,
            slidesToShow: 2,
            responsive: [
                {
                    breakpoint: 767, // tablets & mobile
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });'
);
wp_add_inline_script(
    'slick-js',
    'jQuery(document).ready(function($){
        $(".strategy-slide").slick({
            autoplay: false,
            dots: false,
            arrows: false,
            slidesToShow: 1,
            responsive: [
                {
                    breakpoint: 767, // tablets & mobile
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });'
);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');