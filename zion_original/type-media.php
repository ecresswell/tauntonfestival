<?php
/*
Template Name: Media
*/
?>

<?php get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start leftcol -->
        <section id="leftcol">
        	<section class="post">
	    	<section class="title">
            		<h2 class="page-title"><?php _e('Sermons'); ?></h2>
	    	</section>
	    </section>
	    <section class="widget">
		<ul>
                <?php query_posts( array( 'post_type' => 'sermon_post', 'posts_per_page' => 10, 'order' => 'DESC', 'paged' => get_query_var('paged') ) ); ?>
                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <li>
                        <span class="date"><b><?php the_time('M'); ?></b><?php the_time('j'); ?></span>
                        <p><span class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span> <?php if ( get_post_meta($post->ID, 'sermon_speaker', true) ) { ?><?php _e('Speaker:'); ?> <?php echo get_post_meta($post->ID,'sermon_speaker',true); ?><?php } else { ?><?php _e('Speaker: Not Available'); ?><?php } ?></p>
                    </li>
                    <?php endwhile; endif; ?>
                </ul>
            </section>
            <!-- pagination -->
            <?php if (function_exists("pagination")) {
			pagination($additional_loop->max_num_pages);
			} ?>
            <!-- pagination -->
	    <?php wp_reset_query(); ?>
        </section>
        <!-- end leftcol -->
        <!-- start rightcol -->
        <aside id="rightcol">
        	<?php dynamic_sidebar( 'sidebar-3' ); ?>
        </aside>
        <!-- end rightcol -->
    	<section class="clear"></section>
    </section>
</section>
<!-- end container -->
<?php get_footer(); ?>