<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class BodyMediator extends Mediator
{
	const NAME = "body.php";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		$this->getFacade()->view->registerMediator( new PostContentMediator() );
	}
}
