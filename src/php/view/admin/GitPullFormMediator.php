<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class GitPullFormMediator extends Mediator
{
	const NAME = "admin/form.git.pull.php";
	const ACTION_PULL = "tutomvc/theme/action/git_pull";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		if(is_array($_POST) && array_key_exists(self::ACTION_PULL, $_POST))
		{
			$this->getFacade()->repository->pull();
		}
	}
}