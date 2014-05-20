<?php
namespace tutomvc\theme;
global $themeFacade;

$themeFacade->view->getMediator( ContentBlockMediator::NAME )
		->parse( "postID", $post->ID )
		->render();
if(AppFacade::$isPreview) return;

$children = get_posts( array(
	'post_parent' => $post->ID,
	// 'post_status' => "publish",
	'post_type' => $post->post_type,
	'nopaging'=> TRUE,
	"orderby" => "menu_order",
	"order" => "ASC"
) );

foreach($children as $post)
{
	if(\tutomvc\modules\member\PrivacyMetaBox::isUserAllowed( NULL, $post->ID ))
	{
		$themeFacade->view->getmediator( PostContentMediator::NAME )
			->setPost( $post )
			->render();
	}
}