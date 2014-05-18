<?php
namespace tutomvc\modules\member;
use \tutomvc\ActionCommand;

class WPCommand extends ActionCommand
{
	const NAME = "wp";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute()
	{
		if(!is_admin())
		{
			// Multisite user fix, if no roles.. Sign out the user
			if(is_user_logged_in())
			{
				global $user;
				if(!count($user->roles)) wp_set_current_user( NULL );
			}

			global $post;

			if(!$post) return;

			if(is_home() || $post->post_type == "post")
			{
				if(!PrivacyMetaBox::isUserAllowed( NULL, get_option( "page_for_posts" ) )) return $this->redirect();
				return;
			}

			if(!$post) return;
			if(!PrivacyMetaBox::isUserAllowed()) $this->redirect();
		}
	}

	function redirect()
	{
		global $post;
		
		if(is_home())
		{
			wp_redirect( wp_login_url( get_permalink( get_option( "page_for_posts" ) ) ) );
		}
		else if($post)
		{
			wp_redirect( wp_login_url( get_permalink( $post->ID ) ) );
		}
		else
		{
			wp_redirect( wp_login_url() );
		}

		exit;
	}
}