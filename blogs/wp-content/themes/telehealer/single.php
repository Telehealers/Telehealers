<?php
get_header();
while ( have_posts() ) : the_post();
$postID = get_the_ID();
?>



<main>
      <!--? slider Area Start-->
      <div class="slider-area2 py-5" style="background-image: url(<?php echo get_field('banner_detail', 'option'); ?>);">
         <div class="single-slider slider-height2  hero-overly d-flex align-items-center">
            <div class="container">
               <div class="row">
                     <div class="col-xl-12">
                        <div class="hero-cap">
                           <h2><?php echo the_title(); ?></h2>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
      <!--================Blog Area =================-->
      <section class="blog_area single-post-area section-padding mt-5">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 posts-list">
                  <div class="single-post">

                  <?php
                 $imageLP = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                    $image_urlLP = $imageLP[0];
                    ?>
                     <div class="feature-img">
                     <img src="<?php echo $image_urlLP; ?>" alt="<?php echo the_title(); ?>"/>
                     </div>
                     <div class="blog_details">
                        <h2><?php echo the_title(); ?></h2>
                        <ul class="blog-info-link mb-3">
                            <li><a href="#"><i class="fa fa-user"></i> <?php the_author(); ?></a></li>
                        </ul>
                        <p class="excert"><?php echo the_content(); ?></p>
                     </div>
                  </div> 
                  <div class="comment-form">
                    <h4>Leave a Reply</h4>                    
                     <?php 
                              if ( comments_open() || get_comments_number() ) {
                        comments_template();
                     }
                     ?>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget popular_post_widget">
                                <h3 class="widget_title">Recent Post</h3>
                                <?php
                          $argsNews = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 15,
                          );

                          $queryNews = new WP_Query($argsNews);

                          if ($queryNews->have_posts()) {
                            while ($queryNews->have_posts()) {

                              $queryNews->the_post();
                              $post_idNews = get_the_ID();
                              $cate_name = $term_list[0]->name;
                              $imageNews = wp_get_attachment_image_src(get_post_thumbnail_id($post_idNews), 'full');
                              $image_urlNews = $imageNews[0];
                          ?>

                                <div class="media post_item">
                                    <img src="<?php echo $image_urlNews; ?>" alt="<?php echo the_title(); ?>" style="width:100px;">
                                    <div class="media-body">
                                        <a class="text-dark" href="<?php echo get_permalink(); ?>">
                                            <h3><?php echo the_title(); ?></h3>
                                        </a>
                                        <p><?php echo the_date(); ?></p>
                                    </div>
                                </div>

                                <?php }
                } ?> 
                            </aside>   
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--================ Blog Area end =================-->
   </main> 
<?php
endwhile; 
get_footer(); ?>