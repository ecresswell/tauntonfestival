<?php get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start leftcol -->
        <section id="leftcol">
        	<!-- start post -->
            <article class="post page">
		<section class="title">
                	<h2 class="page-title"><?php _e('Error 404'); ?></h2>
		</section>
                <!-- entry1 -->
                <section class="entry single">
                    <p><?php _e('The page you are looking for does not exist. Please check the URL for typing errors, or'); ?> <a href="<?php bloginfo('home'); ?>" title="Go Home"><?php _e('head back home'); ?></a> <?php _e('and start over'); ?></p>
                </section>
                <!-- entry1 -->
            </article>
            <!-- end post -->
            
        </section>
        <!-- end leftcol -->
        <!-- start rightcol -->
        <aside id="rightcol">
        	<?php get_sidebar(); ?>
        </aside>
        <!-- end rightcol -->
    	<div class="clear"></div>
    </section>
</section>
<!-- end container -->
<?php get_footer(); ?>