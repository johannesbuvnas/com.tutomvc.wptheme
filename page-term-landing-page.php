<?php namespace tutomvc\theme;
use \tutomvc\modules\termpage\PreGetPostsAction;
/**
 *	Template Name: Term Landing Page
 */
global $post;
global $wp_query;
global $themeFacade;

get_header();

while(have_posts())
{
	the_post();
	get_template_part( 'content', $post->post_type );
}

if(get_query_var( PreGetPostsAction::QUERY_VAR ))
{
	// The custom action command has been executed, retrieve the original query vars and query them before getting the loop template
	query_posts( get_query_var( PreGetPostsAction::QUERY_VAR ) );

	get_template_part( "loop" );
}

get_footer();