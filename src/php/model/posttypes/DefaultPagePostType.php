<?php
namespace tutomvc\theme;
use \tutomvc\PostType;

class DefaultPagePostType extends PostType
{
	const NAME = "page";

	function __construct()
	{
		$args = (array)get_post_type_object( self::NAME );

		parent::__construct( 
			self::NAME, 
			$args
		);
	}
}