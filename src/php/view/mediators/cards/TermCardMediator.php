<?php namespace tutomvc\theme;
use \tutomvc\Mediator;

class TermCardMediator extends Mediator
{
	const NAME = "cards/TermCard";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
	}

	function render( $term )
	{
		$this->parse( "term", $term );

		return parent::render();
	}
}
