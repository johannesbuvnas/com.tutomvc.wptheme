<?php
namespace tutomvc\theme;
/**
*	The wide hero template.
*/
global $post;
$heroMeta = get_post_meta( $post->ID, HeroBannerMetaBox::NAME );
$heroMeta = array_pop($heroMeta);

$classes = array("HeroBanner");
$classes[] = $heroMeta[ HeroBannerMetaBox::TEMPLATE ];
?>

<section class="<?php echo implode(" ", $classes); ?>">
	<div class="Inner">
		<?php
		$heroMeta[ HeroBannerMetaBox::IMAGES ] = array_reverse($heroMeta[ HeroBannerMetaBox::IMAGES ]);
		$i = 0;
		foreach( $heroMeta[ HeroBannerMetaBox::IMAGES ] as $image )
		{
			$src = wp_get_attachment_image_src( $image['id'], AppConstants::IMAGE_SIZE_HERO_WIDE );
			if(count($src))
			{
				$videoLinkageMeta = (array)get_post_meta( $image['id'], ImageVideoLinkageMetaBox::NAME );
				$videoURL = NULL;
				if(count($videoLinkageMeta))
				{
					$videoLinkageMeta = array_pop($videoLinkageMeta);
					$videoURL = $videoLinkageMeta[ $videoLinkageMeta[ ImageVideoLinkageMetaBox::TYPE ] ];
					if(is_array($videoURL))
					{
						// Attachment is the type
						$videoURL = array_pop($videoURL);
						$videoURL = $videoURL['url'];
					}
				}
				$i++;
				?>
					<figure class="HeroItem" style="background-image: url(<?php echo $src[0]; ?>) ;">
						<?php if(is_string($videoURL) && strlen($videoURL)): ?>
							<a href="<?php echo $videoURL; ?>" target="_blank" class="VideoLinkage MediaLink genericon genericon-play ShadowBox">
								<span class="Label">Play video</span>
							</a>
						<?php endif; ?>
					</figure>
				<?php
			}
		}
		?>
	</div>
	<?php
		if($i > 1)
		{
		?>
			<div class="Control">
				<a href="#" class="Previous genericon genericon-previous ShadowBox">
					<span class="Label">Previous</span>
				</a>
				<a href="#" class="Next genericon genericon-next ShadowBox">
					<span class="Label">Next</span>
				</a>
			</div>
		<?php
		}
	?>
</section>