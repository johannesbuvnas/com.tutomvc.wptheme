<?php
namespace tutomvc\theme;
global $themeFacade;

$themeFacade->view->getMediator( ContentBlockMediator::NAME )
		->parse( "postID", $post->ID )
		->render();