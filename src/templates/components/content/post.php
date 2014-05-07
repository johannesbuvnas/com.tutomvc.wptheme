<?php
namespace tutomvc\theme;
global $themeFacade;

$themeFacade->view->getMediator( ContentBlockMediator::NAME )
		->parse( "meta", get_post_meta( $post->ID, ContentBlockMetaBox::NAME ) )
		->render();

$children = get_posts( array(
	'post_parent' => $post->ID,
	'post_status' => "publish",
	'post_type' => $post->post_type,
	'nopaging'=> TRUE,
	"orderby" => "menu_order",
	"order" => "ASC"
) );

foreach($children as $post)
{
	$themeFacade->view->getmediator( PostContentMediator::NAME )
		->setPost( $post )
		->render();
}
