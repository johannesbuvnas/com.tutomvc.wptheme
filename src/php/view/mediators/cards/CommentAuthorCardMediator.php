<?php namespace tutomvc\theme;
use \tutomvc\Mediator;

class CommentAuthorCardMediator extends Mediator
{
	const NAME = "cards/CommentAuthorCard";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
	}

	function render( $comment )
	{
		$this->parse( "comment", $comment );

		return parent::render();
	}
}
