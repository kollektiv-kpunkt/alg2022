<?php
require_once(__DIR__ . "/vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

/* alg2020 */
function alg_scripts() {
    // wp_enqueue_style( 'fa', get_template_directory_uri() . "/lib/font-awesome/css/font-awesome.min.css", [], "1.0.0" );
    // wp_enqueue_style( 'glowCookies', get_template_directory_uri() . "/lib/glowCookies/glowCookies.css", [], "1.0.0" );
    // wp_enqueue_style( 'fonts', get_template_directory_uri() . '/dist/fonts/fonts.css', [], "1.0.0" );
    // wp_enqueue_script( 'glowCookies', get_template_directory_uri() . "/lib/glowCookies/glowCookies.js", array(), "1.0.0", true );
    wp_enqueue_style( 'theme', get_template_directory_uri() . '/dist/theme.css', [], "1.0.0" );
    wp_enqueue_style( 'bundle', get_template_directory_uri() . '/dist/style.css', [], "1.0.0" );
    wp_enqueue_script( 'bundle', get_template_directory_uri() . '/dist/app.js', array(), "1.0.0", true );
}
add_action( 'wp_enqueue_scripts', 'alg_scripts' );

function alg_theme_support() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'alg_theme_support' );

function alg_menus() {
  register_nav_menu('alg-main-nav',__( 'Main Navigation' ));
  register_nav_menu('alg-footer-nav',__( 'Footer Navigation' ));
  register_nav_menu('alg-main-cta',__( 'Calls to action' ));
}
add_action( 'init', 'alg_menus' );

function alg_menu_items( $location, $args = [] ) {

    // Get all locations
    $locations = get_nav_menu_locations();

    // Get object id by location
    $object = wp_get_nav_menu_object( $locations[$location] );

    // Get menu items by menu name
    $menu_items = wp_get_nav_menu_items( $object->name, $args );

    // Return menu post objects
    return $menu_items;
}

function alg_htaccess( $rules ) {
    $content = <<<EOD
    \n
    Options +FollowSymLinks -MultiViews
    RewriteEngine On
    RewriteBase /
    RewriteRule ^api/?$ /wp-content/themes/alg2020/api/index.php [L,NC]
    RewriteRule ^api/(.+)$ /wp-content/themes/alg2020/api/index.php [L,NC]\n\n
    EOD;
    return $content . $rules;
}
add_filter('mod_rewrite_rules', 'alg_htaccess');

function alg_enable_flush_rules() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action( "admin_init", 'alg_enable_flush_rules' );


// ACF

function alg_acf() {
    define( 'MY_ACF_PATH', get_stylesheet_directory() . '/lib/acf/' );
    define( 'MY_ACF_URL', get_stylesheet_directory_uri() . '/lib/acf/' );
    include_once( MY_ACF_PATH . 'acf.php' );
    add_filter('acf/settings/url', 'my_acf_settings_url');
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    add_filter('acf/settings/save_json', 'set_acf_json_save_folder');
    function set_acf_json_save_folder( $path ) {
        $path = MY_ACF_PATH . '/acf-json';
        return $path;
    }
    add_filter('acf/settings/load_json', 'add_acf_json_load_folder');
    function add_acf_json_load_folder( $paths ) {
        unset($paths[0]);
        $paths[] = MY_ACF_PATH . '/acf-json';;
        return $paths;
    }

    // (Optional) Hide the ACF admin menu item.
    // add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    // function my_acf_settings_show_admin( $show_admin ) {
    //     return false;
    // }
}
alg_acf();

add_action('acf/init', 'alg_blocktypes');
function alg_blocktypes() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'heroine',
            'title'             => __('Heroine'),
            'description'       => __('Hero Section für auf der Startseite'),
            'render_template'   => 'template-parts/blocks/testimonial/heroine.php',
            'category'          => 'alg2020',
            'icon'              => 'dashicons-superhero',
            'keywords'          => array( 'hero', 'heroine', 'intro' ),
        ));
    }
}