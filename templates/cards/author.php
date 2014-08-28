<?php
/**
*	Author link.
*/
namespace tutomvc\theme;
global $post;
$user = get_user_by( "id", $post->post_author );
?>
<div class="Card AuthorCard">
	<div class="Inner">
		<a href="<?php echo get_author_posts_url( $user->ID ); ?>">
			<figure class="CardImage Circle">
				<?php echo get_avatar( $user->ID, get_option( 'thumbnail_size_w' ) ); ?>
			</figure>
		</a>
		<div class="CardContent">
			<a href="<?php echo get_author_posts_url( $user->ID ); ?>"><span class="Name"><?php echo $user->display_name; ?></span></a>
		</div>
	</div>
</div>