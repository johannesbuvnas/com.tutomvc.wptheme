<?php
namespace tutomvc\modules\metatags;
use \tutomvc\Facade;

class MetaTagsModule extends Facade
{
	const NAME = "hearplugs/social";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		$this->prepModel();
		$this->prepView();
		$this->prepController();
	}

	private function prepModel()
	{
		$this->getSystem()->metaCenter->add( new MetaTagsMetaBox() );
	}
	private function prepView()
	{
		$this->view->registerMediator( new SocialMediaTagsMediator() );
	}
	private function prepController()
	{
		$this->controller->registerCommand( new WPHeadCommand() );
	}
}