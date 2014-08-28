<?php
namespace tutomvc\theme;
use \tutomvc\ActionCommand;

class WPEnqueueScriptsCommand extends ActionCommand
{
	const NAME = "wp_enqueue_scripts";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute()
	{
		if(!AppFacade::isProduction())
		{
			wp_enqueue_style( AppConstants::STYLE_CSS, $this->getFacade()->getURL( "src/bootstrap/dist/css/bootstrap.css" ), NULL, AppFacade::VERSION );
			wp_enqueue_script( AppConstants::SCRIPT_JS_REQUIRE, $this->getFacade()->getURL( "src/scripts/libs/requirejs/require.js" ), NULL, AppFacade::VERSION, TRUE );
			wp_enqueue_script( AppConstants::SCRIPT_JS, $this->getFacade()->getURL( "src/scripts/Main.config.js" ), array( AppConstants::SCRIPT_JS_REQUIRE ), AppFacade::VERSION, TRUE );
		}
		else
		{
			wp_enqueue_style( AppConstants::STYLE_CSS, $this->getFacade()->getURL( "src/bootstrap/dist/css/bootstrap.min.css" ), NULL, AppFacade::VERSION );
			// TODO: DO NOT ENQUEUE, ADD MANUALLY WITH ASYNC INSTEAD
			wp_enqueue_script( "tutomvc/js", $this->getFacade()->getURL( "src/scripts/Main.pkgd.js" ), NULL, AppFacade::VERSION, TRUE );
		}
	}
}
