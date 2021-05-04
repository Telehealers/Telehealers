<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();
$postID = get_the_ID();
?>
<div id="middle" class="catpage mt-0">
  <section class="blog-banner blog-slider">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <?php
        $argsCN = array(
          'post_type' => 'blog',
          'post_status' => 'publish',
          'posts_per_page' => 100,
        );

        $queryCN = new WP_Query($argsCN);

        if ($queryCN->have_posts()) {
          $i = 1;
          while ($queryCN->have_posts()) {

            $queryCN->the_post();
            $post_idCN = get_the_ID();
            $term_list = get_the_terms($post_idCN, 'blog-category');
            $cate_name = $term_list[0]->name;
        ?>
        ?>
            <div class="carousel-item second-slide <?php if ($i != 1) {
                                                      echo "";
                                                    } else {
                                                      echo "active";
                                                    } ?>">
              <div class="carousel-caption">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="overlay"> <span class="post-cat"><a href="#" class="category"><?php echo $cate_name; ?></a></span>
                        <h1 class="post-title"><?php echo the_title(); ?></h1>
                        <span class="post-by meta-item">By <span><a href="<?php echo get_permalink($post_idCN); ?>"><?php echo get_the_author(); ?></a></span></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        <?php $i++;
          }
        } ?>        
      </div>
      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
    </div>
  </section>
  <section class="blog-page blog-detail-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="left-sidebar">                       
            <div class="news-alert">                         
              <div class="posts-wrap">              
              <div class="row">
              <div class="col-md-12">           
              </div>
                <?php  
                if ( have_posts() ) {
					/* Start the Loop */
                  while ( have_posts() ) {
                  the_post();
                   
                    $post_idTU_2 = get_the_ID();

                    if ($post_idTU_2 != $post_idTU) {
                      $imageTU_2 = wp_get_attachment_image_src(get_post_thumbnail_id($post_idTU_2), 'full');
                      $image_urlTU_2 = $imageTU_2[0];
                ?>
                      <div class="col-lg-6 col-md-12">
                        <div class="post-box">
                          <div class="post-header">
                            <div class="post-thumb"> <a href="<?php echo get_permalink($post_idTU_2); ?>">
                            <img src="<?php echo $image_urlTU_2; ?>" alt="<?php echo the_title(); ?>"/></a> <span class="cat-label"><a href="#"><?php echo the_category(); ?></a></span> </div>
                            <div class="meta-title">
                              <div class="post-meta">
                                <h2 class="post-title-alt"><a href="<?php echo get_permalink($post_idTU_2); ?>"><?php echo the_title(); ?></a></h2>
                                <span class="post-author"> <span class="by">by</span> <a href="<?php echo get_permalink($post_idTU_2); ?>"><?php  the_author(); ?></a> </span> <span class="meta-sep"></span> <a href="<?php echo get_permalink($post_idTU_2); ?>" class="date-link">
                                  <time class="post-date" datetime="2020-02-19T12:39:02+05:30"><?php echo get_the_date(); ?></time>
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="post-excerpt">
                            <p><?php echo the_excerpt(); ?></p>
                          </div>
                          <div class="post-footer">
                            <ul class="social-sharee">
                              <li><a href="#"><i class="far fa-heart"></i><span class="number">0</span></a></li>
                              <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                              <li class="printes"><a href="#">Save</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>                     
                <?php }
                  }
                } ?>
              </div>              
            </div> 
            </div>
          </div>
        </div>        
      </div>
    </div>
  </section>

</div>

<?php get_footer(); ?>
<style type="text/css">
	section#arch ul li{
  color: #f15e32;
    margin-left: 15px;
    list-style: circle;
    font-weight: 500;
    margin-bottom: 2rem;
}
section#arch ul li a{
  color: #f15e32;
}
section#arch .pagination{
	display: inline-flex;
}
section#arch .pagination h2{
  font-size: 20px;
}

</style>
