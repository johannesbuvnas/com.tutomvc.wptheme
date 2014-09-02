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
	}

	function getContent()
	{
		$this->parse( "headContent", $this->_headMediator->getContent() );
		$this->parse( "bodyContent", $this->_bodyMediator->getContent() );

		// wp_enqueue_style( AppFacade::STYLE_CSS, $this->getFacade()->getURL( "style.min.css" ), NULL, AppFacade::VERSION );
		// wp_enqueue_script( AppFacade::SCRIPT_JS, $this->getFacade()->getURL( "script.min.js" ), NULL, AppFacade::VERSION, TRUE );

		return parent::getContent();
	}
}