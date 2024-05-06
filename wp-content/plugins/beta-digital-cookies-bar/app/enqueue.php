<?php
// use the registered jquery and style above
// register jquery and style on initialization
add_action('init', 'register_script');
function register_script() {
    wp_register_script( 'beta-cookies-bar-js', plugins_url('../resources/scripts/index.js', __FILE__), array(), '1.00', true );

    wp_register_style( 'beta-cookies-bar', plugins_url('../resources/styles/style.css', __FILE__), false, '1.0.0', 'all');
}

// use the registered jquery and style above
add_action('wp_enqueue_scripts', 'enqueue_style');

function enqueue_style(){
   wp_enqueue_script('beta-cookies-bar-js');

   wp_enqueue_style( 'beta-cookies-bar' );
}
?>