<?php
/**
*	Author link.
*/
namespace tutomvc\theme;
$post = get_post();
$user = get_user_by( "id", $post->post_author );
$postTypeObject = get_post_type_object( $post->post_type );
$postTypeLabels = (array)$postTypeObject->labels;
?>
<div class="Card PostCard BorderBox PostType_<?php echo esc_attr($post->post_type); ?>">
	<div class="Inner BorderBox">
		<div class="CardContent clearfix">
			<?php 
			if(has_post_thumbnail()):
			?>
				<a href="<?php echo get_permalink( $post->ID ); ?>">
					<?php
						echo wp_get_attachment_image( get_post_thumbnail_id(), "post-thumbnail", FALSE, array(
							'class'	=> "attachment-thumbnail alignnone",
						) );
					?>
				</a>
			<?php endif; ?>
			
			<a href="<?php echo get_permalink( $post->ID ); ?>">
				<span class="CardName"><?php echo apply_filters( "the_title", $post->post_title ); ?></span>
			</a><br/>

			<a href="<?php echo get_permalink( $post->ID ); ?>"><time class="EntryDate genericon-before genericon-day" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a>,
			<span>
				<a class="PostTypeArchiveLink" href="<?php echo get_post_type_archive_link( $post->post_type ); ?>"><span class="genericon-before"><?php echo $postTypeLabels['name']; ?></span></a> <?php echo __( "by", "tutomvc-theme" ); ?><a class="AuthorLink" href="<?php echo get_author_posts_url( $user->ID ); ?>"><span class="genericon-before genericon-user"><?php echo $user->display_name; ?></span></a>
			</span>
			<?php edit_post_link(); ?>
		</div>
	</div>
</div>