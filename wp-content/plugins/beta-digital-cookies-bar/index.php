<?php
/*
Plugin Name: BETA Digital Cookies Bar
Description: Barra de cookies para LGPD
Author: Elvio Barbosa
Version: 0.1
*/

define("PATH", plugin_dir_path( __FILE__ ));

include_once(PATH . '/app/enqueue.php');
include_once(PATH . '/app/utils.php');

add_action('wp_footer', 'cookie_bar');
function cookie_bar() {
   include_once(PATH . '/includes/cookiebar.php');
}
?>
