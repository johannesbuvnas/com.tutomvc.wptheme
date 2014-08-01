<?php
namespace tutomvc\theme;
use \tutomvc\FilterCommand;

class FoundPostsFilter extends FilterCommand
{
	const NAME = "found_posts";

	function __construct()
	{
		parent::__construct(self::NAME, 10, 2);
	}

	function execute()
	{
		$count = $this->getArg( 0 );
		$wpQuery = $this->getArg( 1 );

		if(is_page() && $wpQuery->is_main_query() && !AppFacade::$isPreview)
		{
			$post = $wpQuery->posts[0];

			$children = get_posts( array(
				'post_parent' => $post->ID,
				'post_type' => $post->post_type,
				'nopaging'=> TRUE,
				"orderby" => "menu_order",
				"order" => "ASC"
			) );

			if(count($children))
			{
				$wpQuery->posts = array_merge( $wpQuery->posts, $children );
				$count += count( $children );
			}
		}

		return $count;
	}
}