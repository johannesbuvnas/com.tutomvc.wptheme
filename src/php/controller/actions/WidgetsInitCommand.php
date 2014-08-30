<?php
namespace tutomvc\theme;
use \tutomvc\ActionCommand;

class WidgetsInitCommand extends ActionCommand
{
	const NAME = "widgets_init";

	function __construct()
	{
		parent::__construct( self::NAME );
	}

	function execute()
	{
		register_sidebar( array(
			'name' => __( 'Search Sidebar', "tutomvc-theme" ),
			'id' => AppConstants::SIDEBAR_SEARCH,
			'before_widget' => '<div class="Widget"><div class="Inner">',
			'after_widget' => '</div></div>',
			'before_title' => '<ul class="nav nav-tabs" role="tablist"><li class="active"><a href="#">',
			'after_title' => '</a></li></ul>',
		) );

		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('Twenty_Eleven_Ephemera_Widget');

		register_widget('\\tutomvc\\theme\\TagCloudWidget');

		// register_widget( "\\tutomvc\\theme\\TagCloudWidget" );

		if(!is_admin())
		{
			// add_filter( "widget_tag_cloud_args", array( $this, "filter_widget_tag_cloud_args" ) );
			// add_filter( "wp_generate_tag_cloud", array( $this, "filter_wp_generate_tag_cloud" ), 0, 3 );
		}
	}

	function filter_widget_tag_cloud_args( $args )
	{
		$args['filter'] = TRUE;
		return $args;
	}

	function filter_wp_generate_tag_cloud( $return, $tags, $args )
	{
		return $this->getFacade()->view->getMediator( TagCloudWidgetMediator::NAME )->getContent( $tags );
		$return = "";
		foreach($tags as $term)
		{
			$return .= $this->getFacade()->view->getMediator( TermCardMediator::NAME )->getContent( $term );
		}
		return $return;
	}
}
