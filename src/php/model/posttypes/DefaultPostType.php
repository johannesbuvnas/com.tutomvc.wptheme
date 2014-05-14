<?php
namespace tutomvc\theme;
use \tutomvc\PostType;

class DefaultPostType extends PostType
{
	const NAME = "post";

	function __construct()
	{
		$args = (array)get_post_type_object( self::NAME );

		parent::__construct( 
			self::NAME, 
			$args
		);

		remove_post_type_support( self::NAME, "editor" );
	}
}