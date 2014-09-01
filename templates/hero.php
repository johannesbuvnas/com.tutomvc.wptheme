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
		$attachmentID = HeroBannerMetaBox::getFeaturedImageID( $post->ID );
		?>
			<!-- .FallbackHeroBanner -->
			<a href="<?php echo get_permalink( $post->ID ); ?>">
				<?php
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
else if ( is_attachment() && wp_attachment_is_image() )
{
	// get_template_part( 'templates/banners/hero-attachment-image', HeroBannerMetaBox::TEMPLATE_STRAIGHT_FULL );
}