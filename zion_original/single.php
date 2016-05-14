<?php get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start leftcol -->
        <section id="leftcol">
        	<!-- start post -->
            <article class="post">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		<section class="title">
                	<h2 class="page-title"><?php the_title(); ?></h2>
			<section class="metaline"><?php _e('Published'); ?> <?php the_time('F j, Y'); ?> by <?php the_author(); ?> in <?php the_category(', '); ?></section>
		</section>
                <!-- entry1 -->
                <section class="entry single">
                    <?php the_post_thumbnail(); ?>
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