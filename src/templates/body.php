<?php
namespace tutomvc\theme;
global $themeFacade;
global $post;
global $wp_query;

$classes = array();
$classes[] = array_key_exists("preview", $_GET) ? "Preview" : "";
?>
	<div id="stage" class="<?php echo implode(" ", $classes); ?>">
		<div class="Inner">
			<?php
				if($post) $themeFacade->view->getMediator( PostContentMediator::NAME )->render();
			?>
		</div>
	</div>
	<div id="sandbox">
	</div>