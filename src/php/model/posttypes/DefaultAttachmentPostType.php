<?php
namespace tutomvc\theme;
use \tutomvc\PostType;

class DefaultAttachmentPostType extends PostType
{
	const NAME = "attachment";

	function __construct()
	{
		$args = (array)get_post_type_object( self::NAME );

		parent::__construct( 
			self::NAME, 
			$args
		);
	}
}