<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start showcase -->
        <section id="showcase">
		<script type="text/javascript">
		jQuery(window).load(function() { jQuery('#slider').nivoSlider({ effect: '<?php echo get_option('church_slideshow_effect'); ?>', slices: 5, boxCols: 5, boxRows: 5, animSpeed: 700, directionNavHide:false, controlNav: true, pauseTime: <?php if (get_option('church_slideshow_pausetime') != "") { echo get_option('church_slideshow_pausetime'); } else { echo 7000; } ?> }); });

		</script>
		<section class="slider-wrapper theme-default">
        	<section id="slider" class="nivoSlider">
                		<?php
				$query = new WP_Query();
				$query->query('post_type=slide');
				$post_count = $query->post_count;
				$count = 0;
				if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); $captions[] = '<h2>'.get_the_title($post->ID).'</h2><p>'.get_the_content().'</p>'; $thumb_attrs = array( 'title' => '#caption'.$count );
				?>

				<?php if ( get_post_meta($post->ID, 'slide_link', true) ) { ?>
					<?php if ( has_post_thumbnail()) { ?>
   	      					<a href="<?php echo get_post_meta($post->ID, 'slide_link', true); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('slide-background', $thumb_attrs); ?></a>
                    			<?php } ?>
					<?php } else { ?>
						<?php if ( has_post_thumbnail()) { ?>
							<?php the_post_thumbnail('slide-background', $thumb_attrs); ?>
						<?php } ?>
					<?php } ?>
				<?php $count++; endwhile; endif; wp_reset_query(); ?>
            	</section>
            </section>
        </section>
        <!-- end showcase -->
	<?php if (get_option('church_tag') != "") { ?>
        	<h1 class="main-title"><?php echo get_option('church_tag'); ?></h1>
	<?php } ?>
        <section class="homepage-widgets">
        	<?php dynamic_sidebar( 'sidebar-4' ); ?>
    		<div class="clear"></div>
	</section>
    </section>
</section>
<!-- end container -->
<?php get_footer(); ?>