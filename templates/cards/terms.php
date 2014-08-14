<?php
/**
*	Post terms card.
*/
namespace tutomvc\theme;
global $post;
$terms = wp_get_post_terms( $post->ID );
$translate_nooped_plural = _n_noop( '%s topic', '%s topics' );

foreach($terms as $term)
{
	$term->link = get_term_link( $term->term_id, $term->taxonomy );
	$title_attribute = sprintf( translate_nooped_plural( $translate_nooped_plural, $term->count ), number_format_i18n( $term->count ) );
?>
	<div class="Card TagCard tag-<?php echo esc_attr( $term->slug ); ?>">
		<div class="Inner">
			<a href="<?php echo esc_attr($term->link); ?>" title="<?php echo $title_attribute; ?>">
				<figure class="CardImage Circle">
					<span class="CardImageTitle"><?php echo $term->count; ?></span>
				</figure>
			</a>
			<div class="CardContent">
				<a href="<?php echo esc_attr($term->link); ?>" title="<?php echo $title_attribute; ?>">
					<span class="CardName"><?php echo $term->name; ?></span>
				</a>
			</div>
		</div>
	</div>
<?php
}
?>