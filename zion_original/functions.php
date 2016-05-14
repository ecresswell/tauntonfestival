<?php

//Start churchThemes Functions - Please refrain from editing this file.



$functions_path = TEMPLATEPATH . '/functions/';

$includes_path = TEMPLATEPATH . '/includes/';



// Options panel variables and functions

require_once ($functions_path . 'admin-setup.php');



// Custom functions and plugins

require_once ($functions_path . 'admin-functions.php');





// Thumbnails

add_theme_support('post-thumbnails');

set_post_thumbnail_size(950, 9999);

add_image_size('slide-background', 950, 460, true);

add_image_size('staff-thumb', 200, 200, true);

add_image_size('blog-thumb', 617, true);



// Custom fields 

// require_once ($functions_path . 'admin-custom.php');



// More churchThemes Page

require_once ($functions_path . 'admin-theme-page.php');



// Admin Interface!

require_once ($functions_path . 'admin-interface.php');



// Options panel settings

require_once ($includes_path . 'theme-options.php'); // What we do!



//Custom Theme Fucntions

require_once ($includes_path . 'theme-functions.php'); 



//Custom Comments

require_once ($includes_path . 'theme-comments.php'); 



// Load Javascript in wp_head

require_once ($includes_path . 'theme-js.php');



// Widgets  & Sidebars

require_once ($includes_path . 'sidebar-init.php');

require_once ($includes_path . 'theme-widgets.php');



add_action('wp_head', 'churchthemes_wp_head');

add_action('admin_menu', 'churchthemes_add_admin');

add_action('admin_head', 'churchthemes_admin_head');    


function add_stylesheet(){
     	wp_enqueue_style('stylesheet', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('nivo-style', get_template_directory_uri() . '/css/slider/nivo-slider.css');
	wp_enqueue_style('nivo-default', get_template_directory_uri() . '/css/slider/default/default.css');
	wp_enqueue_style('medialelemets', get_template_directory_uri() . '/mediaelement/mediaelementplayer.css');
}

function theme_scripts_method() {
	wp_enqueue_script(
		'nivo',
		get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js',
		array('jquery')
	);
	wp_enqueue_script(
		'main',
		get_template_directory_uri() . '/js/main.js',
		array('jquery')
	);
	wp_enqueue_script(
		'media',
		get_template_directory_uri() . '/mediaelement/mediaelement-and-player.min.js',
		array('jquery')
	);
}

add_action('wp_print_styles', 'add_stylesheet');
add_action('wp_enqueue_scripts', 'theme_scripts_method');


function new_excerpt_length($length) {

	return 100;

}



add_filter('excerpt_length', 'new_excerpt_length');

function string_limit_words($string, $word_limit)

{

  $words = explode(' ', $string, ($word_limit+ 1));

 if(count($words) > $word_limit) {

  array_pop($words);

  //add a ... at last article when more than limitword count



  echo implode(' ', $words)."..."; } else {

 //otherwise

 echo implode(' ', $words); }



}









// Registering Menus For Theme



add_action( 'init', 'register_my_menus' );

function register_my_menus() {



	register_nav_menus(



		array(



			'main-nav-menu' => __( 'Header' ),

			'footer-menu' => __( 'Footer' )



	)



	);



}







add_action( 'init', 'create_my_post_types' );



function create_my_post_types() {



	register_post_type( 'slide',



		array(



		'labels' => array(



		'name' => __( 'Slides' ),



		'singular_name' => __( 'Slide' ),



		'add_new' => __( 'Add New' ),



		'add_new' => 'Add New Slide',



		'add_new_item' => __( 'Add New Slide' ),



		'edit' => __( 'Edit' ),



		'edit_item' => __( 'Edit Slide' ),



		'new_item' => __( 'New Slide' ),



		'view' => __( 'View Slide' ),



		'view_item' => __( 'View Slides' ),



		'search_items' => __( 'Search Slides' ),



		'not_found' => __( 'No Slides found' ),



		'not_found_in_trash' => __( 'No Slides found in Trash' ),



		'parent' => __( 'Parent Slide' )



		),



'public' => true,



'supports' => array('thumbnail','title'),



'rewrite' => true,



'query_var' => true,



'exclude_from_search' => true,



'show_ui' => true,



'capability_type' => 'post'



		)

	);





// Add Metaboxes for slider



function add_slide_metaboxes(){



	add_meta_box("slide_link", "Slide Link", "slide_metabox", "slide", "normal", "high");



}



add_action("admin_init", "add_slide_metaboxes");



// END // Add Metaboxes



// - - - - - - - - - - - - - - - - - - - - - - -



// Slide Link



function slide_metabox(){



	global $post;



	$custom = get_post_custom($post->ID);



	$slide_link = $custom["slide_link"][0];



	?>



    <label>Slide link:</label>



	<input name="slide_link" value="<?php echo $slide_link; ?>" style="width: 50%;" />



	<?php

}





// END // Slide Link

// - - - - - - - - - - - - - - - - - - - - - - -

// Save







function save_link($post_id) {



	global $post;



	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {



	return $post->ID;



	} 



	update_post_meta($post->ID, "slide_link", $_POST["slide_link"]);







}







add_action('save_post', 'save_link');



// END // Save





register_post_type( 'staff',



		array(



		'labels' => array(



		'name' => __( 'Staff' ),



		'singular_name' => __( 'Staff Member' ),



		'add_new' => __( 'Add New Staff Member' ),



		'add_new_item' => __( 'Add New Staff Member' ),



		'edit' => __( 'Edit' ),



		'edit_item' => __( 'Edit Staff Member' ),



		'new_item' => __( 'New Staff Member' ),



		'view' => __( 'View Staff Member' ),



		'view_item' => __( 'View Staff Member' ),



		'search_items' => __( 'Search Staff Member' ),



		'not_found' => __( 'No Staff Members found' ),



		'not_found_in_trash' => __( 'No Staff Members found in Trash' ),



		'parent' => __( 'Parent Staff Member' )



		),



'public' => true,



'supports' => array('thumbnail','title','editor'),



'rewrite' => true,



'query_var' => true,



'exclude_from_search' => true,



'show_ui' => true,



'capability_type' => 'post'



		)

	);





function add_staff_metaboxes(){



	add_meta_box("staff_designation", "Staff Designation", "staff_metabox", "staff", "normal", "high");



}



add_action("admin_init", "add_staff_metaboxes");



// END // Add Metaboxes



// - - - - - - - - - - - - - - - - - - - - - - -



// Slide Link



function staff_metabox(){



	global $post;



	$custom = get_post_custom($post->ID);



	$staff_designation = $custom["staff_designation"][0];



	?>



    <label>Staff Designation:</label>



	<input name="staff_designation" value="<?php echo $staff_designation; ?>" style="width: 50%;" />



	<?php

}





// END // Slide Link

// - - - - - - - - - - - - - - - - - - - - - - -

// Save







function save_designation($post_id) {



	global $post;



	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {



	return $post->ID;



	} 



	update_post_meta($post->ID, "staff_designation", $_POST["staff_designation"]);

}

add_action('save_post', 'save_designation');





	register_post_type( 'sermon_post',



		array(



			'labels' => array(



			'name' => __( 'Media Items' ),



			'singular_name' => __( 'Media Item' ),



			'add_new' => __( 'Add New' ),



			'add_new' => 'Add New Media Item',



			'add_new_item' => __( 'Add New Media Item' ),



	'edit' => __( 'Edit' ),



	'edit_item' => __( 'Edit Media Item' ),



	'new_item' => __( 'New Media Item' ),



	'view' => __( 'View Media Item' ),



	'view_item' => __( 'View Media Item' ),



	'search_items' => __( 'Search Media Items' ),



	'not_found' => __( 'No Media Items found' ),



	'not_found_in_trash' => __( 'No Media Items found in Trash' ),



	'parent' => __( 'Parent Media Item' ),

	



	),



'public' => true,



'supports' => array('title','editor','comments','thumbnail'),



'query_var' => true,



'exclude_from_search' => false

		)



	);

register_taxonomy('media_tags', 'sermon_post', array(

		'hierarchical' => false,

		'labels' => array(

			'name' => _x( 'Media Tags', 'taxonomy general name' ),

			'singular_name' => _x( 'Media Tags', 'taxonomy singular name' ),

			'search_items' =>  __( 'Search Media Tags' ),

			'all_items' => __( 'All Media Tags' ),

			'parent_item' => __( 'Parent Media Tag' ),

			'parent_item_colon' => __( 'Parent Media Tag:' ),

			'edit_item' => __( 'Edit Media Tag' ),

			'update_item' => __( 'Update Media Tag' ),

			'add_new_item' => __( 'Add New Media Tag' ),

			'new_item_name' => __( 'New Media Tag' ),

			'menu_name' => __( 'Media Tags' )

		),

		// Control the slugs used for this taxonomy

		'rewrite' => array(

			'slug' => 'media-tags', 

			'with_front' => true, 

			'hierarchical' => false

		),

	));

}





// Create Meta boxes for media post type



function add_sermon_metaboxes(){



	add_meta_box("sermon_speaker", "Sermon Speaker", "sermon_metabox", "sermon_post", "side", "low");



	add_meta_box("sermon_filelink", "Sermon Link", "sermon_metabox1", "sermon_post", "side", "low");

	add_meta_box("sermon_ytlink", "Sermon Youtube Link", "sermon_metabox2", "sermon_post", "side", "low");

}



add_action("admin_init", "add_sermon_metaboxes");





// END // Add Metaboxes



// - - - - - - - - - - - - - - - - - - - - - - -



// Sermon Speaker



function sermon_metabox(){



	global $post;



	$custom = get_post_custom($post->ID);



	$sermon_speaker = $custom["sermon_speaker"][0];



	?>



    <label>Name of the speaker:</label>



    <input name="sermon_speaker" value="<?php echo $sermon_speaker; ?>" style="width: 90%;" />



<?php



}



// END // Sermon Speaker



// - - - - - - - - - - - - - - - - - - - - - - -



// Save



function save_speaker($post_id) {



	global $post;



	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {



	return $post->ID;



	} 



	update_post_meta($post->ID, "sermon_speaker", $_POST["sermon_speaker"]);



}



add_action('save_post', 'save_speaker');



// - - - - - - - - - - - - - - - - - - - - - - -

function sermon_metabox2(){



	global $post;



	$custom = get_post_custom($post->ID);



	$sermon_ytlink = $custom["sermon_ytlink"][0];



	?>



    <label>Link to video file:</label>



    <input name="sermon_ytlink" value="<?php echo $sermon_ytlink; ?>" style="width: 90%;" />



<?php



}



// END // Sermon Speaker



// - - - - - - - - - - - - - - - - - - - - - - -



// Save



function save_ytlink($post_id) {



	global $post;



	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {



	return $post->ID;



	} 



	update_post_meta($post->ID, "sermon_ytlink", $_POST["sermon_ytlink"]);



}



add_action('save_post', 'save_ytlink');

// - - - - - - - - - - - - - - - - - - - - - - -



// Sermon Link



function sermon_metabox1(){



	global $post;



	$custom = get_post_custom($post->ID);



	$sermon_filelink = $custom["sermon_filelink"][0];



	?>







    <label>Link to the Mp3 File:</label>



    <input name="sermon_filelink" value="<?php echo $sermon_filelink; ?>" style="width: 100%;" />



<?php



}



// END // Sermon Link



// - - - - - - - - - - - - - - - - - - - - - - -



// Save



function save_filelink($post_id) {



	global $post;



	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {



	return $post->ID;



	} 



	update_post_meta($post->ID, "sermon_filelink", $_POST["sermon_filelink"]);



}



add_action('save_post', 'save_filelink');



// - - - - - - - - - - - - - - - - - - - - - - -



/**

 * Enables the Event custom post type

*/

require_once(STYLESHEETPATH . '/extensions/event-post-type.php');



/**

 * Removes default thumbnail width/height attr

*/

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );  

add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 ); 

function remove_thumbnail_dimensions( $html ) {     

$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );   

return $html; } 





function start_date_column_register( $columns ) {

       $columns['start_date'] = __( 'Event Date', 'my-plugin' );

 

	return $columns;;

}

add_filter("manage_edit-events_columns", "start_date_column_register");

 

// Display the column content

function start_date_column_display( $column_name, $post_id ) {

        if ( 'start_date' != $column_name )

                return;

 

        $start_date = get_post_meta($post_id, 'events_date', true);

        if ( !$start_date )

                $start_date = '<em>undefined</em>';

 

        print(date("F d, Y", strtotime($start_date)));

}

add_action( 'manage_posts_custom_column', 'start_date_column_display', 10, 2 );

 

// Register the column as sortable

function start_date_column_register_sortable( $columns ) {

        $columns['start_date'] = 'start_date';

 

        return $columns;

}

add_filter( 'manage_edit-events_sortable_columns', 'start_date_column_register_sortable' );

 

function start_date_column_orderby( $vars ) {

        if ( isset( $vars['orderby'] ) && 'start_date' == $vars['orderby'] ) {

                $vars = array_merge( $vars, array(

                        'meta_key' => 'events_date',

                        'orderby' => 'meta_value'

                ) );

        }

 

        return $vars;

}

add_filter( 'request', 'start_date_column_orderby' );

?>