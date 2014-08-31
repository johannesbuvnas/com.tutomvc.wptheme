<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class AppMediator extends Mediator
{
	const NAME = "index.php";

	protected $_headMediator;
	protected $_bodyMediator;

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		// $this->_headMediator = $this->getFacade()->view->registerMediator( new HeadMediator() );
		// $this->_bodyMediator = $this->getFacade()->view->registerMediator( new BodyMediator() );
		// $this->getFacade()->view->registerMediator( new WPLoginMediator() );
	}

	function getContent()
	{
		$this->parse( "headContent", $this->_headMediator->getContent() );
		$this->parse( "bodyContent", $this->_bodyMediator->getContent() );

		// if(!AppFacade::isProduction())
		// {
		// 	wp_enqueue_style( AppConstants::STYLE_CSS, $this->getFacade()->getURL( "src/css/style.css" ), NULL, AppFacade::VERSION );
		// 	wp_enqueue_script( AppConstants::SCRIPT_JS_REQUIRE, $this->getFacade()->getURL( "src/scripts/libs/requirejs/require.js" ), NULL, AppFacade::VERSION, TRUE );
		// 	// wp_enqueue_script( "tutomvc/js", $this->getFacade()->getURL( "src/scripts/Main.config.js" ), array("tutomvc/js/require"), time(), TRUE );
		// 	wp_enqueue_script( AppConstants::SCRIPT_JS, $this->getFacade()->getURL( "src/scripts/Main.config.js" ), array( AppConstants::SCRIPT_JS_REQUIRE ), AppFacade::VERSION, TRUE );
		// }
		// else
		// {
		// 	wp_enqueue_style( AppConstants::STYLE_CSS, $this->getFacade()->getURL( "style.min.css" ), NULL, AppFacade::VERSION );
		// 	// DO NOT ENQUEUE, ADD MANUALLY WITH ASYNC INSTEAD
		// 	// wp_enqueue_script( "tutomvc/js", $this->getFacade()->getURL( "src/scripts/Main.pkgd.js" ), NULL, AppFacade::VERSION, TRUE );
		// }

		wp_enqueue_style( AppConstants::STYLE_CSS, $this->getFacade()->getURL( "style.min.css" ), NULL, AppFacade::VERSION );
		wp_enqueue_script( AppConstants::SCRIPT_JS, $this->getFacade()->getURL( "script.min.js" ), NULL, AppFacade::VERSION, TRUE );

		return parent::getContent();
	}
}