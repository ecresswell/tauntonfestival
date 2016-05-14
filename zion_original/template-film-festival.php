<?php /* Template name: Film Festival */ ?>

<?php get_header(); ?>
<!-- start container -->

<link href="/wp-content/themes/zion/styles/red_film_festival.css" rel="stylesheet" />

<section id="container">

	<section class="box">

    	<!-- start leftcol -->

        <section id="leftcol">

        	<!-- start post -->

            <article class="post page">

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

		<section class="title">

                	<img src="/wp-content/uploads/2014/03/logo-film-festival.png" style="float:right" class="" alt="Music Festival" /><h2 class="page-title" style="display:inline"><?php the_title(); ?></h2>

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
