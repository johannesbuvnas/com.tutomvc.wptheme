<?php
/**
*	.EntryByline
*/
namespace tutomvc\theme;
$cardsOptions = array(
	"itemSelector" => ".TopLevelCard",
	"posts_per_page" => -1
);
?>
<!-- .EntryByline -->
<section class="EntryByline">
	<div class="Inner Cards" data-options="<?php echo esc_attr( json_encode( $cardsOptions ) ); ?>">
		<?php get_template_part( "templates/bylines/section-author" ); ?>
		<?php get_template_part( "templates/bylines/section-terms" ); ?>
	</div>
</section>
<!-- end .EntryByline -->