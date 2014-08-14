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
			'name' => __( 'Search Sidebar' ),
			'id' => AppConstants::SIDEBAR_SEARCH,
			'before_widget' => '<div class="Widget"><div class="Inner BorderBox">',
			'after_widget' => '</div></div>',
			'before_title' => '<h6>',
			'after_title' => '</h6>',
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
		// unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Nav_Menu_Widget');
		unregister_widget('Twenty_Eleven_Ephemera_Widget');

		// register_widget( "\\tutomvc\\theme\\TagCloudWidget" );

		add_filter( "widget_tag_cloud_args", array( $this, "filter_widget_tag_cloud_args" ) );
		add_filter( "wp_generate_tag_cloud", array( $this, "filter_wp_generate_tag_cloud" ), 0, 3 );
	}

	function filter_widget_tag_cloud_args( $args )
	{
		$args['filter'] = TRUE;
		return $args;
	}

	function filter_wp_generate_tag_cloud( $return, $tags, $args )
	{
		// Juggle topic count tooltips:
			if ( isset( $args['topic_count_text'] ) ) {
				// First look for nooped plural support via topic_count_text.
				$translate_nooped_plural = $args['topic_count_text'];
			} elseif ( ! empty( $args['topic_count_text_callback'] ) ) {
				// Look for the alternative callback style. Ignore the previous default.
				if ( $args['topic_count_text_callback'] === 'default_topic_count_text' ) {
					$translate_nooped_plural = _n_noop( '%s topic', '%s topics' );
				} else {
					$translate_nooped_plural = false;
				}
			} elseif ( isset( $args['single_text'] ) && isset( $args['multiple_text'] ) ) {
				// If no callback exists, look for the old-style single_text and multiple_text arguments.
				$translate_nooped_plural = _n_noop( $args['single_text'], $args['multiple_text'] );
			} else {
				// This is the default for when no callback, plural, or argument is passed in.
				$translate_nooped_plural = _n_noop( '%s topic', '%s topics' );
			}

		$return = "";
		foreach($tags as $term)
		{
			if ( $translate_nooped_plural ) 
			{
				$title_attribute = sprintf( translate_nooped_plural( $translate_nooped_plural, $term->count ), number_format_i18n( $term->count ) );
			}
			else
			{
				$title_attribute = call_user_func( $args['topic_count_text_callback'], $term->count, $term, $args );
			}

			$return .= '
			<div class="Card TagCard tag-'.esc_attr($term->slug).'">
				<div class="Inner">
					<a href="'.esc_attr($term->link).'" title="'.$title_attribute.'">
						<figure class="CardImage Circle">
							<span class="CardImageTitle">'.$term->count.'</span>
						</figure>
					</a>
					<div class="CardContent">
						<a href="'.esc_attr($term->link).'" title="'.$title_attribute.'">
							<span class="CardName">'.$term->name.'</span>
						</a>
					</div>
				</div>
			</div>
			';
		}
		return $return;
	}
}
