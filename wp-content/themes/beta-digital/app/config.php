<?php 
function setup() {
    //limpa do wp_head removendo tags desnecessárias
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');

    //remove smart quotes
    remove_filter('the_title', 'wptexturize');
    remove_filter('the_content', 'wptexturize');
    remove_filter('the_excerpt', 'wptexturize');
    remove_filter('comment_text', 'wptexturize');
    remove_filter('list_cats', 'wptexturize');
    remove_filter('single_post_title', 'wptexturize');

    add_filter( 'wp_mail_from', 'sender_email' );
    function sender_email( $original_email_address ) {
        $domain = str_replace(['http://', 'https://'], '', get_bloginfo('url'));
        return 'noreply@' . $domain;
    }

    add_filter( 'wp_mail_from_name', 'sender_name' );
    function sender_name( $original_email_from ) {
        return get_bloginfo('name');
    }

    // setup
    if (function_exists('acf_add_options_page')) :
        acf_add_options_page();
    endif;

    register_nav_menu('beneficiario-menu',__( 'Menu Beneficiario' ));
    register_nav_menu('padrinho-menu',__( 'Menu Padrinho' ));
	
}

function register_custom_image_sizes() {
    if ( ! current_theme_supports( 'post-thumbnails' ) ) {
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'main-image' );
        add_theme_support( 'main-image-mobile' );
        add_theme_support( 'main-image-tablet' );
        add_theme_support( 'square' );
    }
    add_image_size( 'full-image', 1920, 962, true);
    add_image_size( 'main-image', 1311, 657, true);
    add_image_size( 'main-image-mobile', 350, 263, true);
    add_image_size( 'main-image-tablet', 768, 576, true);
    add_image_size( 'square', 800, 800, true);
}
add_action( 'after_setup_theme', 'register_custom_image_sizes' );

function add_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'full-image' => __( 'Custom 1311x657' ),
        'main-image' => __( 'Custom 1311x657' ),
        'main-image-mobile' => __( 'Custom 350x263' ),
        'main-image-tablet' => __( 'Custom 768x576' ),
        'square' => __( 'Custom 800x800' ),
    ) );
}
add_filter( 'image_size_names_choose', 'add_custom_image_sizes' );

add_action( 'init', 'setup' );

function custom_login_logo() {
    echo '<style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(' . get_bloginfo('template_directory') . '/resources/images/portal-rs-logo.png);
            height: 100px;
            width: 300px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>';
}
add_action('login_enqueue_scripts', 'custom_login_logo');


function custom_login_page() {
    return home_url('/login/');
}
add_filter('login_url', 'custom_login_page');
