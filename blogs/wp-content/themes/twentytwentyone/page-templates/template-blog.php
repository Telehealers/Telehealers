<?php
/*
Template Name: Template Blog
*/
get_header();
$postID = get_the_ID();
?>

<section class="blog_page_css">
    <div class="banner">
        <div class="container">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="heading">
                          <h1>our blogs</h1>
                          <p>Lorem ipsum dolor sit amet consectetur adipisic do eiusmod tempor incididunt labore dolore magna aliqua enim minim veniam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<div id="middle">
  <section class="blog-banner blog-slider">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <?php
        $argsCN = array(
          'post_type' => 'blog',
          'post_status' => 'publish',
          'posts_per_page' => 50,
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
                        <span class="post-by meta-item">By <span><a href="<?php echo get_permalink($post_idCN); ?>"><?php the_author(); ?></a></span></span>
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
  <section class="subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="subscribe-inner  clearfix">
            <form method="post">
              <label class="text"><?php echo get_field('s_title', $postID); ?></label>
              <div class="fields">              
                <?php echo do_shortcode('[mailpoet_form id="1"]'); ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="boxes">
    <div class="container">
      <div class="row">
        <?php
        $postSlides = get_field('post', $postID);
        foreach ($postSlides as $psItem) {
        ?>
          <div class="col-md-4">
            <div class="cta-box">
              <a href="<?php echo $psItem['p_link']; ?>">
              <img src="<?php echo $psItem['p_image']; ?>" alt="<?php echo $psItem['p_title']; ?>">
              <span class="label"><?php echo $psItem['p_title']; ?></span>
            </a>
          </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
  <section class="blog-page blog-detail-text">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="left-sidebar">
            <div class="blog-hedding">
              <h4><?php echo get_field('tu_title', $postID); ?></h4>
              <span class="hr-line"></span>
            </div>
            <?php
            $argsTU = array(
              'post_type' => 'blog',
              'post_status' => 'publish',
              'posts_per_page' => 10,
              'blog-category' => 'Shopify',
            );

            $queryTU = new WP_Query($argsTU);

            if ($queryTU->have_posts()) {
              while ($queryTU->have_posts()) {             

              $queryTU->the_post();
              $post_idTU = get_the_ID();
              $term_list = get_the_terms($post_idTU, 'blog-category');
              $cate_name = $term_list[0]->name;
              $imageTU = wp_get_attachment_image_src(get_post_thumbnail_id($post_idTU), 'full');
              $image_urlTU = $imageTU[0];
            ?>
              <div class="featured"> <a href="<?php echo get_permalink($post_idCN); ?>">
              <img src="<?php echo $image_urlTU; ?>" alt="<?php echo the_title(); ?>"/></a> </div>
              <div class="post-meta"> <span class="cat-label"><a><?php echo $cate_name; ?></a></span>
                <h2 class="post-title-alt">
                  <a href="<?php echo get_permalink($post_idCN); ?>"><?php echo the_title(); ?></a></h2>
                <span class="post-author"><span class="by">By</span> <a href="<?php echo get_permalink($post_idCN); ?>"><?php the_author(); ?></a></span> <span class="meta-sep"></span> <a href="<?php echo get_permalink($post_idCN); ?>" class="date-link">
                  <time class="post-date" datetime="2020-02-20T06:49:34+05:30"><?php echo the_date(); ?></time>
                </a>
              </div>
              <div class="post-content">
                <p style="text-align:inherit;"><?php echo the_excerpt(); ?></p>
                <div class="read-more"><a href="<?php echo get_permalink($post_idCN); ?>"><span>Read More</span></a></div>
              </div>
            <?php }} ?>
            <div class="posts-wrap">              
              <div class="row">
              <div class="col-md-12 news-alert">
              <div class="news-hedding">
                <h4><?php echo get_field('n_title_2', $postID); ?></h4>
                <span class="hr-line"></span>
              </div>
              </div>
                <?php
                $argsTU_2 = array(
                  'post_type' => 'blog',
                  'post_status' => 'publish',
                  'posts_per_page' => 5,
                  'blog-category' => 'SEO',
                );

                $queryTU_2 = new WP_Query($argsTU_2);

                if ($queryTU_2->have_posts()) {
                  while ($queryTU_2->have_posts()) {

                    $queryTU_2->the_post();
                    $post_idTU_2 = get_the_ID();
                    $term_list = get_the_terms($post_idTU_2, 'blog-category');
                    $cate_name = $term_list[0]->name;

                    if ($post_idTU_2 != $post_idTU) {
                      $imageTU_2 = wp_get_attachment_image_src(get_post_thumbnail_id($post_idTU_2), 'full');
                      $image_urlTU_2 = $imageTU_2[0];
                ?>
                      <div class="col-lg-6 col-md-12">
                        <div class="post-box">
                          <div class="post-header">
                            <div class="post-thumb">
                              <a href="<?php echo get_permalink($post_idTU_2); ?>">
                              <img src="<?php echo $image_urlTU_2; ?>" alt="<?php echo the_title(); ?>"/></a> <span class="cat-label"><a href="#"><?php echo $cate_name; ?></a></span> </div>
                            <div class="meta-title">
                              <div class="post-meta">
                                <h2 class="post-title-alt"><a href="<?php echo get_permalink($post_idTU_2); ?>"><?php echo the_title(); ?></a></h2>
                                <span class="post-author"> <span class="by">by</span> <a href="<?php echo get_permalink($post_idTU_2); ?>"><?php the_author(); ?></a> </span> <span class="meta-sep"></span> <a href="<?php echo get_permalink($post_idTU_2); ?>" class="date-link">
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
                              <li><a target="_blank" href=""><i class="far fa-heart"></i><span class="number">0</span></a></li>
                              <li><a target="_blank" href="<?php echo get_field('facebook', 'options'); ?>"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a target="_blank" href="<?php echo get_field('twitter', 'options'); ?>"><i class="fab fa-twitter"></i></a></li>
                              <li class="printes"><a target="_blank" href="<?php echo get_field('pinterest', 'options'); ?>">Save</a></li>
                            </ul>
                          </div>
                        </div>
                      </div>                     
                <?php }
                  }
                } ?>
              </div>              
            </div>            
            <div class="news-alert">
              <div class="news-hedding">
                <h4><?php echo get_field('n_title', $postID); ?></h4>
                <span class="hr-line"></span>
              </div>
              <div class="news-box">
                <div class="row">
                <?php
                $argsNews = array(
                  'post_type' => 'blog',
                  'post_status' => 'publish',
                  'posts_per_page' => 30,
                  'blog-category' => 'Mobile App & Website',
                );

                $queryNews = new WP_Query($argsNews);

                if ($queryNews->have_posts()) {
                  while ($queryNews->have_posts()) {

                    $queryNews->the_post();
                    $post_idNews = get_the_ID();
                    $imageNews = wp_get_attachment_image_src(get_post_thumbnail_id($post_idNews), 'full');
                    $image_urlNews = $imageNews[0];
                    $term_list = get_the_terms($post_idNews, 'blog-category');
                    $cate_name = $term_list[0]->name;
                ?>
                    
                      <div class="col-lg-6 col-md-12">
                        <div class="news-box-inner clearfix">
                          <div class="post-thumb">
                            <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image_urlNews; ?>" alt="<?php echo the_title(); ?>"/></a> </div>
                          <div class="content">
                            <div class="post-meta post-meta-a">
                            <span class="post-by meta-item mt-3">By <span><a href="<?php echo get_permalink($post_idCN); ?>"><?php the_author(); ?></a></span></span>
                                <time class="post-date" datetime="2020-02-21T06:48:02+05:30"><?php echo get_the_date(); ?> <span class="meta-sep"></span><span class="post-cat"><?php echo $cate_name; ?></span> </time>
                                
                              <h2 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                            </div>
                            <div class="post-content">
                              <p><?php echo the_excerpt(); ?></p>
                            </div>
                            <div class="post-footer"> <a href="<?php echo get_permalink(); ?>" class="read-more-btn">Read More</a> </div>
                          </div>
                        </div>
                      </div>
                    
                <?php }
                } ?>  
                </div>             
              </div>  

              <div class="news-box">
                <div class="row">
                <div class="col-md-12">
                <div class="news-hedding">
                <h4><?php echo get_field('n_title_4', $postID); ?></h4>
                <span class="hr-line"></span>
                </div>
                </div>
                <?php
                $argsNews = array(
                  'post_type' => 'blog',
                  'post_status' => 'publish',
                  'posts_per_page' => 15,
                  'blog-category' => 'Wordpress',
                );

                $queryNews = new WP_Query($argsNews);

                if ($queryNews->have_posts()) {
                  while ($queryNews->have_posts()) {

                    $queryNews->the_post();
                    $post_idNews = get_the_ID();
                    $term_list = get_the_terms($post_idNews, 'blog-category');
                    $cate_name = $term_list[0]->name;
                    $imageNews = wp_get_attachment_image_src(get_post_thumbnail_id($post_idNews), 'full');
                    $image_urlNews = $imageNews[0];
                ?>
                    
                      <div class="col-lg-12 col-md-12">
                        <div class="news-box-inner clearfix">
                          <div class="post-thumb"> <a href="<?php echo get_permalink(); ?>">
                          <img src="<?php echo $image_urlNews; ?>" alt="<?php echo the_title(); ?>"/></a> </div>
                          <div class="content">
                            <div class="post-meta post-meta-a">
                            <span class="post-by meta-item">By <span><a href="<?php echo get_permalink($post_idCN); ?>"><?php the_author(); ?></a></span></span>
                                <time class="post-date" datetime="2020-02-21T06:48:02+05:30"><?php echo get_the_date(); ?> <span class="meta-sep"></span><span class="post-cat"><?php echo $cate_name; ?></span> </time>
                                
                              <h2 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                            </div>
                            <div class="post-content">
                              <p><?php echo the_excerpt(); ?></p>
                            </div>
                            <div class="post-footer"> <a href="<?php echo get_permalink(); ?>" class="read-more-btn">Read More</a> </div>
                          </div>
                        </div>
                      </div>
                    
                <?php }
                } ?>  
                </div>             
              </div>
              <div class="posts-wrap">              
              <div class="row">
              <div class="col-md-12 news-alert">
              <div class="news-hedding">
                <h4><?php echo get_field('n_title_5', $postID); ?></h4>
                <span class="hr-line"></span>
              </div>
              </div>
                <?php
                $argsTU_2 = array(
                  'post_type' => 'blog',
                  'post_status' => 'publish',
                  'posts_per_page' => 20,
                  'blog-category' => 'Magento',
                );

                $queryTU_2 = new WP_Query($argsTU_2);

                if ($queryTU_2->have_posts()) {
                  while ($queryTU_2->have_posts()) {

                    $queryTU_2->the_post();
                    $post_idTU_2 = get_the_ID();
                    $term_list = get_the_terms($post_idTU_2, 'blog-category');
                    $cate_name = $term_list[0]->name;

                    if ($post_idTU_2 != $post_idTU) {
                      $imageTU_2 = wp_get_attachment_image_src(get_post_thumbnail_id($post_idTU_2), 'full');
                      $image_urlTU_2 = $imageTU_2[0];
                ?>
                      <div class="col-lg-6 col-md-12">
                        <div class="post-box">
                          <div class="post-header">
                            <div class="post-thumb"> <a href="<?php echo get_permalink($post_idTU_2); ?>">
                            <img src="<?php echo $image_urlTU_2; ?>" alt="<?php echo the_title(); ?>" /></a> <span class="cat-label"><a href="#"><?php echo $cate_name; ?></a></span> </div>
                            <div class="meta-title">
                              <div class="post-meta">
                                <h2 class="post-title-alt"><a href="<?php echo get_permalink($post_idTU_2); ?>"><?php echo the_title(); ?></a></h2>
                                <span class="post-author"> <span class="by">by</span> <a href="<?php echo get_permalink($post_idTU_2); ?>"><?php the_author(); ?></a> </span>
                                <span class="meta-sep"></span> <a href="<?php echo get_permalink($post_idTU_2); ?>" class="date-link">
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
                              <li><a target="_blank" href=""><i class="far fa-heart"></i><span class="number">0</span></a></li>
                              <li><a target="_blank" href="<?php echo get_field('facebook', 'options'); ?>"><i class="fab fa-facebook-f"></i></a></li>
                              <li><a target="_blank" href="<?php echo get_field('twitter', 'options'); ?>"><i class="fab fa-twitter"></i></a></li>
                              <li class="printes"><a target="_blank" href="<?php echo get_field('pinterest', 'options'); ?>">Save</a></li>
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
        <div class="col-md-4">
          <div class="right-sidebar">            
            <div class="inner">              
              <ul>
                <li>
                  <div class="latest-posts">
                  <h5 class="widget-title"><?php echo get_field('lp2_title', $postID); ?></h5>
                    
                  <?php
                        $cat_args = array(
                          'orderby'       => 'term_id', 
                          'order'         => 'ASC',
                          'hide_empty'    => true, 
                      );
                      
                      $terms = get_terms('blog-category', $cat_args);
                      //echo "<pre>";print_r($terms);
                  
               
                  
                        foreach( $terms as $category ) {
                          if($category->term_id!="1"){
                            $category_link = sprintf( 
                                '<a href="%1$s" alt="%2$s">%3$s</a>',
                                esc_url( get_category_link( $category->term_id ) ),
                                esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                                esc_html( $category->name )
                            );
                            
                            echo '<span>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . ' ('.$category->count.')</span> ';
                          }
                          } 
                  ?>
                  </div>
                </li>
                <li>
                  <div class="the-wrap">
                    <img src="<?php echo get_field('side_banner_1', $postID); ?>" alt="Newsletter" />
                    <div class="ema">                      
                      <?php echo do_shortcode('[mailpoet_form id="2"]'); ?>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="latest-posts">
                    <h5 class="widget-title"><span><?php echo get_field('lp_title', $postID); ?></span></h5>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <?php
                        $argsLP = array(
                          'post_type' => 'blog',
                          'post_status' => 'publish',
                          'posts_per_page' => 30,
                        );

                        $queryLP = new WP_Query($argsLP);

                        if ($queryLP->have_posts()) {
                          $i = 1;
                          while ($queryLP->have_posts()) {

                            $queryLP->the_post();
                            $post_idLP = get_the_ID();
                            $imageLP = wp_get_attachment_image_src(get_post_thumbnail_id($post_idLP), 'full');
                            $image_urlLP = $imageLP[0];
                        ?>
                            <div class="carousel-item <?php if ($i != 1) {
                                                        echo "";
                                                      } else {
                                                        echo "active";
                                                      } ?>">
                                                      <img class="d-block w-100" src="<?php echo $image_urlLP; ?>" alt="<?php echo the_title(); ?>">
                              <div class="carousel-caption d-none d-md-block">
                                <p><?php echo the_title(); ?></p>
                              </div>
                            </div>
                        <?php $i++;
                          }
                        } ?>                        
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="get-free">
                    <img src="<?php echo get_field('side_banner_2', $postID); ?>" alt="Get Free Consultation"/></div>
                </li>
              </ul>
              <div class="facebook_page_post_show">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fecomsolverin&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=352552049053656" width="450" height="600" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="top-ten">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="top-ten-hedding">
            <h4 class="section-head"><span class="title"><?php echo get_field('tt_title', $postID); ?></span></h4>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
        $argsTT = array(
          'post_type' => 'blog',
          'post_status' => 'publish',
          'posts_per_page' => 1,
          'blog-category' => 'top-ten',
        );

        $queryTT = new WP_Query($argsTT);

        if ($queryTT->have_posts()) {
          while ($queryTT->have_posts()) {

            $queryTT->the_post();
            $post_idTT = get_the_ID();
            $imageTT = wp_get_attachment_image_src(get_post_thumbnail_id($post_idTT), 'full');
            $image_urlTT = $imageTT[0];
        ?>
            <div class="col-md-6">
              <div class="post-thumb"> <a href="<?php echo get_permalink(); ?>">
              <img src="<?php echo $image_urlTT; ?>" alt=""/></a> <span class="cat-label"><a href="#"><?php echo $cate_name; ?></a></span> </div>
              <div class="top-ten-big">
                <h2 class="post-title-alt"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                <span class="post-author"><span class="by">By</span> <a href="<?php echo get_permalink(); ?>" title="Posts by Akansha Pandey" rel="author"><?php the_author(); ?></a></span>
                <span class="meta-sep"><a href="<?php echo get_permalink(); ?>" class="date-link">
                  <time class="post-date" datetime="2020-02-19T12:39:02+05:30"><?php echo get_the_date(); ?></time>
                </a></span>
                <div class="post-content">
                  <p><?php echo the_excerpt(); ?></p>
                </div>
              </div>
            </div>
        <?php }
        } ?>
        <div class="col-md-6">
          <div class="row">
            <?php
            $argsTT_2 = array(
              'post_type' => 'blog',
              'post_status' => 'publish',
              'posts_per_page' => 5,
              'blog-category' => 'top-ten',
            );

            $queryTT_2 = new WP_Query($argsTT_2);

            if ($queryTT_2->have_posts()) {
              while ($queryTT_2->have_posts()) {

                $queryTT_2->the_post();
                $post_idTT_2 = get_the_ID();

                if ($post_idTT_2 != $post_idTT) {
                  $imageTT_2 = wp_get_attachment_image_src(get_post_thumbnail_id($post_idTT_2), 'full');
                  $image_urlTT_2 = $imageTT_2[0];
            ?>
                  <div class="col-lg-6 col-md-12">
                    <div class="top-ten-small"> <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image_urlTT_2; ?>" alt="" title=""></a>
                      <h3 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                    </div>
                  </div>
            <?php }
              }
            } ?>           
        </div>
      </div>
    </div>
  </section>
  <section class="sucess-stories">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="sucess-img"> <img src="<?php echo get_field('ss_image', $postID); ?>" alt="" title=""> </div>
        </div>
        <div class="col-md-6">
          <div class="sucess-text">
            <div class="sucess-text-hedding">
              <h4><?php echo get_field('ss_title', $postID); ?></h4>
            </div>
            <div class="stories-li">
              <ul>
                <?php
                $argsSS = array(
                  'post_type' => 'blog',
                  'post_status' => 'publish',
                  'posts_per_page' => 3,
                  'blog-category' => 'magento',
                );

                $querySS = new WP_Query($argsSS);

                if ($querySS->have_posts()) {
                  while ($querySS->have_posts()) {

                    $querySS->the_post();
                    $post_idSS = get_the_ID();
                    $imageSS = wp_get_attachment_image_src(get_post_thumbnail_id($post_idSS), 'full');
                    $image_urlSS = $imageSS[0];
                ?>
                    <li> <span class="post-cat"><a href="#"><?php echo $cate_name; ?></a></span> <span class="meta-sep"></span> <a href="<?php echo get_permalink(); ?>">
                        <time class="post-date" datetime="2019-11-08T11:27:45+05:30"><?php echo get_the_date(); ?></time>
                      </a>
                      <h2><a href="<?php echo get_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                    </li>
                <?php }
                } ?>      
              </ul>
              <!-- <a class="view-btn" href="<?php echo get_field('ss_button_link', $postID); ?>"><?php echo get_field('ss_button_name', $postID); ?></a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php get_footer(); ?>