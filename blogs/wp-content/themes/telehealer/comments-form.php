<?php
if( ! function_exists( 'better_comments' ) ):
function better_comments($comment, $args, $depth) {
    ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-box">
      <div class="">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-2">
                <div class="img img-rounded">
                    <?php echo get_avatar($comment,$size='80',$default='https://0.gravatar.com/avatar/36c2a25e62935705c5565ec465c59a70?s=32&d=mm&r=g' ); ?>
                    <p><?php printf(/* translators: 1: date and time(s). */ esc_html__('%1$s at %2$s' , '5balloons_theme'), get_comment_date(),  get_comment_time()) ?></p>
                </div>
              </div>

              <div class="col-md-10">
                  <p id="athr-name">
                      <a class="float-left" href="#"><strong><?php echo get_comment_author() ?></strong></a>
                      
                  </p>
                  <div class="clearfix"></div>
                    <?php comment_text() ?>
                  <p id="c-reply">
                      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                      <!-- <a href="#" class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a> -->
                  </p>
              </div> 
            </div>
          </div>
        </div>    
      </div>
    </div>

<?php
        }
endif;
