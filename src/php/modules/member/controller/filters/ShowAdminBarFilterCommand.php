<?php
namespace tutomvc\modules\member;
use \tutomvc\FilterCommand;

class ShowAdminBarFilterCommand extends FilterCommand
{
	function __construct()
	{
		parent::__construct("show_admin_bar");
	}

	function execute()
	{
		global $current_user;

		if(is_user_logged_in() && !current_user_can('manage_options'))
		{
			return FALSE;
		}
		else
		{
			return $this->getArg(0);
		}
	}
}