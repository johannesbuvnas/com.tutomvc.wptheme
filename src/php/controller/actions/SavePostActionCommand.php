<?php
namespace tutomvc\theme;
use \tutomvc\ActionCommand;

class SavePostActionCommand extends ActionCommand
{
	const NAME = "save_post";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute()
	{
		$post = get_post( $this->getArg(0) );

		if( $post->post_type == "page" )
		{
			FeaturedMediaMetaBox::deleteScreenshotThumbnail( $post->ID );
		}
	}
}