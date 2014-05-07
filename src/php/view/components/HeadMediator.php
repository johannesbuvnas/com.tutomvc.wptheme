<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class HeadMediator extends Mediator
{
	const NAME = "head.php";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		
	}
}