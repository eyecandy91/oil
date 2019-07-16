<?php
/**
 * _s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

if (!function_exists('_s_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _s_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _s, use a find and replace
		 * to change '_s' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('_s', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', '_s'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', '_s_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('_s_content_width', 640);
}
add_action('after_setup_theme', '_s_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', '_s'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', '_s'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', '_s_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function oil_baron_styles()
{
	// wp_enqueue_style('_s-style', get_stylesheet_uri());

	// wp_enqueue_script('_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

	// wp_enqueue_script('_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	// if (is_singular() && comments_open() && get_option('thread_comments')) {
	// 	wp_enqueue_script('comment-reply');
	// }

	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array(), null, true );

	wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-2.2.4.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'oil_baron_styles');

function add_ajax_script() {

    wp_localize_script( 'ajax-js', 'ajax_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'add_ajax_script' );

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Remove all the BS trash
 */
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
      
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
      
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); // Remove shortlink

/**
 * Add ACF to backend
 */
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path($path)
{

	// update path
	$path = get_stylesheet_directory() . '/acf/';

	// return
	return $path;
}
// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir($dir)
{

	// update path
	$dir = get_stylesheet_directory_uri() . '/acf/';

	// return
	return $dir;
}
// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_true');
// 4. Include ACF
include_once(get_stylesheet_directory() . '/acf/acf.php');

/**
 * Load custom post type certificate
 */
function custom_post_certificates()
{

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x('Certificates', 'Post Type General Name', 'oil_baron'),
		'singular_name'       => _x('Certificates', 'Post Type Singular Name', 'oil_baron'),
		'menu_name'           => __('Certificates', 'oil_baron'),
		'parent_item_colon'   => __('Parent Certificates', 'oil_baron'),
		'all_items'           => __('All Certificates', 'oil_baron'),
		'view_item'           => __('View Certificates', 'oil_baron'),
		'add_new_item'        => __('Add New Certificates', 'oil_baron'),
		'add_new'             => __('Add New Certificates', 'oil_baron'),
		'edit_item'           => __('Edit Certificates', 'oil_baron'),
		'update_item'         => __('Update Certificates', 'oil_baron'),
		'search_items'        => __('Search Certificates', 'oil_baron'),
		'not_found'           => __('Not Found', 'oil_baron'),
		'not_found_in_trash'  => __('Not found in Trash', 'oil_baron'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('Certificates', 'oil_baron'),
		'description'         => __('Certificates', 'oil_baron'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'author'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array('PO Number'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		// 'taxonomies'            => array('category'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 10,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'           => 'dashicons-awards',
		'publicly_queryable' => false, // Set to false hides Single Pages
	);

	// Registering your Custom Post Type
	register_post_type('certificates', $args);
}

/* Hook into the 'init' action so that the function
	* Containing our post type registration is not
	* unnecessarily executed.
	*/

add_action('init', 'custom_post_certificates', 0);

/**
 * Add custom taxonomy for certificates to use
 */
//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_po_numbers_hierarchical_taxonomy', 0);
function create_po_numbers_hierarchical_taxonomy()
{

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
		'name' => _x('Po numbers', 'taxonomy general name'),
		'singular_name' => _x('PO Number', 'taxonomy singular name'),
		'search_items' =>  __('Search Po numbers'),
		'all_items' => __('All PO Numbers'),
		'parent_item' => __('Parent PO Number'),
		'parent_item_colon' => __('Parent PO Number:'),
		'edit_item' => __('Edit PO Number'),
		'update_item' => __('Update PO Number'),
		'add_new_item' => __('Add New PO Number'),
		'new_item_name' => __('New PO Number Name'),
		'menu_name' => __('PO Numbers'),
	);

	// Now register the taxonomy

	register_taxonomy('po_numbers', array('certificates'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'po_numbers'),
		'show_in_rest' => true
	));
}

/**
 * Load custom post type products
 */
function custom_post_products()
{

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x('products', 'Post Type General Name', 'oil_baron'),
		'singular_name'       => _x('products', 'Post Type Singular Name', 'oil_baron'),
		'menu_name'           => __('products', 'oil_baron'),
		'parent_item_colon'   => __('Parent products', 'oil_baron'),
		'all_items'           => __('All products', 'oil_baron'),
		'view_item'           => __('View products', 'oil_baron'),
		'add_new_item'        => __('Add a new product', 'oil_baron'),
		'add_new'             => __('Add a new product', 'oil_baron'),
		'edit_item'           => __('Edit products', 'oil_baron'),
		'update_item'         => __('Update products', 'oil_baron'),
		'search_items'        => __('Search products', 'oil_baron'),
		'not_found'           => __('Not Found', 'oil_baron'),
		'not_found_in_trash'  => __('Not found in Trash', 'oil_baron'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('products', 'oil_baron'),
		'description'         => __('products', 'oil_baron'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'author'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		'taxonomies'          => array('product_types'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		// 'taxonomies'            => array('category'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 10,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'           => 'dashicons-pressthis',
		'publicly_queryable' => false, // Set to false hides Single Pages
	);

	// Registering your Custom Post Type
	register_post_type('products_baron', $args);
}

/* Hook into the 'init' action so that the function
	* Containing our post type registration is not
	* unnecessarily executed.
	*/

add_action('init', 'custom_post_products', 0);

/**
 * Add custom taxonomy for products to use
 */
//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_product_types_hierarchical_taxonomy', 0);
function create_product_types_hierarchical_taxonomy()
{

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
		'name' => _x('Product types', 'taxonomy general name'),
		'singular_name' => _x('Product types', 'taxonomy singular name'),
		'search_items' =>  __('Search Product types'),
		'all_items' => __('All Product types'),
		'parent_item' => __('Parent Product types'),
		'parent_item_colon' => __('Parent Product types:'),
		'edit_item' => __('Edit Product types'),
		'update_item' => __('Update Product types'),
		'add_new_item' => __('Add New Product types'),
		'new_item_name' => __('New Product types Name'),
		'menu_name' => __('Product type categories'),
	);

	// Now register the taxonomy

	register_taxonomy('product_types', array('products_baron'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'product types'),
		'show_in_rest' => true
	));
}

/**
 * Load custom post type certificate
 */
function custom_post_Merchandise()
{

	// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x('Merchandise', 'Post Type General Name', 'oil_baron'),
		'singular_name'       => _x('Merchandise', 'Post Type Singular Name', 'oil_baron'),
		'menu_name'           => __('Merchandise', 'oil_baron'),
		'parent_item_colon'   => __('Parent Merchandise', 'oil_baron'),
		'all_items'           => __('All Merchandise items', 'oil_baron'),
		'view_item'           => __('View Merchandise items', 'oil_baron'),
		'add_new_item'        => __('Add New Merchandise items', 'oil_baron'),
		'add_new'             => __('Add New Merchandise items', 'oil_baron'),
		'edit_item'           => __('Edit Merchandise item', 'oil_baron'),
		'update_item'         => __('Update Merchandise item', 'oil_baron'),
		'search_items'        => __('Search Merchandise items', 'oil_baron'),
		'not_found'           => __('Not Found', 'oil_baron'),
		'not_found_in_trash'  => __('Not found in Trash', 'oil_baron'),
	);

	// Set other options for Custom Post Type

	$args = array(
		'label'               => __('Merchandise', 'oil_baron'),
		'description'         => __('Merchandise', 'oil_baron'),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array('title', 'author'),
		// You can associate this CPT with a taxonomy or custom taxonomy.
		// 'taxonomies'          => array('PO Number'),
		/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
		'hierarchical'        => false,
		// 'taxonomies'            => array('category'),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 10,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'           => 'dashicons-cart',	
	);

	// Registering your Custom Post Type
	register_post_type('merchandise_baron', $args);
}

/* Hook into the 'init' action so that the function
	* Containing our post type registration is not
	* unnecessarily executed.
	*/

add_action('init', 'custom_post_merchandise', 0);

/**
 * Add custom taxonomy for products to use
 */
//hook into the init action and call create_book_taxonomies when it fires
add_action('init', 'create_merchandise_types_hierarchical_taxonomy', 0);
function create_merchandise_types_hierarchical_taxonomy()
{

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
		'name' => _x('Merchandise items', 'taxonomy general name'),
		'singular_name' => _x('Merchandise items', 'taxonomy singular name'),
		'search_items' =>  __('Search merchandise items'),
		'all_items' => __('All merchandise items'),
		'parent_item' => __('Parent merchandise items'),
		'parent_item_colon' => __('Parent merchandise items:'),
		'edit_item' => __('Edit merchandise items'),
		'update_item' => __('Update mrchandise items'),
		'add_new_item' => __('Add a new merchandise category'),
		'new_item_name' => __('New merchandise items Name'),
		'menu_name' => __('Merchandise item categories'),
	);

	// Now register the taxonomy

	register_taxonomy('Merchandise_items', array('merchandise_baron'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'Merchandise-items'),
		'show_in_rest' => true
	));
}

/**
 * Add Author to the custom post types.
 */
function my_cpt_support_author()
{
	add_post_type_support('my_cpt', 'author');
}
add_action('init', 'my_cpt_support_author');

/**
 * Rename the author title box in custom posts
 */
add_action('add_meta_boxes', 'change_meta_box_titles');
function change_meta_box_titles()
{
	global $wp_meta_boxes; // array of defined meta boxes
	// cycle through the array, change the titles you want

	$wp_meta_boxes['certificates']['normal']['core']['authordiv']['title'] = 'Attach a user to this certificate';
}

/**
 * Add subscribors to post authors
 */
add_filter( 'wp_dropdown_users_args', 'add_subscribers_to_dropdown', 10, 2 );
function add_subscribers_to_dropdown( $query_args, $r ) {

    $query_args['who'] = '';
    return $query_args;

}

/**
 * Remove the standard posts from admin 
 */
function remove_menu () 
{
   remove_menu_page('edit.php');
} 
add_action('admin_menu', 'remove_menu');

/**
 * Adds custom taxonomy to certificates custom post type
 */
function add_cats_to_page()
{
	// Add tag metabox to page
	register_taxonomy_for_object_type('post_tag', 'po_numbers');
	// Add category metabox to po_numbers
	 register_taxonomy_for_object_type('category', 'po_numbers');
	 register_taxonomy_for_object_type('category', 'page');  
}
// Add to the admin_init hook of your theme functions.php file 
add_action('init', 'add_cats_to_page');

/**
 * Rename the author title box in custom posts
 */
add_action( 'add_meta_boxes_post',  'wpse39446_add_meta_boxes' );
function wpse39446_add_meta_boxes() {
    remove_meta_box( 'authordiv', 'post', 'core' );
    add_meta_box( 'authordiv', __('Team Member','wpse39446_domain'), 'post_author_meta_box', 'post', 'core', 'high' );
}

function acf_change_icon_on_files ( $icon, $mime, $attachment_id ){ // Display thumbnail instead of document.png
		
	if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) === false && $mime === 'application/pdf' ){
		$get_image = wp_get_attachment_image_src ( $attachment_id, 'thumbnail' );
		if ( $get_image ) {
			$icon = $get_image[0];
		} 
	}
	return $icon;
}

add_filter( 'wp_mime_type_icon', 'acf_change_icon_on_files', 10, 3 );

/**
	 * Create A Simple Theme Options Panel
	 *
	 */
	
	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}
	
	// Start Class
	if ( ! class_exists( 'WPEX_Theme_Options' ) ) {
	
		class WPEX_Theme_Options {
	
			/**
			 * Start things up
			 *
			 * @since 1.0.0
			 */
			public function __construct() {
	
				// We only need to register the admin panel on the back-end
				if ( is_admin() ) {
					add_action( 'admin_menu', array( 'WPEX_Theme_Options', 'add_admin_menu' ) );
					add_action( 'admin_init', array( 'WPEX_Theme_Options', 'register_settings' ) );
				}
	
			}
	
			/**
			 * Returns all theme options
			 *
			 * @since 1.0.0
			 */
			public static function get_theme_options() {
				return get_option( 'theme_options' );
			}
	
			/**
			 * Returns single theme option
			 *
			 * @since 1.0.0
			 */
			public static function get_theme_option( $id ) {
				$options = self::get_theme_options();
				if ( isset( $options[$id] ) ) {
					return $options[$id];
				}
			}
	
			/**
			 * Add sub menu page
			 *
			 * @since 1.0.0
			 */
			public static function add_admin_menu() {
				add_menu_page(
					esc_html__( 'Theme Settings', 'oil-baron' ),
					esc_html__( 'Theme Settings', 'oil-baron' ),
					'manage_options',
					'theme-settings',
					array( 'WPEX_Theme_Options', 'create_admin_page' )
				);
			}
	
			/**
			 * Register a setting and its sanitization callback.
			 *
			 * We are only registering 1 setting so we can store all options in a single option as
			 * an array. You could, however, register a new setting for each option
			 *
			 * @since 1.0.0
			 */
			public static function register_settings() {
				register_setting( 'theme_options', 'theme_options', array( 'WPEX_Theme_Options', 'sanitize' ) );
			}
	
			/**
			 * Sanitization callback
			 *
			 * @since 1.0.0
			 */
			public static function sanitize( $options ) {
	
				// If we have options lets sanitize them
				if ( $options ) {
	
					// Checkbox
					// if ( ! empty( $options['checkbox_example'] ) ) {
					// 	$options['checkbox_example'] = 'on';
					// } else {
					// 	unset( $options['checkbox_example'] ); // Remove from options if not checked
					// }
	
					// // Input
					// if ( ! empty( $options['input_example'] ) ) {
					// 	$options['input_example'] = sanitize_text_field( $options['input_example'] );
					// } else {
					// 	unset( $options['input_example'] ); // Remove from options if empty
					// }

					// Input
					if ( ! empty( $options['place1'] ) ) {
						$options['place1'] = sanitize_text_field( $options['place1'] );
					} else {
						unset( $options['place1'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['place2'] ) ) {
						$options['place2'] = sanitize_text_field( $options['place2'] );
					} else {
						unset( $options['place2'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['head_phone'] ) ) {
						$options['head_phone'] = sanitize_text_field( $options['head_phone'] );
					} else {
						unset( $options['head_phone'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['head_address'] ) ) {
						$options['head_address'] = sanitize_text_field( $options['head_address'] );
					} else {
						unset( $options['head_address'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['head_email'] ) ) {
						$options['head_email'] = sanitize_text_field( $options['head_email'] );
					} else {
						unset( $options['head_email'] ); // Remove from options if empty
					}

					// Input
					if ( ! empty( $options['dalby_phone'] ) ) {
						$options['dalby_phone'] = sanitize_text_field( $options['dalby_phone'] );
					} else {
						unset( $options['dalby_phone'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['dalby_address'] ) ) {
						$options['dalby_address'] = sanitize_text_field( $options['dalby_address'] );
					} else {
						unset( $options['dalby_address'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['dalby_email'] ) ) {
						$options['dalby_email'] = sanitize_text_field( $options['dalby_email'] );
					} else {
						unset( $options['dalby_email'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['pagination'] ) ) {
						$options['pagination'] = sanitize_text_field( $options['pagination'] );
					} else {
						unset( $options['pagination'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['login_error'] ) ) {
						$options['login_error'] = sanitize_text_field( $options['login_error'] );
					} else {
						unset( $options['login_error'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['thanks'] ) ) {
						$options['thanks'] = sanitize_text_field( $options['thanks'] );
					} else {
						unset( $options['thanks'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['email_body'] ) ) {
						$options['email_header'] = sanitize_text_field( $options['email_header'] );
					} else {
						unset( $options['email_header'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['email_body'] ) ) {
						$options['email_body'] = sanitize_text_field( $options['email_body'] );
					} else {
						unset( $options['email_body'] ); // Remove from options if empty
					}
					// Input
					if ( ! empty( $options['email_link'] ) ) {
						$options['email_link'] = sanitize_text_field( $options['email_link'] );
					} else {
						unset( $options['email_link'] ); // Remove from options if empty
					}
	
					// // Select
					// if ( ! empty( $options['select_example'] ) ) {
					// 	$options['select_example'] = sanitize_text_field( $options['select_example'] );
					// }
	
				}
	
				// Return sanitized options
				return $options;
	
			}
	
			/**
			 * Settings page output
			 *
			 * @since 1.0.0
			 */
			public static function create_admin_page() { ?>

<div class="wrap">

    <h1><?php esc_html_e( 'OIl baron settings', 'oil-baron' ); ?></h1>

    <form method="post" action="options.php">

        <?php settings_fields( 'theme_options' ); ?>

        <table class="form-table wpex-custom-admin-login-table">

            <!-- <?php // Checkbox example ?>
							<tr valign="top">
								<th scope="row"><?php// esc_html_e( 'Checkbox Example', 'oil-baron' ); ?></th>
								<td>
									<?php// $value = self::get_theme_option( 'checkbox_example' ); ?>
									<input type="checkbox" name="theme_options[checkbox_example]" <?php// checked( $value, 'on' ); ?>> <?php// esc_html_e( 'Checkbox example description.', 'oil-baron' ); ?>
								</td>
							</tr>
	
							<?php// // Text input example ?>
							<tr valign="top">
								<th scope="row"><?php// esc_html_e( 'Input Example', 'oil-baron' ); ?></th>
								<td>
									<?php// $value = self::get_theme_option( 'input_example' ); ?>
									<input type="text" name="theme_options[input_example]" value="<?php// echo esc_attr( $value ); ?>">
								</td>
							</tr> -->

            <?php // book online text ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Place of work', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'place1' ); ?>
                    <input type="text" name="theme_options[place1]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>
            <?php // book online text ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Head Office Phone Number', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'head_phone' ); ?>
                    <input type="text" name="theme_options[head_phone]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>

            <?php // book online link ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Head Office Address', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'head_address' ); ?>
                    <textarea type="text" name="theme_options[head_address]" cols="50"
                        rows="8" /><?php echo esc_attr( $value ); ?></textarea>
                </td>
            </tr>

            <?php // footer copyright ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Head Office Email ', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'head_email' ); ?>
                    <input type="text" name="theme_options[head_email]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>

            <?php // telephone number ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Place of work', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'place2' ); ?>
                    <input type="text" name="theme_options[place2]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>
            <?php // telephone number ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Dalby Branch Telephone', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'dalby_phone' ); ?>
                    <input type="text" name="theme_options[dalby_phone]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>

            <?php // telephone number ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Dalby Branch Address', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'dalby_address' ); ?>
                    <textarea type="text" name="theme_options[dalby_address]" cols="50"
                        rows="8" /><?php echo esc_attr( $value ); ?></textarea>

                </td>
            </tr>

            <?php // telephone number ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'Dalby Branch Email', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'dalby_email' ); ?>
                    <input type="text" name="theme_options[dalby_email]" value="<?php echo esc_attr( $value ); ?>">
                </td>
			</tr>

			<tr valign="top">
				<th scope="row"><h2><?php esc_html_e( 'Pagination settings', 'oil-baron' ); ?></h2></th>
			</tr>
            <?php // telephone number ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'How many certificates to be shown on one page', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'pagination' ); ?>
                    <input type="text" name="theme_options[pagination]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>

			<tr valign="top">
				<th scope="row"><h2><?php esc_html_e( 'Login settings', 'oil-baron' ); ?></h2></th>
			</tr>
            <?php // telephone number ?>
            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'If user name or/and password doesnt match error header', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'login_error' ); ?>
                    <input type="text" name="theme_options[login_error]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php esc_html_e( 'If user name or/and password doesnt match error message', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'login_error_text' ); ?>
					<textarea type="text" name="theme_options[login_error_text]" cols="50"
                        rows="8" /><?php echo esc_attr( $value ); ?></textarea>
                </td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><h2><?php esc_html_e( 'Thank you message merchandise', 'oil-baron' ); ?></h2></th>
			</tr>
			<tr valign="top">
                <th scope="row"><?php esc_html_e( 'Thankyou message when making inquiry into an item', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'thanks' ); ?>
					<textarea type="text" name="theme_options[thanks]" cols="50"
                        rows="8" /><?php echo esc_attr( $value ); ?></textarea>
                </td>
            </tr>

			<tr valign="top">
				<th scope="row"><h2><?php esc_html_e( 'User registration email settings', 'oil-baron' ); ?></h2></th>
			</tr>
			<tr valign="top">
                <th scope="row"><?php esc_html_e( 'Email header ', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'email_header' ); ?>
					<textarea type="text" name="theme_options[email_header]" cols="50"
                        rows="8" /><?php echo esc_attr( $value ); ?></textarea>
                </td>
            </tr>

			<tr valign="top">
                <th scope="row"><?php esc_html_e( 'Email message', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'email_body' ); ?>
					<textarea type="text" name="theme_options[email_body]" cols="50"
                        rows="8" /><?php echo esc_attr( $value ); ?></textarea>
                </td>
            </tr>

			<tr valign="top">
                <th scope="row"><?php esc_html_e( 'Email link message', 'oil-baron' ); ?></th>
                <td>
                    <?php $value = self::get_theme_option( 'email_link' ); ?>
					<input type="text" name="theme_options[email_link]" value="<?php echo esc_attr( $value ); ?>">
                </td>
            </tr>

            <!-- <?php// // Select example ?>
							<tr valign="top" class="wpex-custom-admin-screen-background-section">
								<th scope="row"><?php// esc_html_e( 'Select Example', 'oil-baron' ); ?></th>
								<td>
									<?php// $value = self::get_theme_option( 'select_example' ); ?>
									<select name="theme_options[select_example]">
										<?php//
										//$options = array(
										//	'1' => esc_html__( 'Option 1', 'oil-baron' ),
										//	'2' => esc_html__( 'Option 2', 'oil-baron' ),
										//	'3' => esc_html__( 'Option 3', 'oil-baron' ),
										//);
										//foreach ( $options as $id => $label ) { ?>
											<option value="<?php// echo esc_attr( $id ); ?>" <?php// selected( $value, $id, true ); ?>>
												<?php// echo strip_tags( $label ); ?>
											</option>
										<?php// } ?>
									</select>
								</td>
							</tr> -->

        </table>

        <?php submit_button(); ?>

    </form>

</div><!-- .wrap -->
<?php }
	
		}
	}
	new WPEX_Theme_Options();
	
	// Helper function to use in your theme to return a theme option value
	function myprefix_get_theme_option( $id = '' ) {
		return WPEX_Theme_Options::get_theme_option( $id );
	}

// Custom login CSS
// function my_custom_login() {
// 	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-style.css" />';
// }
// add_action('login_head', 'my_custom_login');

// Remove dashboard access to users 
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

// Remove access to dashboard for users 
function wpse23007_redirect(){
	if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('subscriber') || current_user_can('contributor') ) ){
	  wp_redirect(home_url());
	  exit;
	}
}
add_action('init','wpse23007_redirect');

// Search only users ID posts not other user -> Very important
function wpb_search_filter($query)
{
	global $current_user;
	if ($query->is_search && !is_admin())
		$query->set('author', $current_user->ID);
	// $query->set('meta_query', array(
	// 	'key'       => 'file_name',
	// 	'value'     => $query->query['s']
	// ));
	return $query;
}
add_filter('pre_get_posts', 'wpb_search_filter');

// Custom pagination
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;
 
    global $paged;
    if(empty($paged)) $paged = 1;
 
    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }
 
    if(1 != $pages)
    {
        echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }
 
        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}

// Fix the pagination 
function custom_posts_per_page( $query ) {
if ( $query->is_archive('project') ) 
	{
	set_query_var('posts_per_page', -1);
	}
}
add_action( 'pre_get_posts', 'custom_posts_per_page' );

// Remove annoying crap from pagiation
function sanitize_pagination($content) {
	// Remove h2 tag
	$content = str_replace('role="navigation"', '', $content);
    $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
    return $content;
}
add_action('navigation_markup_template', 'sanitize_pagination');

// Password or user name failed redirect to same page and dont show wp-login page
add_action( 'wp_login_failed', 'custom_login_failed' );
function custom_login_failed( $username )
{
    $referrer = wp_get_referer();

    if ( $referrer && ! strstr($referrer, 'wp-login') && ! strstr($referrer,'wp-admin') )
    {
        wp_redirect( add_query_arg('login', 'failed', $referrer) );
        exit;
    }
}

add_filter( 'authenticate', 'custom_authenticate_username_password', 30, 3);
function custom_authenticate_username_password( $user, $username, $password )
{
    if ( is_a($user, 'WP_User') ) { return $user; }

    if ( empty($username) || empty($password) )
    {
        $error = new WP_Error();
        $user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));

        return $error;
    }
}

// remove crap from login pages
function my_login_page_remove_back_to_link() { ?>
    <style type="text/css">
        body.login div#login p#backtoblog,
        body.login div#login p#nav {
          display: none;
        }
    </style>
<?php }
//This loads the function above on the login page
add_action( 'login_enqueue_scripts', 'my_login_page_remove_back_to_link' );

function admin_login_redirect( $redirect_to, $request, $user ) {
	global $user;
	
	if( isset( $user->roles ) && is_array( $user->roles ) ) {
	   if( in_array( "administrator", $user->roles ) ) {
	   return $redirect_to;
	   } 
	   else {
		return home_url('/portal');
	   }
	}
	else {
	return $redirect_to;
	}
 }
add_filter("login_redirect", "admin_login_redirect", 10, 3);

// // redirect reset password to home page
// add_filter( 'lostpassword_redirect', 'my_redirect_home' );
// function my_redirect_home( $lostpassword_redirect ) {
// 	return home_url('/portal');
// }

// add custom logo for login page and reset password
function custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo content_url();; ?>/uploads/2019/06/oil-baron.png);
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

// allow url queries
function custom_rewrite_basic() 
{
    add_rewrite_rule('merchandise?c=$1', 'top');
}
add_action('init', 'custom_rewrite_basic');

// redirect merchandise to merchandise home page and show message
add_action( 'wp_footer', 'redirect_cf7' );
function redirect_cf7() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
       location = '<?php echo esc_url( home_url( '/merchandise/?enquiry=completed' ) ) ?>';
}, false );
</script>
<?php
}
// add_action('init','custom_login');
// function custom_login(){
//  global $pagenow;
//  //  URL for the HomePage. You can set this to the URL of any page you wish to redirect to.
//  $blogHomePage = get_bloginfo('url');
//  //  Redirect to the Homepage, if if it is login page. Make sure it is not called to logout or for lost password feature
//  if( 'wp-login.php' == $pagenow && $_GET['action']!="logout" && $_GET['action']!="lostpassword") {
//      wp_redirect($blogHomePage);
//      exit();
//  }
// }

// function custom_contact_script_conditional_loading(){
// 	//  Edit page IDs here
// 	if(! is_page('contact') )
// 	{
// 	   wp_dequeue_script('contact-form-7'); // Dequeue JS Script file.
// 	   wp_dequeue_style('contact-form-7');  // Dequeue CSS file.
// 	   wp_dequeue_style('cf7cf-style');  // Dequeue CSS file.
// 	}
//  }
 
//  add_action( 'wp_enqueue_scripts', 'custom_contact_script_conditional_loading' );

add_action( 'resetpass_form', 'resettext');
function resettext(){ ?>

<script type="text/javascript">
   jQuery( document ).ready(function() {                 
     jQuery('#resetpassform input#wp-submit').val("Set Password");
   });
</script>
<?php
}

function forgotpass_message() {
	$action = $_REQUEST['action'];
	if( $action == 'resetpass' ) {
	$portal = home_url('/portal');
	$message = '<p class="message">Your password has been set <a href="'.$portal.'">Login</a></p>';
	return $message;
	}
   }
   add_filter('login_message', 'forgotpass_message');