<?php
namespace tutomvc\modules\member;
use \tutomvc\ActionCommand;

class InitCommand extends ActionCommand
{
	function __construct()
	{
		parent::__construct("init");
	}

	function execute()
	{
		$this->prepModel();
		$this->prepView();
		$this->prepController();
	}

	private function prepModel()
	{
	}

	private function prepView()
	{
		$this->getFacade()->view->registerMediator( new LoginContentMediator() );
	}

	private function prepController()
	{
		$this->getFacade()->controller->registerCommand( new AdminInitCommand() );
		$this->getFacade()->controller->registerCommand( new ShowAdminBarFilterCommand() );
	}
}