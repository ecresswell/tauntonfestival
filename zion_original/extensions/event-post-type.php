<?php
/**
 * Enable Custom Post Types for Events
 */
 
// Registers the new post type and taxonomy

function devinsays_event_posttype() {
	register_post_type( 'events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'event' ),
				
				'add_new' => __( 'Add New Event' ),
				'add_new_item' => __( 'Add New Event' ),
				'edit_item' => __( 'Edit Event' ),
				'new_item' => __( 'Add New Event' ),
				'view_item' => __( 'View Event' ),
				'search_items' => __( 'Search Event' ),
				'not_found' => __( 'No events found' ),
				'not_found_in_trash' => __( 'No events found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
			'capability_type' => 'post',
			'rewrite' => array( 'slug' => 'event', 'with_front' => true ),
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/images/calendar-icon.gif',  // Icon Path
			'exclude_from_search' => false,
			'menu_position' => '5'
		)
	);
	
	register_taxonomy( 'event-tags', 'events', 
		array( 
			'hierarchical' => false,
			'label' => __( 'Event Tags' ), 
			'labels' => array(
				'name' => __( 'Event Tags' ),
				'singular_name' => __( 'Event Tag' )
			)
		) 
	);
}

add_action( 'init', 'devinsays_event_posttype' );







// Add Metaboxes for events

function add_events_metaboxes(){

	add_meta_box("events_venue", "Event Venue", "events_metabox", "events", "normal", "high");
	add_meta_box("events_location", "Event Location", "events_metabox1", "events", "normal", "high");
	add_meta_box("events_date", "Event Date", "events_metabox2", "events", "side", "low");
	add_meta_box("events_time", "Event Time", "events_metabox4", "events", "side", "low");
}

add_action("admin_init", "add_events_metaboxes");

// END // Add Metaboxes

// - - - - - - - - - - - - - - - - - - - - - - -

// Slide Link

function events_metabox(){

	global $post;

	$custom = get_post_custom($post->ID);

	$events_venue = $custom["events_venue"][0];
	

	?>

    <label>Event Venue:</label>

	<input name="events_venue" value="<?php echo $events_venue; ?>" style="width: 50%;" />
   
	<?php

}

function events_metabox2(){

	global $post;

	$custom = get_post_custom($post->ID);

	$events_date = $custom["events_date"][0];
	

	?>

    <label>Event Date:</label>

	<input name="events_date" value="<?php echo $events_date; ?>" style="width: 50%;" /><br />
    <label>Enter Event Date in <strong>YYYY/MM/DD</strong> Format</label>
   
	<?php

}

function events_metabox4(){

	global $post;

	$custom = get_post_custom($post->ID);

	$events_time = $custom["events_time"][0];
	

	?>

    <label>Event Time:</label>

	<input name="events_time" value="<?php echo $events_time; ?>" style="width: 50%;" />
   
	<?php

}

function events_metabox1(){

	global $post;

	$custom = get_post_custom($post->ID);

	$events_location = $custom["events_location"][0];
	

	?>

    <label>Event Location:</label>

	<input name="events_location" value="<?php echo $events_location; ?>" style="width: 50%;" />
   
	<?php

}
// END // Slide Link

// - - - - - - - - - - - - - - - - - - - - - - -

// Save

function save_venue($post_id) {

	global $post;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

	return $post->ID;

	} 

	update_post_meta($post->ID, "events_venue", $_POST["events_venue"]);
	

}


add_action('save_post', 'save_date');

function save_date($post_id) {

	global $post;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

	return $post->ID;

	} 

	update_post_meta($post->ID, "events_date", $_POST["events_date"]);
	

}


add_action('save_post', 'save_time');

function save_time($post_id) {

	global $post;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

	return $post->ID;

	} 

	update_post_meta($post->ID, "events_time", $_POST["events_time"]);
	

}


add_action('save_post', 'save_venue');

function save_location($post_id) {

	global $post;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

	return $post->ID;

	} 

	update_post_meta($post->ID, "events_location", $_POST["events_location"]);
	

}


add_action('save_post', 'save_location');




?>