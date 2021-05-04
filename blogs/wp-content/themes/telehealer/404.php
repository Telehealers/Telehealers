<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="middle" class="pagenotfound inner-page-middle">
	  <section class="about-page">
	    <div class="container">
	      <div class="row text-center">
	        <div class="col-md-12">
	        	<h1><?php _e( 'We’re sorry!', 'twentyseventeen' ); ?></h1>
	        	<p><?php _e( 'The page youre looking for may have been moved or deleted. Start a new search on Ecomsolver.com', 'twentyseventeen' ); ?></p>
	        </div>
	      </div>
	    </div>
	  </section>
</div>

<?php get_footer();
