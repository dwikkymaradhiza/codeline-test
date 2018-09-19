<?php
/**
 * The Template for displaying film single posts.
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-9 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content-single', 'films' ); ?>
			<?php unite_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
  <div class="col-sm-3 col-md-4 home-widget-area">
    <div class="home-widget">
      <?php if( is_active_sidebar('home3') ) dynamic_sidebar( 'home3' ); ?>
    </div>
  </div>
<?php get_footer(); ?>