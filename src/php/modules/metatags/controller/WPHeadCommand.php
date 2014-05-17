<?php
namespace tutomvc\modules\metatags;
use \tutomvc\ActionCommand;

class WPHeadCommand extends ActionCommand
{
	function __construct()
	{
		parent::__construct( "wp_head" );
	}

	function execute()
	{
		$this->getFacade()->view->getMediator( SocialMediaTagsMediator::NAME )->render();
	}
}