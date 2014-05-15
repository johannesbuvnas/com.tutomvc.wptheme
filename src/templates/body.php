<?php
namespace tutomvc\theme;
global $themeFacade;
global $post;
global $wp_query;

$classes = array();
$classes[] = array_key_exists("preview", $_GET) ? "Preview" : "";
?>
	<div id="navigation">
		<div id="indicator" class="NotInteractive">
			<p>1 / <?php echo count($wp_query->posts); ?></p>
		</div>
		<div id="buttons">
			<?php if( $wp_query->get("paged") > 1 ): ?>
			<a id="previousButton" href="<?php echo get_previous_posts_page_link(); ?>" title="Previous page">Previous page</a>
			<?php endif; ?>
			<a id="mainButton" href="#">Navigate</a>
			<?php if( $wp_query->max_num_pages > 1 && $wp_query->get("paged") < $wp_query->max_num_pages ): ?>
			<a id="nextButton" href="<?php echo get_next_posts_page_link(); ?>" title="Next page">Next page</a>
			<?php endif; ?>
		</div>
	</div>
	<div id="stage" class="<?php echo implode(" ", $classes); ?>">
		<div class="Inner">
			<?php
				if ( have_posts() )
				{
					while ( have_posts() )
					{
						the_post();
						$themeFacade->view->getMediator( PostContentMediator::NAME )->render();
					}
				}
			?>
		</div>
	</div>
	<div id="sandbox">
	</div>