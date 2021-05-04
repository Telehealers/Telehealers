<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="middle" class="inner-page-middle">
	  <section class="about-page">
	    <div class="container">
	      <div class="row text-center">
	        <div class="col-md-12">
	        	<?php if ( have_posts() ) : ?>
						<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
						<?php else : ?>
							<h2 class="page-title"><?php _e( 'Nothing Found', 'twentyseventeen' ); ?></h2>
						<?php endif; ?>
	        </div>
	      </div>

	      <div class="row text-center">
	      	<div class="col-md-12">
	      		<?php
							if ( have_posts() ) :
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/post/content', 'excerpt' );

								endwhile; // End of the loop.

								the_posts_pagination( array(
									'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
								) );

							else : ?>

								<h2><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></h2>
								<?php
									get_search_form();

							endif;
						?>
	      	</div>
	      </div>
	    </div>
	  </section>
	</div>

<?php get_footer();
