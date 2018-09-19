<?php
/**
 * The template for displaying Film Archive pages.
 */

 get_header(); ?>

	<div id="primary" class="content-area col-sm-9 col-md-8">
		<main id="main" class="site-main" role="main">

      <?php 
      $args = array('post_type' => array('posts', 'films'));

      query_posts($args);

      while ( have_posts() ) : the_post(); 
      ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content list-movie">
            <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('full', array('class' => 'img-thumbnail')); ?></a>
            <?php the_content(); ?>
            <?php
            echo '<strong>Release Date</strong> : ' . get_post_meta(get_the_ID(), 'Release Date', true);
            echo ' | ';
            echo '<strong>Ticket Price</strong> : ' . get_post_meta(get_the_ID(), 'Ticket Price', true);
            echo ' | ';

            $countries = get_the_terms(get_the_ID(), 'countries');
            $genres = get_the_terms(get_the_ID(), 'genres');
            echo '<strong>Country</strong> : ';
            foreach ( $countries as $k => $v ) {
              echo '<span class="badge badge-primary">' . $v->name . '</span> ';
            }
            echo ' | ';

            echo '<strong>Genres</strong> : ';
            foreach ( $genres as $k => $v ) {
              echo '<span class="badge badge-primary">' . $v->name . '</span> ';
            }
            ?>
            <?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
					<?php edit_post_link( __( 'Edit', 'unite' ), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
				</article><!-- #post-## -->
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
          <hr />
			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
  </div><!-- #primary -->
  <div class="col-sm-3 col-md-4 home-widget-area">
    <div class="home-widget">
      <?php if( is_active_sidebar('home3') ) dynamic_sidebar( 'home3' ); ?>
    </div>
  </div>
<?php
	get_footer();
?>