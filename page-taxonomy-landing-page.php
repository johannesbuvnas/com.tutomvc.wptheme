<?php
namespace tutomvc\theme;
/**
 *	If you have a page with identic slug as taxonomy, use this template to show term thumbnails.
 *	Template Name: Taxonomy Landing Page
 */
global $post;
global $themeFacade;

get_header();

while(have_posts())
{
	the_post();
	get_template_part( 'content', $post->post_type );
}

$taxonomy = TaxonomyUtil::getTaxonomyByRewriteSlug( $post->post_name );
if($taxonomy)
{
	?>
	<section id="loop" class="TheLoop">
		<div class="Inner">
			<?php
			$themeFacade->view->getMediator( TagCloudWidgetMediator::NAME )
				->render( array(
						"widget_id" => "looped-widget-" . $post->ID
					),
					array(
						"taxonomy" => $taxonomy->name
					) );
			?>
		</div>
	</div>
	<?php
}

get_footer();