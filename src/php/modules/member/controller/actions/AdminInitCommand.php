<?php
namespace tutomvc\modules\member;
use \tutomvc\ActionCommand;

class AdminInitCommand extends ActionCommand
{
	function __construct()
	{
		parent::__construct("admin_init");
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
		global $current_user;

		$file = basename($_SERVER['PHP_SELF']);
		if(is_user_logged_in() && !current_user_can('manage_options') && $file != 'admin-ajax.php')
		{
			wp_redirect( home_url() );
			exit();
		}
	}

	private function prepController()
	{
	}
}