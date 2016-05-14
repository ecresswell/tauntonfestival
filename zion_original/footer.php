</section>

<!-- start footer -->

<footer id="footer">

	<section class="box">

    	<span class="gray"><?php _e('&copy;'); ?> <?php bloginfo('name'); ?>. Registered Charity No. 900556</span>

    	<?php

			wp_nav_menu( array(

			'theme_location'	=> 'footer-menu',

			'menu_id'		=> 'footer-menu-links',

			'container'		=> false, // don't wrap in div

			'fallback_cb'		=> false // don't show pages if no menu found - show nothing

						) );

						?>

    	<div class="clear"></div>

    </section>

</footer>

<!-- end footer -->

<?php wp_footer(); ?>



<?php if ( get_option('church_google_analytics') <> "" ) { echo stripslashes(get_option('church_google_analytics')); } ?>



</body>

</html>
