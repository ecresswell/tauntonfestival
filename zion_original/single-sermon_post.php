<?php get_header(); ?>
<!-- start container -->
<section id="container">
	<section class="box">
    	<!-- start leftcol -->
        <section id="leftcol">
            <!-- start post -->
            <article class="post sermons">
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
                <section class="title">
                	<h2 class="page-title"><?php the_title(); ?></h2>
			 <span class="metaline">By <?php echo get_post_meta($post->ID,'sermon_speaker',true); ?> on <?php the_time('F j, Y'); ?></span>
		</section>
		<?php if ( get_post_meta($post->ID, 'sermon_ytlink', true) ) : ?>
                <section class="videocol">
                <?php $string = get_post_meta($post->ID,'sermon_ytlink',true);
$vim = substr($string, 0, 12);

if($vim=='http://www.y'){
				$newstring = str_replace("watch?v=", "embed/", $string); //echo $newstring;
				$setstring = str_replace("&feature=related", "", $newstring); //echo $newstring; ?>
           	    	<?php echo '<iframe width="425" height="349" src="'; ?> <?php echo $setstring; ?> <?php echo '"frameborder="0" allowfullscreen></iframe>'; }
if($vim=='http://vimeo'){
$vimeolink = str_replace("http://vimeo.com/", "", $string);
echo '<iframe src="http://player.vimeo.com/video/'; ?> <?php echo $vimeolink; ?> <?php echo '"width="425" height="349" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; }
 ?> 
                </section>
		<section class="clear"></section>
		<?php endif; ?>
		<?php if ( get_post_meta($post->ID, 'sermon_filelink', true) ) : ?>
		<section class="audiocol">
			<audio class="audio-player" src="<?php echo get_post_meta($post->ID,'sermon_filelink',true); ?>" type="audio/mp3" controls="controls"></audio>	
		</section>
		<?php endif; ?>
                <section class="entry">
                	<section class="meta-line">
                    		<?php echo get_the_term_list( $post->ID, 'media_tags', 'Tags: ', ', ', '' ); ?>
			</section>
                    	<?php the_content(); ?>  
                </section>
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