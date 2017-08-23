<?php
function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}/**/
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function my_theme_enqueue_scripts() {
wp_enqueue_script( 'twentyseventeen-child-script', get_theme_file_uri( '/assets/js/custom.js' ), array(), '1.0', true );	
	
}/**/
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );


function addRtlAssets(){
	if(is_rtl()){
	wp_enqueue_style( 'rtl-style', get_theme_file_uri( '/assets/css/rtl.css' ));	
	wp_enqueue_script( 'twentyseventeen-child-rtl-script', get_theme_file_uri( '/assets/js/rtl.js' ), array(), '1.0', true );		
	}
	
}/**/
add_action( 'wp_enqueue_scripts', 'addRtlAssets' );

?>