<?php
/* 
* GUTEMBERG BUTTON STYLE
*/

function be_gutenberg_scripts() {
	wp_enqueue_script( 'be-editor', get_stylesheet_directory_uri() . '/dist/scripts/admin-bundle.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/dist/scripts/admin-bundle.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );