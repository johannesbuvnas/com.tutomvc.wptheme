<?php
namespace tutomvc\modules\member;
use \tutomvc\ActionCommand;

class LoginCommand extends ActionCommand
{
	const NAME = "tutomvc/modules/member/action/login";


	function __construct()
	{
		parent::__construct( "after_setup_theme" );
	}

	function execute()
	{
		global $current_user;

		if(is_user_logged_in()) return;

		if(isset($_POST) && array_key_exists("action", $_POST) && $_POST['action'] == self::NAME)
		{
			$current_user = wp_signon( array(
				"user_login" => $_POST['username'],
				"user_password" => $_POST['password'],
				"remember" => TRUE
			), FALSE );

			add_action( "init", array($this, "redirect") );
		}
	}

	function redirect()
	{
		wp_redirect( $_POST['redirect'] );
		exit;
	}
}