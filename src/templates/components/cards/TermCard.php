<?php namespace tutomvc\theme;
/**
*	.TermCard
*/

if(!isset($term)) return;
$translate_nooped_plural = _n_noop( '%s topic', '%s topics' );
$title_attribute = sprintf( translate_nooped_plural( $translate_nooped_plural, $term->count ), number_format_i18n( $term->count ) );
$termURL = get_term_link( $term, $term->taxonomy );

$associatedPage = TaxonomyUtil::getAssociatedPageByTerm( $term );
if($associatedPage)
{
	$thumbnailID = get_post_thumbnail_id( $associatedPage->ID );
	if($thumbnailID)
	{
		$thumbnailURL = wp_get_attachment_thumb_url($thumbnailID);
	}
}
?>

<div class="col-sm-2 col-xs-4 Card TermCard term-<?php echo esc_attr( $term->slug ); ?> taxonomy-<?php echo esc_attr( $term->taxonomy ); ?>">
	<div class="Inner">
		<a href="<?php echo esc_attr($termURL); ?>" title="<?php echo $title_attribute; ?>">
		<?php if(isset($thumbnailURL)): ?>
				<figure class="CardImage img-rounded" style="background-image: url(<?php echo $thumbnailURL; ?>);">
		<?php else: ?>
			<figure class="CardImage img-rounded">
		<?php endif; ?>
				<div class="Title">
					<span class="label label-shadow"><?php echo $term->count; ?>
				</div>
			</figure>
		</a>
		<div class="CardContent">
			<p class="Name"><a href="<?php echo esc_attr($termURL); ?>" title="<?php echo $title_attribute; ?>"><?php echo $term->name; ?></a></p>
		</div>
	</div>
</div>