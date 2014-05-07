<?php
namespace tutomvc\theme;
use \tutomvc\PostType;

class CustomPostType extends PostType
{
	const NAME = "post";
	const ORDER_BY_SHARES = "shares";

	function __construct()
	{
		$args = (array)get_post_type_object( self::NAME );
		$args['has_archive'] = TRUE;
		$args['rewrite'] = array( 'slug' => 'ccc-news-feed' );
		$args['labels']->singular_name = "Article";
		$args['labels']->name = "Articles";

		// array(
		// 	// 'public'  => true,
		// 	// '_builtin' => false, 
		// 	// 'capability_type' => 'post',
		// 	// 'map_meta_cap' => true,
		// 	// 'hierarchical' => false,
		// 	'has_archive' => TRUE,
		// 	'rewrite' => array( 'slug' => 'blog' ),
		// 	// 'query_var' => false,
		// 	// 'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats' ),
		// )

		parent::__construct( 
			self::NAME, 
			$args
		);
	}

	function pre_get_posts($wpQuery)
	{
		if($wpQuery->get("orderby") == self::ORDER_BY_SHARES)
		{
			$wpQuery->set( "meta_key", ShareMetaBox::constructMetaKey( ShareMetaBox::NAME, ShareMetaBox::TOTAL_COUNT ) );
			$wpQuery->set( "orderby", "meta_value_num" );
			$wpQuery->set( "order", "DESC" );
		}
	}
}