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
		$meta = $this->retrieve("meta");
		if(!isset($meta) || !is_array($meta) || !count($meta)) return "";

		if(array_key_exists(ContentBlockMetaBox::TYPE, $meta)) $this->parse( "meta", array( $meta ) );

		return parent::getContent();
	}

	function parseMetaFrom( $postID )
	{
		$this->parse( "meta", get_post_meta( $postID, ContentBlockMetaBox::NAME ) );
		$this->parse( "permalink", get_permalink( $postID ) );

		return $this;
	}

}
