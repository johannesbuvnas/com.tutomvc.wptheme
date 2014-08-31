<?php
namespace tutomvc\theme;
/**
*	The wide hero template.
*/
global $post;
$classes = array("HeroBanner");
$classes[] = HeroBannerMetaBox::TEMPLATE_STRAIGHT_FULL;
?>

<section class="<?php echo implode(" ", $classes); ?>">
	<div class="Inner">
		<?php
		$html = wp_get_attachment_image( $post->ID, "full", NULL, array(
			'class'	=> "HeroItem size-full alignnone wp-image-" . $post->ID,
		) );
		echo $html;
		?>
	</div>
</section>