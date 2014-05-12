<?php
namespace tutomvc\theme;
use \tutomvc\Mediator;

class ContentBlockMediator extends Mediator
{
	const NAME = "components/content/block/block.php";


	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function getContent()
	{
		if(!$this->retrieve("postID")) return "<p></p>";

		return parent::getContent();
	}

}
