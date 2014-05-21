<?php
namespace tutomvc\modules\analytics;
use tutomvc\Facade;

class AnalyticsModule extends Facade
{
	const KEY = "tutomvc/modules/analytics/facade";

	function __construct()
	{
		parent::__construct( self::KEY );
	}

	function onRegister()
	{
		$this->controller->registerCommand( new InitCommand() );
	}

	function render()
	{
		$this->view->getMediator( AnalyticsMediator::NAME )->render();
		$this->view->getMediator( GTMMediator::NAME )->render();
	}
}