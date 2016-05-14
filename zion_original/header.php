<!DOCTYPE html>

<html>

<head>

<title>

<?php if ( is_home() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php bloginfo('description'); ?><?php } ?>

<?php if ( is_search() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Search Results',churchthemes); ?><?php } ?>

<?php if ( is_author() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Author Archives',churchthemes); ?><?php } ?>

<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;|&nbsp;<?php bloginfo('name'); ?><?php } ?>

<?php if ( is_page() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php wp_title(''); ?><?php } ?>

<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Archive',churchthemes); ?>&nbsp;|&nbsp;<?php single_cat_title(); ?><?php } ?>

<?php if ( is_month() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Archive',churchthemes); ?>&nbsp;|&nbsp;<?php the_time('F'); ?><?php } ?>

<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php _e('Tag Archive',churchthemes); ?>&nbsp;|&nbsp;<?php  single_tag_title("", true); } } ?>

<?php if ( is_tax() ) { ?><?php bloginfo('name'); ?>&nbsp;|&nbsp;<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  $term_title = $term->name; echo "$term_title"; ?><?php } ?>

</title>

<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">

<!--[if lt IE 9]>

	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->

<!--[if lt IE 9]>

	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

<![endif]-->


<!--[if IE 7]>

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie7.css" media="screen">

<![endif]-->

<!--[if lte IE 6]>

	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/pngfix.js"></script>

	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ie6.js"></script>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/ie6.css" type="text/css">

<![endif]-->

<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php if ( get_option('church_feedburner_url') <> "" ) { echo get_option('church_feedburner_url'); } else { echo get_bloginfo_rss('rss2_url'); } ?>">

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php if ( is_single() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php echo get_option( 'church_exscripts' ); ?>

<?php wp_head(); ?>

</head>

<body>

<section class="wrapper">

<!-- start header -->

<header id="header">

  	<section class="box">

    		<!-- logo -->

    		<section id="logo">

            		<div><span><a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('title'); ?>"><?php if ( get_option( 'church_logo' ) <> "" ) { ?><img src="<?php echo get_option( 'church_logo' ); ?>" alt="logo" /><?php } else { ?><?php bloginfo('title'); ?><?php } ?></a></span></div>

      		</section>

      		<!-- logo -->

      		<?php if ( get_option( 'church_address' ) <> "" ) { ?><a href="http://maps.google.com/?q=<?php echo get_option( 'church_address' ); ?>" title="get directions" target="_blank" class="location"><?php _e('Map &amp; Directions'); ?></a><?php } ?>

    	</section>

</header>

<!-- end header -->

<!-- start navigation -->

<nav id="navigation">

	<section class="box">
		<section class="style-select">
        	<?php

			wp_nav_menu( array(

			'theme_location'	=> 'main-nav-menu',

			'menu_id'		=> 'header-menu-links',

			'container'		=> false, // don't wrap in div

			'fallback_cb'		=> false // don't show pages if no menu found - show nothing

						) );

						?>
		</section>
    	</section>

</nav>

<!-- end navigation -->