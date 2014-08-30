<?php namespace tutomvc\theme;
/**
*	.AuthorCard
*/
if(!isset($comment)) return;
$user = get_user_by( "id", $comment->user_id );
$authorLink = $user ? get_author_posts_url( $user->ID ) : get_comment_author_url( $comment->comment_ID );
$author = get_comment_author( $comment->comment_ID );
?>
<div class="Card AuthorCard">
	<div class="Inner">
		<a href="<?php echo $authorLink; ?>">
			<figure class="CardImage">
				<?php echo get_avatar( $comment, get_option( 'thumbnail_size_w' ) ); ?>
			</figure>
		</a>
		<div class="CardContent">
			<a class="AuthorLink" href="<?php echo $authorLink; ?>"><span class="Name"><?php echo $author; ?></span></a>
		</div>
	</div>
</div>