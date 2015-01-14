<?php namespace tutomvc\theme;
/**
*	.AuthorCard
*/
if(!isset($user)) return;
$authorLink = get_author_posts_url( $user->ID );
?>
<div class="Card AuthorCard col-sm-2 col-xs-4 author-<?php echo $user->ID ?>">
	<div class="Inner">
		<a href="<?php echo $authorLink; ?>">
			<figure class="CardImage img-circle">
				<?php echo get_avatar( $user->ID, get_option( 'thumbnail_size_w' ) ); ?>
			</figure>
		</a>
		<div class="CardContent">
			<p class="Name"><a class="AuthorLink" href="<?php echo $authorLink; ?>"><?php echo $user->display_name; ?></a></p>
		</div>
	</div>
</div>