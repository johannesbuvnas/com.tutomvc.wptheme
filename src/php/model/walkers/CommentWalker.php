<?php
namespace tutomvc\theme;
use \Walker;
use \Walker_Comment;
/**
 * HTML comment list class.
 *
 * @uses Walker
 * @since 2.7.0
 */
class CommentWalker extends Walker_Comment {
	protected function html5_comment( $comment, $depth, $args ) {
		$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
		$user = get_user_by( "id", $comment->user_id );
		$url    = $user ? get_author_posts_url( $user->ID ) : get_comment_author_url( $comment->comment_ID );
		$author = get_comment_author( $comment->comment_ID );
		global $themeFacade;
?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					<footer class="comment-meta">

						<?php $themeFacade->view->getMediator( CommentAuthorCardMediator::NAME )->render( $comment ); ?>

						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( _x( '%1$s at %2$s', '1: date, 2: time' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .comment-metadata -->

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
						<?php endif; ?>
					</footer><!-- .comment-meta -->

					<div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
			</article><!-- .comment-body -->
<?php
	}
}