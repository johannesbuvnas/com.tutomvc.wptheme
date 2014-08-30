<?php namespace tutomvc\theme;
/**
*	section#author
*/
global $wp_query;
global $post;
global $themeFacade;
$elementID = "author";
$elementClasses = array( "container-fluid", "tab-pane" );
if($wp_query->byline && $wp_query->byline['current'] == $elementID) $elementClasses[] = "active";
?>
<section id="<?php echo $elementID; ?>" class="<?php echo implode(" ", $elementClasses); ?>">
	<div class="row">
			<?php 
				$user = get_user_by( "id", $post->post_author );
				$themeFacade->view->getMediator( AuthorCardMediator::NAME )->render( $user );
			?>
	</div>
</section><!-- end #author -->