<?php
/**
*	Post author byline-section.
*/
namespace tutomvc\theme;
?>
<section class="Author">
	<div class="Inner BorderBox">
		<h6 class="genericon-before genericon-user"><?php echo __( "By" ) ?></h6>
		<div class="Cards">
			<?php get_template_part( "templates/cards/author" ); ?>
		</div>
	</div>
</section>