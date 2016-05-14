<?php

// =============================== Flickr widget ======================================

function flickrWidget()

{
	$settings = get_option("widget_flickrwidget");
	$id = $settings['id'];
	$number = $settings['number'];
?>
<div id="flickr" class="widget">
	<h4 class="widget_title"><?php _e('Flickr Photos',churchthemes); ?></h4>
	<div class="wrap">
		<div class="fix"></div>
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=m&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
		<div class="clear"></div>
	</div>
</div>
<?php
}

function flickrWidgetAdmin() {
	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent

	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));
		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';

	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}

register_sidebar_widget('church - Flickr', 'flickrWidget');
register_widget_control('church - Flickr', 'flickrWidgetAdmin', 400, 200);




// =============================== Twitter widget ======================================



function widget_Twidget_init() {







	if ( !function_exists('register_sidebar_widget') )



		return;









	function widget_Twidget($args) {







		// "$args is an array of strings that help widgets to conform to



		// the active theme: before_widget, before_title, after_widget,



		// and after_title are the array keys." - These are set up by the theme



		extract($args);







		// These are our own options



		$options = get_option('widget_Twidget');



		$account = $options['account'];  // Your Twitter account name



		$title = $options['title'];  // Title in sidebar for widget



		$show = $options['show'];  // # of Updates to show







        // Output



		echo $before_widget ;







		// start



		echo '<div id="twitter" class="widget">';



		echo '<h3><img src="http://www.negrita.com/new2011/wp-content/uploads/2011/09/twitter1.png" alt="Twitter" width="48"  height="48"/></h3>';              



		echo '<ul id="twitter_update_list"><li></li></ul>



		      <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>';



		echo '<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/'.$account.'.json?callback=twitterCallback2&amp;count='.$show.'"></script>';



		echo '<span class="wechurchte"><a href="http://www.twitter.com/'.$account.'/" title="Follow us on Twitter" target="_blank"><img src="http://www.negrita.com/new2011/wp-content/uploads/2011/09/follow-us-on-twitter.jpg" alt="" /></a></span></div>';


		// echo widget closing tag
		echo $after_widget;

	}

	// Settings form
	function widget_Twidget_control() {

		// Get options
		$options = get_option('widget_Twidget');

		// options exist? if not set defaults
		if ( !is_array($options) )
			$options = array('account'=>'churchthemes', 'title'=>'Twitter Updates', 'show'=>'3');

        // form posted?
		if ( $_POST['Twitter-submit'] ) {
			// Remember to sanitize and format use input appropriately.
			$options['account'] = strip_tags(stripslashes($_POST['Twitter-account']));
			$options['title'] = strip_tags(stripslashes($_POST['Twitter-title']));
			$options['show'] = strip_tags(stripslashes($_POST['Twitter-show']));
			update_option('widget_Twidget', $options);
		}

		// Get options for form fields to show

		$account = htmlspecialchars($options['account'], ENT_QUOTES);
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$show = htmlspecialchars($options['show'], ENT_QUOTES);

		// The form fields

		echo '<p style="text-align:right;">
				<label for="Twitter-account">' . __('Account:') . '
				<input style="width: 200px;" id="Twitter-account" name="Twitter-account" type="text" value="'.$account.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-title">' . __('Title:') . '
				<input style="width: 200px;" id="Twitter-title" name="Twitter-title" type="text" value="'.$title.'" />
				</label></p>';
		echo '<p style="text-align:right;">
				<label for="Twitter-show">' . __('Show:') . '
				<input style="width: 200px;" id="Twitter-show" name="Twitter-show" type="text" value="'.$show.'" />
				</label></p>';
		echo '<input type="hidden" id="Twitter-submit" name="Twitter-submit" value="1" />';
	}



	// Register widget for use
	register_sidebar_widget(array('church - Twitter', 'widgets'), 'widget_Twidget');
	// Register settings for use, 300x200 pixel form
	register_widget_control(array('church - Twitter', 'widgets'), 'widget_Twidget_control', 300, 200);
}

// Run code and init
add_action('widgets_init', 'widget_Twidget_init');

// =============================== Search widget ======================================

function searchWidget()
{
include(TEMPLATEPATH . '/search-form.php');
}
register_sidebar_widget('church - Search', 'SearchWidget');

/* Deregister Default Widgets */

/*

function church_deregister_widgets(){



    unregister_widget('WP_Widget_Search');         



}



add_action('widgets_init', 'church_deregister_widgets');  



*/


add_action( 'widgets_init', 'feat_page_load_widgets' );
function feat_page_load_widgets() {
	register_widget( 'Widget_Recent_Events' );
}
class Widget_Recent_Events extends WP_Widget {
	function Widget_Recent_Events() {
		$widget_ops = array('classname' => 'Widget_Recent_Events', 'description' => __( 'Upcoming Events') );
		$this->WP_Widget('recent_events', __('Upcoming Events'), $widget_ops);
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Upcoming Events' ) : $instance['title'], $instance, $this->id_base);
		



		$feat_query = array('post_type'=>'events','meta_key' => 'events_date',
     'orderby' => 'meta_value',
     'posts_per_page' => -1,
     'order' => 'ASC',
     'meta_compare' => '>=',
     'value' => date('Y/m/d', strtotime('-1 day'))) ; ?><?php //echo date('m/d/Y');
		$feat_posts = new WP_Query();
		$feat_posts->query($feat_query); $i=1;
		if ($feat_posts->have_posts()) { 
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
				echo '<ul>';
			while ($feat_posts->have_posts()&&($i<=5)) : $feat_posts->the_post();
				$meta = get_post_meta(get_the_ID(), 'events_date', true );
	$ss = date('Y-m-d', strtotime( $meta ) ); $sb = date_i18n( 'Y-m-d' ); if($ss>$sb): 
	echo '<li>'; $i++;
	echo '<span class="date"><b>'.( date( 'M' , strtotime( $meta ) ) ).'</b>'.( date( 'j' , strtotime( $meta ) ) ).'</span>
	<p><span class="title"><a href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></span>'
	.('Time: ').get_post_meta(get_the_ID(),'events_time',true).'<br />'.('Location: ').get_post_meta(get_the_ID(), 'events_venue', true). 
	 '</li>';
			endif;
			endwhile; wp_reset_query(); echo '</ul>';
			echo $after_widget;
		}
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}
	function form( $instance ) {
		$title = esc_attr( $instance['title'] );
		
	?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
     
        
<?php } } ?>
<?php
add_action( 'widgets_init', 'feat_page_widgets' );
function feat_page_widgets() {
	register_widget( 'Widget_Recent_Sermons' );
}
class Widget_Recent_Sermons extends WP_Widget {
	function Widget_Recent_Sermons() {
		$widget_ops = array('classname' => 'Widget_Recent_Sermons', 'description' => __( 'Recent Sermons') );
		$this->WP_Widget('recent_sermons', __('Recent Sermons'), $widget_ops);
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'Recent Events' ) : $instance['title'], $instance, $this->id_base);
		
		$feat_query = array(
			'posts_per_page'=>5,
			'post_type' => 'sermon_post'
		);
		$feat_posts = new WP_Query();
		$feat_posts->query($feat_query);
		if ($feat_posts->have_posts()) { 
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
				echo '<ul>';
			while ($feat_posts->have_posts()) : $feat_posts->the_post();
			
		echo '<li><span class="date"><b>'.get_the_time('M').'</b>'.get_the_time('j').'</span><p><span class="title"><a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></span>'.('Speaker: ').get_post_meta(get_the_ID(),'sermon_speaker',true).'<br />' .get_the_term_list( $post->ID, 'media_tags', 'Tags: ', ', ', '' );
				$meta = get_post_meta(get_the_ID(), 'events_date', true );
	$ss = date('Y-m-d', strtotime( $meta ) ); $sb = date_i18n( 'Y-m-d' ); if($ss>$sb): 
	echo '</li>';
			endif;
			endwhile; echo '</ul>';
			echo $after_widget;
		}
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}
	function form( $instance ) {
		$title = esc_attr( $instance['title'] );
		
	?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
     
        
<?php } } ?>