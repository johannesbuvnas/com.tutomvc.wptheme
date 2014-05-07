<?php
namespace tutomvc\theme;

$_options = array();
if(isset($options) && is_array($options)) $_options = array_merge( $_options, $options );

if(isset($posts) && count($posts))
{
?>
	<div class="<?php echo implode(" ", $classNames); ?>" data-masonry-options='<?php echo json_encode( $_options ); ?>'>
		<div class="Gutter"></div>
		<?php
			foreach($posts as $post)
			{
				$itemMediator->setPost( $post );
				$itemMediator->render();
			}
		?>
	</div>
<?php 
}