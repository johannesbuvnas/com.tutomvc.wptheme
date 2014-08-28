<?php
namespace tutomvc\theme;
/**
*	The main hero template.
*/
global $post;
$heroMeta = get_post_meta( $post->ID, HeroBannerMetaBox::NAME );

if(count($heroMeta))
{
	$heroMeta = array_pop($heroMeta);
	if(count($heroMeta[ HeroBannerMetaBox::IMAGES ]))
	{
		?>
			<!-- .FallbackHeroBanner -->
			<a href="<?php echo get_permalink( $post->ID ); ?>">
				<?php
					$attachmentID = get_post_thumbnail_id( $post->ID );
					$size = "post-thumbnail";
					$classes = array(
						"alignnone",
						"wp-image-" . $attachmentID,
						"FallbackHeroBanner"
					);
					$src = wp_get_attachment_image_src( $attachmentID, $size );
				?>
				<figure style="background-image: url(<?php echo $src[0]; ?>) ;" class="<?php echo implode(" ", $classes); ?>"></figure>
			</a><!-- end .FallbackHeroBanner -->
		<?php
		get_template_part( 'templates/banners/hero', $heroMeta[ HeroBannerMetaBox::TEMPLATE ] );
	}
}