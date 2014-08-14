<?php
/**
*	Post tags byline-section.
*/
namespace tutomvc\theme;
global $post;
$terms = wp_get_post_terms( $post->ID );
if(!count($terms)) return;
?>
<section class="Terms">
	<div class="Inner BorderBox">
		<h6 class="genericon-before genericon-tag"><?php echo __( "Published in" ) ?></h6>
		<div class="Cards">
			<?php get_template_part( "templates/cards/terms" ); ?>
		</div>
	</div>
</section>