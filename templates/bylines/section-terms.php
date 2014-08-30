<?php namespace tutomvc\theme;
/**
*	section#terms
*/
global $themeFacade;
global $wp_query;
global $post;
$elementID = "terms";
$elementClasses = array( "container-fluid", "tab-pane" );
if($wp_query->byline && $wp_query->byline['current'] == $elementID) $elementClasses[] = "active";

$terms = \tutomvc\WordPressUtil::getAllTerms( $post );
if(!count($terms)) return;
$translate_nooped_plural = _n_noop( '%s topic', '%s topics' );
?>
<section id="<?php echo $elementID; ?>" class="<?php echo implode(" ", $elementClasses); ?>">
		<?php
		$i=0;
		$cols = 3;
		foreach($terms as $term)
		{
			$i++;
			if($i == 1) echo '<div class="row">';
			// if(($i % $cols) == 1 && $i != 1) echo '</div><div class="row">';

			$themeFacade->view->getMediator( TermCardMediator::NAME )
				->render( $term );
		}
		?>
			</div><!-- end .row -->
</section><!-- end #terms -->