<?php
namespace tutomvc\modules\metatags;
use \tutomvc\Mediator;

class SocialMediaTagsMediator extends Mediator
{
	const NAME = "modules/metatags/social-media-meta.php";

	function __construct()
	{
		parent::__construct( self::NAME );
	}
}