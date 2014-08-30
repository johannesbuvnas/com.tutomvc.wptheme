<?php namespace tutomvc\theme;
use \tutomvc\Mediator;

class CommentAuthorCardMediator extends Mediator
{
	const NAME = "components/cards/CommentAuthorCard";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
	}

	function getContent( $comment = NULL )
	{
		if($comment) $this->parse( "comment", $comment );

		return parent::getContent();
	}

	function render( $comment )
	{
		$this->parse( "comment", $comment );

		return parent::render();
	}
}
