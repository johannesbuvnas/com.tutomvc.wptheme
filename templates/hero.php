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
		if(file_exists( STYLESHEETPATH . '/' . "templates/hero-" . $heroMeta[ HeroBannerMetaBox::TEMPLATE ] . ".php" )) get_template_part( 'templates/hero', $heroMeta[ HeroBannerMetaBox::TEMPLATE ] );
	}
}