<?php get_header(); ?>

<!-- start container -->

<section id="container">

	<section class="box">

    	<!-- start leftcol -->

        <section id="leftcol">

	<h3 class="result-heading"><?php _e('Search results for'); ?> &ldquo;<?php printf(__('%s'), $s) ?>&rdquo;</h3>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="post listing">

                <section class="title">

                	<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                </section>

                <?php the_post_thumbnail(); ?>

                <section class="meta">

                	<ul>

                    	<li class="author">By <?php the_author(); ?></li>

                        <li class="comments-count"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?></li>

                        <li class="date"><?php the_time('F j, Y'); ?></li>

                    </ul>
		    <div class="clear"></div>
                </section>

		<div class="clear"></div>

                <section class="entry">

                    <?php the_excerpt(); ?>

                    <span class="more"><a href="<?php the_permalink(); ?>" title="Read More">Read More</a></span>

                </section>

            </article>

            <!-- post1 -->

            <?php endwhile; endif; ?>

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