<?php
/*
* Sermon Posts taxonomy archive
*/
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>

<!-- start container -->

<section id="container">

	<section class="box">

    	<!-- start leftcol -->

        <section id="leftcol">

        	<section class="post">

	    	<section class="title">

            		<h2 class="page-title">Sermons tagged as "<?php echo apply_filters( 'the_title', $term->name ); ?>"</h2>

	    	</section>

	    </section>

	    <section class="widget">

		<ul>

                

                 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <li>

                        <span class="date"><b><?php the_time('M'); ?></b><?php the_time('j'); ?></span>

                        <p><span class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span> <?php _e('Speaker:'); ?> <?php echo get_post_meta($post->ID,'sermon_speaker',true); ?></p>

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