<?php namespace tutomvc\theme;
/**
*	section#author
*/
global $wp_query;
global $post;
$elementID = "author";
$elementClasses = array( "container-fluid", "tab-pane" );
if($wp_query->byline && $wp_query->byline['current'] == $elementID) $elementClasses[] = "active";
?>
<section id="<?php echo $elementID; ?>" class="<?php echo implode(" ", $elementClasses); ?>">
	<div class="row">
		<div class="col-sm-2 col-xs-3">
			<?php get_template_part( "templates/cards/author" ); ?>
		</div>
	</div>
</section><!-- end #author -->