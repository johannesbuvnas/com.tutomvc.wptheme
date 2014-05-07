<?php
namespace tutomvc\theme;
use \tutomvc\PostType;

class EventPostType extends PostType
{
	const NAME = "event";

	function __construct()
	{
		$labels = array(
		   'name'               => 'Events',
		   'singular_name'      => 'Event',
		   'add_new'            => 'Add New',
		   'add_new_item'       => 'Add New',
		   'edit_item'          => 'Edit',
		   'new_item'           => 'New',
		   'all_items'          => 'All',
		   'view_item'          => 'View',
		   'search_items'       => 'Search',
		   'not_found'          => 'No found',
		   'not_found_in_trash' => 'No found in Trash',
		   'parent_item_colon'  => '',
		   'menu_name'          => 'Events'
		 );

		parent::__construct( self::NAME, array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => "events" ),
			'capability_type'    => 'post',
			'has_archive'        => TRUE,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array( 'title' ),
			// "taxonomies" 		=> array("category")
		) );
	}

	function pre_get_posts($wpQuery)
	{
		// if(is_admin()) return FALSE;

		$wpQuery->set( "meta_key", EventMetaBox::constructMetaKey( EventMetaBox::NAME, EventMetaBox::TIME ) );
		$wpQuery->set( "orderby", "meta_value_num" );
	}
}