<?php
namespace tutomvc\theme;
global $themeFacade;

$categories = wp_get_post_categories( $post->ID );
$categoryList = '<p class="CategoryList">'.__( "Posted in", AppFacade::KEY )." ".get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', AppFacade::KEY ) )."</p>";

$tagsList = get_the_tag_list( '<p class="TagList">', " ", "</p>", $post->ID );

if(AppFacade::$isPreview) return;
if(!count($categories) && (get_the_tags( $post->ID ) === FALSE || !count(get_the_tags( $post->ID )))  && !comments_open( $post->ID )) return;
?>

<div class="Meta">
	<div class="Wrapper">
		<div class="Inner">
			<?php 
				if(is_single())
				{
					echo '<h1>'.get_the_title( $post->ID ).'</h1>';
					echo count($categories) ? $categoryList : '';
					echo get_the_tags( $post->ID ) !== FALSE ? $tagsList : '';
					comments_template( "/src/templates/components/content/meta/comments.php" );
				}
				else
				{
					echo '<p class="Title">'.get_the_title( $post->ID ).'</p>';
					echo '<p class="PostMetaComments"><a class="CommentsLink" href="'.get_permalink( $post ).'#comments">'.sprintf( _n( 'One comment', '%1$s comments', get_comments_number(), AppFacade::KEY ), number_format_i18n( get_comments_number() ) ).'</a></p>';
					echo count($categories) ? $categoryList : '';
					echo get_the_tags( $post->ID ) !== FALSE ? $tagsList : '';
				}
			?>
		</div>
	</div>
</div>