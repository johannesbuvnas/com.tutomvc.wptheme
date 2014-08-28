<?php namespace tutomvc\theme;
/**
*	Loop results in grid system.
*	All posts: 2 column width
*/
global $wp_query;
?>
<div class="container-fluid">
	<?php
		$i = 0;
		$rows = 0;
		$lastColumnSize = 8;
		$columnsPerRow = 3;
		while ( have_posts() )
		{
			$i++;
			$rows++;
			the_post();
			if(($i % $columnsPerRow) == 1)
			{
			?>
				<div class="row">
			<?php
			}
			?>
					<div class="col-md-4 col-xs-12">
						<?php
							get_template_part( 'content', $post->post_type );
						?>
					</div>
			<?php
			if(($i % $columnsPerRow) == 0 || $i == count($wp_query->posts))
			{
			?>
				</div><!-- end .row -->
			<?php
			}
		}
	?>
	<?php
		// Set up paginated links.
		$paged        = $wp_query->get("paged") ? intval( $wp_query->get("paged") ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'type' => "list",
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'tutomvc-theme' ),
			'next_text' => __( 'Next &rarr;', 'tutomvc-theme' ),
		) );

		if ( $links ) :
	?>
			<div class="row">
				<div class="col-md-12" style="text-align:center;">
					<?php echo $links; ?>
				</div>
			</div><!-- end .row -->
	<?php
		endif;
	?>
</div><!-- end .container-fluid -->