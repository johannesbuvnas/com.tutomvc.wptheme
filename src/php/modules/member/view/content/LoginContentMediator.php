<?php
namespace tutomvc\modules\member;
use \tutomvc\Mediator;

class LoginContentMediator extends Mediator
{
	const NAME = "modules/member/content/login.php";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		$this->getFacade()->view->registerMediator( new LoginFormMediator() );
	}

}
