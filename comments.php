<?php namespace tutomvc\theme;
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
global $wp_query;
global $post;
$elementID = "discussion";
$elementClasses = array( "container-fluid", "tab-pane" );
if($wp_query->byline && $wp_query->byline['current'] == $elementID) $elementClasses[] = "active";

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) return;
if ( !comments_open() && !get_comments_number() ) return;
?>
<section id="<?php echo $elementID; ?>" class="<?php echo implode(" ", $elementClasses); ?>">

	<div class="Inner">
		<?php if ( have_comments() ) : ?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', "tutomvc-theme" ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', "tutomvc-theme" ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', "tutomvc-theme" ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 150,
					"walker" => new CommentWalker()
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', "tutomvc-theme" ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', "tutomvc-theme" ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', "tutomvc-theme" ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

		<?php if ( ! comments_open() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', "tutomvc-theme" ); ?></p>
		<?php endif; ?>

		<?php endif; // have_comments() ?>

		<?php 
			$commentField = '
				<p class="comment-form-comment">
					<textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" class="form-control"></textarea>
				</p>
			';
			
			comment_form(array(
				"logged_in_as" => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				"comment_field" => $commentField
			));
		?>
	</div>
</section><!-- end #discussion -->
