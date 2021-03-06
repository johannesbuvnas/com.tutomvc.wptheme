<?php
namespace tutomvc\modules\member;
use \tutomvc\ActionCommand;

class WPCommand extends ActionCommand
{
	const NAME = "wp";


	function __construct()
	{
		parent::__construct( self::NAME );
		$this->priority = 0;
	}

	function execute()
	{
		if(!is_admin())
		{
			// Multisite user fix, if no roles.. Sign out the user
			if(is_user_logged_in())
			{
				global $current_user;
				if(!count($current_user->roles)) wp_set_current_user( NULL );
			}

			global $post;

			if(is_home() || ($post && $post->post_type == "post"))
			{
				if(!PrivacyMetaBox::isUserAllowed( NULL, get_option( "page_for_posts" ) )) return $this->redirect();
				return;
			}

			if(!PrivacyMetaBox::isUserAllowed()) $this->redirect();
		}
	}

	function redirect()
	{
		global $wp;
		
		wp_redirect( wp_login_url( get_home_url( NULL, $wp->request, NULL ) ) );

		exit;
	}
}