<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comment">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<ol class="comment-list">
			<h4 class="section-head"><span class="title">Comments</span></h4>
			<?php
				wp_list_comments( array(
					// 'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
					// 'reply_text'  => twentyseventeen_get_svg( array( 'icon' => 'mail-reply' ) ) . __( 'Reply', 'twentyseventeen' ),
					'callback' => 'better_comments',
          'reverse_children'  => 'div',
				) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous', 'twentyseventeen' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . __( 'Next', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
	<?php
	endif;

	?><h4 class="section-head"><span class="title">Write A Comment</span></h4>
	<?php
	$commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $fields =  array(
      'author' => '<div id="comment-name" class="form-group">' . '<label for="name">Name</label>' .
          '<input id="author" name="author" type="text" class="form-control" placeholder="Name *" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
      'email' => '<div id="comment-email" class="form-group">' . '<label for="email">Email</label>' .
          '<input id="email" name="email" type="text" class="form-control" placeholder="Email * (will not be published)" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
      'url' => '<div id="comment-url" class="form-group">' . '<label for="website">Website</label>' .
           '<input id="url" name="url" class="form-control" placeholder="Website" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',
      'comment_field' => '<div id="comment-message" class="form-group"><label for="comment">Comment</label><textarea id="comment" name="comment" cols="45" rows="8" class="form-control" maxlength="65525" required="required"></textarea></div>',    
  );
   
  $comments_args = array(
      'fields' =>  $fields,
      'title_reply'=>'',
      'class_submit' => 'btn',
      'label_submit' => 'Post Comment'
  );

	comment_form($comments_args);
	?>

</div><!-- #comments -->
