<?php
/*
Template Name: Staff
*/
?>

<?php get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start leftcol -->
        <section id="leftcol">
            <article class="post">
		<section class="title">
                	<h2 class="page-title"><?php _e('Our Staff'); ?></h2>
		</section>
                <?php query_posts(array('post_type'=>'staff', 'posts_per_page' => -1)); ?>
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <!-- commoncol -->
                <section class="Commoncol entry">
			<?php the_post_thumbnail('staff-thumb', $thumb_attr); ?>
                    	<h4><?php the_title(); ?></h4>
                    	<h5><?php echo get_post_meta($post->ID, 'staff_designation', true); ?></h5>
               	  	<?php the_content(); ?>
			<section class="clear"></section>
                </section>
                <!-- commoncol -->
            <?php endwhile; endif; wp_reset_query(); ?>
            </article>
            <div class="clear"></div>
	    <!-- pagination -->
	    <?php if (function_exists("pagination")) {
			pagination($additional_loop->max_num_pages);
	    } ?>
	    <!-- pagination -->
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