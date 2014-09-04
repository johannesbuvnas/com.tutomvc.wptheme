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

	function getContent( $args = NULL, $instance = NULL )
	{
		if($args) $this->parse( "args", $args );
		if($instance) $this->parse( "instance", $instance );

		return parent::getContent();
	}

	function render( $args, $instance )
	{
		$this->parse( "args", $args );
		$this->parse( "instance", $instance );

		return parent::render();
	}
}
