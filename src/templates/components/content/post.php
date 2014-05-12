<?php
namespace tutomvc\theme;
global $themeFacade;

$themeFacade->view->getMediator( ContentBlockMediator::NAME )
		->parse( "postID", $post->ID )
		->render();
if(array_key_exists("preview", $_GET)) return;

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