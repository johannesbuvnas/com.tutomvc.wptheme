<?php
/**
*	Author link.
*/
namespace tutomvc\theme;
$post = get_post();
$user = get_user_by( "id", $post->post_author );
?>
<div class="Card PostCard">
	<div class="Inner">
		<div class="CardContent clearfix">
			<?php 
			if(has_post_thumbnail()):
			?>
				<a href="<?php echo get_permalink( $post->ID ); ?>">
					<?php
						echo wp_get_attachment_image( get_post_thumbnail_id(), "thumbnail", FALSE, array(
							'class'	=> "attachment-thumbnail alignleft",
						) );
					?>
				</a>
			<?php endif; ?>
			<time class="EntryDate" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time><br/>
			<a href="<?php echo get_permalink( $post->ID ); ?>">
				<span class="CardName"><?php echo apply_filters( "the_title", $post->post_title ); ?></span>
			</a><br/>
			<span><?php echo __("By"); ?> <a class="AuthorLink" href="<?php echo get_author_posts_url( $user->ID ); ?>"><?php echo $user->display_name; ?></a></span>
		</div>
	</div>
</div>