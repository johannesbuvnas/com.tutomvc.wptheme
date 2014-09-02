<?php namespace tutomvc\theme;
/**
*	Loop results in grid system.
*	First post: 6 column width
*	Second post: 6 column width
*/
?>
<div class="container-fluid">
	<?php
		$i=0;
		$cols = 2;
		while ( have_posts() )
		{
			$i++;
			the_post();
			if($i == 1) echo '<div class="row">';
			if(($i % $cols) == 1 && $i != 1) echo '</div><div class="row">';
	?>
			<div class="col-xs-12 col-md-6">
				<?php
					get_template_part( 'content', $post->post_type );
				?>
			</div>
	<?php
		}
	?>
		</div>
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