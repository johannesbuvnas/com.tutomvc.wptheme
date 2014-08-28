<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class WPLoginMediator extends Mediator
{
	const NAME = "admin/login/head.php";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		// Actions
		add_action( "login_head", array($this, "render") );
		// Filters
		add_filter( "login_headerurl", array($this, "filterHeaderURL") );
		add_filter( "login_headertitle", array($this, "filterHeaderTitle") );
		add_filter( "login_message", array($this, "filterMessage") );
	}

	// Filters
	function filterHeaderURL($url)
	{
		return get_bloginfo( "url" );
	}
	function filterHeaderTitle($title)
	{
		return \tutomvc\WordPressUtil::getPageTitle();
	}
	function filterMessage($message)
	{
		$customMessage = "<p class='message'>".__( "Who is knocking on my door?", "tutomvc-theme" )."</p>";
		return $customMessage . $message;
	}
}