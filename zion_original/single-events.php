<?php
/**
 * The Template for displaying all single events posts.
 */
get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start leftcol -->
        <section id="leftcol">
        	<!-- start post -->
            <article class="post">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 		<?php $meta = get_post_meta($post->ID, 'events_date', true ); ?>
		<section class="title">
                	<h2 class="page-title"><?php the_title(); ?></h2>
		</section>
                <!-- entry1 -->
                <section class="entry">
                	<section class="meta-line">
                    		<span class="black"><strong>Event Date:</strong> <?php esc_html_e( date( 'F j, Y' , strtotime( $meta ) ) ); ?></span>
                        	<span class="black"><strong>Time:</strong> <?php echo get_post_meta($post->ID,'events_time',true); ?></span>
                        	<span class="black"><strong>Location:</strong> <?php echo get_post_meta($post->ID, 'events_venue', true); ?></span>
                        	<span class="black"><address><strong>Address:</strong> <a href="http://maps.google.com/?q=<?php echo get_post_meta($post->ID, 'events_location', true); ?>" target="_blank"><?php echo get_post_meta($post->ID, 'events_location', true); ?></a></address></span>
                    </section>
                    <?php the_content(); ?>
                </section>
                <!-- entry1 -->
            </article>
            <!-- end post -->
            <?php endwhile; endif; ?>
            
            <?php comments_template(); ?>
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