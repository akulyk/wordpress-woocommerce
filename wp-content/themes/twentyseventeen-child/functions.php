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

/*
 * Single Product Summary customization
 *
 * */

remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);

add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',30);
add_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',10);
/**/



/*
 * Create new taxonomy - Genres and
 * connecting it with our new post type - Books
 * */

function create_taxonomy(){

    register_taxonomy('taxonomy', array('books'), array(
        'label'                 => '', // defines by $labels->name
        'labels'                => array(
            'name'              => 'Genres',
            'singular_name'     => 'Genre',
            'search_items'      => 'Search Genres',
            'all_items'         => 'All Genres',
            'view_item '        => 'View Genre',
            'parent_item'       => 'Parent Genre',
            'parent_item_colon' => 'Parent Genre:',
            'edit_item'         => 'Edit Genre',
            'update_item'       => 'Update Genre',
            'add_new_item'      => 'Add New Genre',
            'new_item_name'     => 'New Genre Name',
            'menu_name'         => 'Genre',
        ),
        'description'           => '', // desription of taxonomy
        'public'                => true,
        'publicly_queryable'    => null, // equal to public
        'show_in_nav_menus'     => true, // equal to public
        'show_ui'               => true, // equal to public
        'show_tagcloud'         => true, // equal to show_ui
        'show_in_rest'          => null, // add to REST API
        'rest_base'             => null, // $taxonomy
        'hierarchical'          => false,
        'update_count_callback' => '',
        'rewrite'               => true,

        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => true,
        '_builtin'              => false,
        'show_in_quick_edit'    => null,
    ) );
}



/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Books', 'Book Type General Name', 'twentyseventeen' ),
        'singular_name'       => _x( 'Book', 'Book Type Singular Name', 'twentyseventeen' ),
        'menu_name'           => __( 'Books', 'twentyseventeen' ),
        'parent_item_colon'   => __( 'Parent Book', 'twentyseventeen' ),
        'all_items'           => __( 'All Books', 'twentyseventeen' ),
        'view_item'           => __( 'View Book', 'twentyseventeen' ),
        'add_new_item'        => __( 'Add New Book', 'twentyseventeen' ),
        'add_new'             => __( 'Add New', 'twentyseventeen' ),
        'edit_item'           => __( 'Edit Book', 'twentyseventeen' ),
        'update_item'         => __( 'Update Book', 'twentyseventeen' ),
        'search_items'        => __( 'Search Book', 'twentyseventeen' ),
        'not_found'           => __( 'Not Found', 'twentyseventeen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentyseventeen' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'books', 'twentyseventeen' ),
        'description'         => __( 'Book news and reviews', 'twentyseventeen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // Associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );

    // Registering your Custom Post Type
    register_post_type( 'books', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );
add_action('init', 'create_taxonomy');
?>