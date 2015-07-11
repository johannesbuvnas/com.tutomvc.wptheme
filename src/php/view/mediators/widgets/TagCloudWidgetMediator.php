<?php namespace tutomvc\theme;
use \tutomvc\Mediator;

class TagCloudWidgetMediator extends Mediator
{
	const NAME = "widgets/TagCloudWidget";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
	}

	function render( $args, $instance )
	{
		$this->parse( "args", $args );
		$this->parse( "instance", $instance );

		return parent::render();
	}
}
