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
		foreach( $heroMeta[ HeroBannerMetaBox::IMAGES ] as $image )
		{
			$html = wp_get_attachment_image( $image['id'], "full", NULL, array(
				'class'	=> "HeroItem size-full alignnone wp-image-" . $image['id'],
			) );
			echo $html;
		}
		?>
	</div>
</section>