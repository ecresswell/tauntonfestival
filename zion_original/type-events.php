<?php

/*

Template Name: Events

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

            		<h2 class="page-title"><?php _e('Upcoming Events'); ?></h2>

	    	</section>

	    </section>

	    <section class="widget">

		<ul><?php $sp=date('m/d/Y'); ?>

            		<?php query_posts( array('post_type'=>'events','meta_key' => 'events_date',
     'orderby' => 'meta_value',
     'posts_per_page' => -1,
     'order' => 'ASC',
     'meta_compare' => '>=',
     'value' => date('Y/m/d', strtotime('-1 day'))) ); ?><?php //echo date('m/d/Y'); ?>

                	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                	<?php $meta = get_post_meta($post->ID, 'events_date', true );

	$ss = date('Y-m-d', strtotime( $meta ) ); $sb = date_i18n( 'Y-m-d' ); if($ss>=$sb):?>

                    <li>

                    	<span class="right">Time: <?php echo get_post_meta($post->ID,'events_time',true); ?></span>

                        <span class="date"><b><?php esc_html_e( date( 'M' , strtotime( $meta ) ) ); ?></b><?php esc_html_e( date( 'j' , strtotime( $meta ) ) ); ?></span>

                        <p><span class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span> Location: <?php echo get_post_meta($post->ID, 'events_venue', true); ?></p>

                    </li>

                    <?php endif; ?>

                    <?php endwhile; endif; ?>

		</ul>

	     

             </section> 

	     <?php wp_reset_query(); ?>

        </section>

        <!-- end leftcol -->

        <!-- start rightcol -->

        <aside id="rightcol">

        	<?php dynamic_sidebar( 'sidebar-2' ); ?>

        </aside>

        <!-- end rightcol -->

    	<div class="clear"></div>

    </section>

</section>

<!-- end container -->

<?php get_footer(); ?>