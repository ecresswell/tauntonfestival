<?php

// Register widgetized areas

function the_widgets_init() {
    if ( !function_exists('register_sidebars') )
        return;

    register_sidebar(array('name' => 'Sidebar Widgets','id' => 'sidebar-1','before_widget' => '<section id="%1$s" class="widget %2$s">','after_widget' => '</section>','before_title' => '<h4>','after_title' => '</h4>'));

     register_sidebar(array('name' => 'Events Page Widgets','id' => 'sidebar-2','before_widget' => '<section id="%1$s" class="widget %2$s">','after_widget' => '</section>','before_title' => '<h4>','after_title' => '</h4>'));

     register_sidebar(array('name' => 'Media Page Widgets','id' => 'sidebar-3','before_widget' => '<section id="%1$s" class="widget %2$s">','after_widget' => '</section>','before_title' => '<h4>','after_title' => '</h4>'));

     register_sidebar(array('name' => 'Home Page Widgets','id' => 'sidebar-4','before_widget' => '<section id="%1$s" class="widget %2$s">','after_widget' => '</section>','before_title' => '<h4>','after_title' => '</h4>'));
	
	 

}

add_action( 'init', 'the_widgets_init' );


    
?>