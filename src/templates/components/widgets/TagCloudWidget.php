<?php namespace tutomvc\theme;
/**
*	.TagCloudWidget
*/

if(!isset($args)) return;
if(!isset($instance)) return;

global $themeFacade;

if ( !empty($instance['title']) ) {
	$title = $instance['title'];
} else {
	if ( 'post_tag' == $instance['taxonomy'] ) {
		$title = __('Tags');
	} else {
		$tax = get_taxonomy($instance['taxonomy']);
		$title = $tax->labels->name;
	}
}

$terms = get_terms( $instance['taxonomy'], array( 'orderby' => 'count', 'order' => 'DESC' ) );
?>

<div class="TagCloudWidget Widget">
	<div class="Inner">
		<ul class="nav nav-tabs container" role="tablist">
			<li class="active">
				<a href="#<?php echo $args['widget_id']; ?>">
					<ol class="breadcrumb">
						<li><span class="glyphicon glyphicon-tags taxonomy-<?php echo $instance['taxonomy']; ?>"></span></li>
					  	<li class="active"><?php echo $title; ?></li>
					</ol>
				</a>
			</li>
		</ul>
		<div class="tab-content container">
			<div id="<?php echo $args['widget_id']; ?>" class="tab-pane active container-fluid">
				<?php
					$i=0;
					$cols = 6;
					foreach($terms as $term)
					{
						$i++;
						if($i == 1) echo '<div class="row">';
						if(($i % $cols) == 1 && $i != 1) echo '</div><div class="row">';

						$themeFacade->view->getMediator( TermCardMediator::NAME )
							->render( $term );
					}
				?>
				</div><!-- end .row -->
			</div>
		</div>
	</div>
</div><!-- end .TagCloudWidget -->