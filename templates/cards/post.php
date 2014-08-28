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
<article id="post-<?php echo $post->ID; ?>" <?php post_class( "BorderBox HentryInitialized Thumbnail" ); ?>>
	<section class="Inner">
		<header class="EntryHeader">
			<?php 
			if(has_post_thumbnail()):
			?>
				<!-- .HeroBanner -->
				<a href="<?php echo get_permalink( $post->ID ); ?>">
					<?php
						$attachmentID = get_post_thumbnail_id( $post->ID );
						$size = "post-thumbnail";
						$classes = array(
							"alignnone",
							"wp-image-" . $attachmentID,
							"HeroBanner"
						);
						$src = wp_get_attachment_image_src( $attachmentID, $size );
					?>
					<figure style="background-image: url(<?php echo $src[0]; ?>) ;" class="<?php echo implode(" ", $classes); ?>"></figure>
				</a>
				<!-- end .HeroBanner -->
			<?php else: ?>
				<!-- <a href="<?php echo get_permalink( $post->ID ); ?>">
					<figure class="HeroBanner" style="background-color:#ccc;"></figure>
				</a>
 -->			<?php endif; ?>
			<!-- .EntryTitles -->
			<section class="EntryTitles">
				<div class="Inner BorderBox">
					<h2 class="EntryTitle">
						<a href="<?php echo get_permalink( $post->ID ); ?>">
							<span class="Hyphenate"><?php echo apply_filters( "the_title", $post->post_title ); ?></span>
						</a>
					</h2>
					<?php
						$subTitle = get_post_meta( $post->ID, TitlesMetaBox::constructMetaKey( TitlesMetaBox::NAME, TitlesMetaBox::SUBTITLE ), TRUE );
						if(strlen($subTitle))
						{
						?>
							<h4 class="EntrySubtitle">
								<a href="<?php echo get_permalink( $post->ID ); ?>">
									<span><?php echo $subTitle; ?></span>
								</a>
							</h4>
						<?php
						}
					?>
					<p class="EntryByline">
						<a href="<?php echo get_permalink( $post->ID ); ?>"><time class="EntryDate genericon-before genericon-day" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a>,
						<a class="PostTypeArchiveLink OtherLink" href="<?php echo get_post_type_archive_link( $post->post_type ); ?>"><span class="genericon-before"><?php echo $postTypeLabels['name']; ?></span></a> <?php echo __( "by", "tutomvc-theme" ); ?><a class="AuthorLink OtherLink" href="<?php echo get_author_posts_url( $user->ID ); ?>"><span class="genericon-before genericon-user"><?php echo $user->display_name; ?></span></a>
						<?php edit_post_link(); ?>
					</p>
				</div>
			</section>
			<!-- .EntryTitles -->
		</header>
	</section>
</article>