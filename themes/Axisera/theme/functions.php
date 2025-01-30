<?php
/**
 * kmpr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kmpr
 */

if ( ! defined( 'kmpr_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'kmpr_VERSION', '0.1.0' );
}
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	) );
}
if ( ! defined( 'kmpr_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `kmpr_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'kmpr_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'kmpr_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kmpr_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on kmpr, use a find and replace
		 * to change 'kmpr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'kmpr', get_template_directory() . '/languages' );

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
		// Register custom image sizes
		add_image_size('project-thumbnails', 900, 400, true); // Adjust height and cropping as needed

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'kmpr' ),
				'menu-2' => __( 'Footer Menu', 'kmpr' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'kmpr_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kmpr_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'kmpr' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'kmpr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kmpr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kmpr_scripts() {
	wp_enqueue_style('OCRAStd', get_template_directory_uri() . '/fonts/OCR/fontface.css', array());
	wp_enqueue_style( 'kmpr-style', get_stylesheet_uri(), array(), kmpr_VERSION );
	wp_enqueue_script( 'kmpr-script', get_template_directory_uri() . '/js/script.min.js', array(), kmpr_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kmpr_scripts' );

/**
 * Enqueue the block editor script.
 */
function kmpr_enqueue_block_editor_script() {
	if ( is_admin() ) {
		wp_enqueue_script(
			'kmpr-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			kmpr_VERSION,
			true
		);
		wp_add_inline_script( 'kmpr-editor', "tailwindTypographyClasses = '" . esc_attr( kmpr_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'kmpr_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function kmpr_tinymce_add_class( $settings ) {
	$settings['body_class'] = kmpr_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'kmpr_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
function optimize_site() {
	// Disable Emojis
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		return array_diff( $plugins, [ 'wpemoji' ] );
	} );
	add_filter( 'wp_resource_hints', function ( $urls, $relation_type ) {
		if ( 'dns-prefetch' === $relation_type ) {
			$emoji_url = 'https://s.w.org/images/core/emoji/';
			$urls = array_filter( $urls, function ( $url ) use ( $emoji_url ) {
				return strpos( $url, $emoji_url ) === false;
			} );
		}
		return $urls;
	}, 10, 2 );

	// Remove jQuery Migrate (Not needed for modern themes/plugins)
	add_filter( 'wp_default_scripts', function ( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$scripts->registered['jquery']->deps = array_diff(
				$scripts->registered['jquery']->deps,
				[ 'jquery-migrate' ]
			);
		}
	} );

	// Disable Embeds (Improves speed by removing embed script and related styles)
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	add_filter( 'embed_oembed_discover', '__return_false' );
	add_filter( 'tiny_mce_plugins', function ( $plugins ) {
		return array_diff( $plugins, [ 'wpembed' ] );
	} );
	remove_action( 'wp_head', 'wp_generator' ); // Remove WordPress version
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Remove Windows Live Writer link
	remove_action( 'wp_head', 'rsd_link' ); // Remove RSD (Really Simple Discovery) link
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Remove feed links
	remove_action( 'wp_head', 'feed_links', 2 ); // Remove general feed links

	// Disable Dashicons for non-admins
	if ( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', function () {
			wp_dequeue_style( 'dashicons' );
		} );
	}

	// Dequeue Block Library CSS (Gutenberg Styles)
	add_action( 'wp_enqueue_scripts', function () {
		wp_dequeue_style( 'wp-block-library' ); // Default block styles
		wp_deregister_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' ); // Extra styles for block themes
		wp_deregister_style( 'wp-block-library-theme' );
	}, 100 ); // Ensure it runs late
}

add_action( 'init', 'optimize_site' );

function add_gravity_forms_acf_field() {
	if (function_exists('acf_add_local_field_group')) {
		acf_add_local_field_group(array(
			'key' => 'group_gravity_forms',
			'title' => 'Select Gravity Form',
			'fields' => array(
				array(
					'key' => 'field_gravity_form',
					'label' => 'Gravity Forms',
					'name' => 'gravity_form',
					'type' => 'select',
					'choices' => array(), // We'll populate this dynamically.
					'allow_null' => 1,
					'ui' => 1,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'form.php', // Change this as needed.
					),
				),
			),
		));
	}
}
add_action('acf/init', 'add_gravity_forms_acf_field');
function populate_gravity_forms_acf_field($field) {
	if (class_exists('GFAPI')) {
		$forms = \GFAPI::get_forms();
		if (!empty($forms)) {
			foreach ($forms as $form) {
				$field['choices'][$form['id']] = $form['title'];
			}
		}
	}
	return $field;
}
add_filter('acf/load_field/key=field_gravity_form', 'populate_gravity_forms_acf_field');
