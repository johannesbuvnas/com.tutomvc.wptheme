<?php
namespace tutomvc\theme;
use \tutomvc\AjaxCommand;

class SearchQueryAjaxCommand extends AjaxCommand
{
	const NAME = "tutomvc/ajax/SearchQuery";

	function __construct()
	{
		parent::__construct( self::NAME );
		$this->setNonceName( AppConstants::NONCE_NAME );
	}

	function execute()
	{
		$wpQuery = new \WP_Query(array(
			"s" => $_REQUEST['s'],
			"nopaging" => TRUE
		));

		$results = array();
		foreach($wpQuery->posts as $post)
		{
			$type = get_post_type_object( $post->post_type );

			$results[] = array(
				"href" => get_permalink( $post->ID ),
				"title" => get_the_title( $post->ID ),
				"type" => $type->labels->singular_name
			);
		}

		echo json_encode($results);
		exit;
	}
}