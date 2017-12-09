<?php
/*
File Name: functions.php
Description: Core functions file of Writty theme.
Writty theme directories setup

*/


define('WRT_TEMPLATE_DIRECTORY_URI', get_template_directory_uri());
define('WRT_INC_DIR', get_template_directory() . '/inc' );
define('WRT_IMAGE_URL', WRT_TEMPLATE_DIRECTORY_URI . '/images' );

/*********************************************************/
## Writty theme functions files
/**********************************************************/
/**
 * Writee only works in WordPress 4.5 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) ) {
	require_once(WRT_INC_DIR.'/functions/back-compat.php');
	return;
}
require_once(WRT_INC_DIR.'/functions/customizer.php');
require_once(WRT_INC_DIR.'/functions/theme-functions.php');
require_once(WRT_INC_DIR.'/functions/navigations.php');
require_once(WRT_INC_DIR.'/functions/sidebars.php');
require_once(WRT_INC_DIR.'/functions/widgets.php');
require_once(WRT_INC_DIR.'/functions/featured-media.php');
require_once(WRT_INC_DIR.'/functions/custom-css-js.php');

if ( ! isset( $content_width ) ) {
	$content_width = 1080;

	// Our custom post type function
	function create_posttype() {

	    register_post_type( 'Alert',
	    // CPT Options
	        array(
	            'labels' => array(
	                'name' => __( 'Alerts' ),
	                'singular_name' => __( 'Alert' )
	            ),
	            'public' => true,
	            'has_archive' => true,
	            'rewrite' => array('Author Byline' => 'Alerts'),
	        )
	    );
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_posttype' );
}

function dwwp_add_custom_metabox() {

		add_meta_box(
			'dwwp_meta',
			'Alerts',
			'dwwp_meta_callback',
			'Alert'
		);

}



add_action( 'add_meta_boxes', 'dwwp_add_custom_metabox' );

function dwwp_meta_callback() {
	?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="author-id" class="dwwp-row-title">Author</label>
			</div>
			<div class="meta-td">
				<input type="text" name"author-id" id="author-id" value=""/>
			</div>
		</div>
	</div>

	<?php

}



/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_custom_taxonomies() {
  // Add new "Locations" taxonomy to Posts
  register_taxonomy('stock', 'post', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Stocks', 'taxonomy general name' ),
      'singular_name' => _x( 'Stock', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Stock' ),
      'all_items' => __( 'All Stocks' ),
      'parent_item' => __( 'Parent Stock' ),
      'parent_item_colon' => __( 'Parent Stock:' ),
      'edit_item' => __( 'Edit Stock' ),
      'update_item' => __( 'Update Stock' ),
      'add_new_item' => __( 'Add New Stock' ),
      'new_item_name' => __( 'New Stock Name' ),
      'menu_name' => __( 'Stocks' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'Stock', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );



// WP_Query arguments
$args = array(
	'p'                      => 'AAPL',
);

// The Query
$query = new WP_Query( $args );





?>
