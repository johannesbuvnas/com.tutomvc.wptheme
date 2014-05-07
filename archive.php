<?php
namespace tutomvc;

global $post;
global $wp_query;
global $themeFacade;

$postType = $themeFacade->getSystem()->postTypeCenter->get( $wp_query->get('post_type') );
if($postType) $postType = $postType->getArguments();
$customPage = get_page_by_path( $postType['rewrite']['slug'] );
if($customPage)
{
	$post = $customPage;
	setup_postdata( $post );
}

$themeFacade->view->getMediator( AppMediator::NAME )->render();