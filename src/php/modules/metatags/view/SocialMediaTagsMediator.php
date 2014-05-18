<?php
namespace tutomvc\modules\metatags;
use \tutomvc\Mediator;

class SocialMediaTagsMediator extends Mediator
{
	const NAME = "modules/metatags/social-media-meta.php";
	const FILTER_POST = "tutomvc/modules/metatags/filter/meta_post";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function onRegister()
	{
		add_filter( self::FILTER_POST, array($this, "filterPost") );
	}

	function filterPost($post)
	{
		if(is_home())
		{
			return get_post( get_option( "page_for_posts" ) );
		}
		else
		{
			global $post;
			return $post;
		}
	}
}