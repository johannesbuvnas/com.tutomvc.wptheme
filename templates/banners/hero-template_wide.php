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
				$i++;
				?>
					<figure class="HeroItem" style="background-image: url(<?php echo $src[0]; ?>) ;"></figure>
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
				<a href="#" class="Previous ShadowBox img-rounded">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a href="#" class="Next ShadowBox img-rounded">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
		<?php
		}
	?>
</section>