<?php namespace tutomvc\theme;
use \WP_Widget_Tag_Cloud;

class TagCloudWidget extends WP_Widget_Tag_Cloud
{
	function widget( $args, $instance )
	{
		if(is_admin()) return parent::widget( $args, $instance );

		global $themeFacade;
		return $themeFacade->view->getMediator( TagCloudWidgetMediator::NAME )->render( $args, $instance );
	}
}