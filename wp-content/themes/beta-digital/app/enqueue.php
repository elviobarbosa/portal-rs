<?php
//================== STYLES e SCRIPTS ====================

function wpdocs_theme_name_scripts() {

    // wp_enqueue_script( 'frontend-ajax', URLTEMA . '/resources/scripts/agenda.js', array('jquery'), null, true );
    // wp_localize_script(
    //     'frontend-ajax',
    //     'frontend_ajax_object',
    //     array(
    //         'ajaxurl' => admin_url( 'admin-ajax.php' ),
    //         'nonce'   => wp_create_nonce('ajax-nonce')
    //     )
    // );
   
    //styles
    wp_enqueue_style('site-style', get_template_directory_uri() . '/dist/styles/frontend.css?' . rand(), array());
    
    function prefix_add_footer_styles() {
        wp_enqueue_style( 'font-poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap' );
        // wp_enqueue_style( 'font-didot', 'https://use.typekit.net/pqp4dmv.css' );
        // wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array());
        // wp_enqueue_style( 'fancybox-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
       
    };
    
    //scripts
    wp_enqueue_script( 'jquery' );
    // wp_enqueue_script('swiper-js', get_template_directory_uri() . '/resources/scripts/utils/swiper.js', array(), '', true);
    //wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '', true);
 }
 
 add_action( 'get_footer', 'prefix_add_footer_styles' );
 add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );
 
 //================== STYLES e SCRIPTS ====================