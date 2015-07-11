<?php namespace tutomvc\theme;
use \tutomvc\Mediator;

class AuthorCardMediator extends Mediator
{
	const NAME = "cards/AuthorCard";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
	}

	function render( $user )
	{
		$this->parse( "user", $user );

		return parent::render();
	}
}
