<?php
namespace tutomvc\modules\member;
use \tutomvc\Mediator;

class LoginFormMediator extends Mediator
{
	const NAME = "modules/member/content/forms/login.php";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

}