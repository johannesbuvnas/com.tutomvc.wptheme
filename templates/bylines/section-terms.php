<?php namespace tutomvc\theme;
/**
*	section#terms
*/
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
		$cols = 6;
		foreach($terms as $term)
		{
			$i++;
			if($i == 1) echo '<div class="row">';
			if(($i % $cols) == 1 && $i != 1) echo '</div><div class="row">';
			$term->link = get_term_link( $term->term_id, $term->taxonomy );
			$title_attribute = sprintf( translate_nooped_plural( $translate_nooped_plural, $term->count ), number_format_i18n( $term->count ) );
		?>
			<div class="Card TagCard tag-<?php echo esc_attr( $term->slug ); ?> col-sm-2 col-xs-4">
				<div class="Inner">
					<a href="<?php echo esc_attr($term->link); ?>" title="<?php echo $title_attribute; ?>">
						<figure class="CardImage Rounded">
							<span class="CardImageTitle"><?php echo $term->count; ?></span>
						</figure>
					</a>
					<div class="CardContent">
						<a href="<?php echo esc_attr($term->link); ?>" title="<?php echo $title_attribute; ?>"><span  class="Name"><?php echo $term->name; ?></span></a>
						<span class="Description"><?php echo $term->description; ?></span>
					</div>
				</div>
			</div>
		<?php
		}
		?>
			</div><!-- end .row -->
</section><!-- end #terms -->