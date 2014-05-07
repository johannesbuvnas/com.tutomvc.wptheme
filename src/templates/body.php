<?php
namespace tutomvc\theme;
global $themeFacade;
global $post;
global $wp_query;
?>
	<div id="stage">
		<div class="Inner">
			<?php
				if($post) $themeFacade->view->getMediator( PostContentMediator::NAME )->render();
			?>
		</div>
	</div>
