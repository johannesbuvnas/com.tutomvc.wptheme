<?php
/**
*	section.EntryByline
*/
namespace tutomvc\theme;
global $wp_query;
global $post;
$terms = \tutomvc\WordPressUtil::getAllTerms( $post );
$tabs = array();
if(!is_page()) $tabs["author"] = '<span class="glyphicon glyphicon-calendar"></span> <time datetime="'.esc_attr( get_the_date( 'c' ) ).'">' . esc_html( get_the_date() ) . '</time> ' . __( "By", "tutomvc-theme" ) . " ...";
if(count($terms)) $tabs["terms"] = '<span class="glyphicon glyphicon-tags"></span> '.__( "Published in", "tutomvc-theme" ) . " (".count($terms).")";
if(!post_password_required() && (comments_open() || get_comments_number()))
{
	// $tabs["discussion"] = get_comments_number() ? __("Comments") . "( ".get_comments_number()." )" : __("Comment");
	// $tabs["discussion"] = "<span class='glyphicon glyphicon-comment'></span> " . $tabs["discussion"];
}
if(get_edit_post_link()) $tabs[get_edit_post_link()] = "<span class='glyphicon glyphicon-pencil'></span> " . __( 'Edit' );
if(!count($tabs)) return;
$wp_query->byline = array(
	"tabs" => $tabs,
	"current" => "author"
);
?>
<section class="EntryByline">
	<div class="Inner">
		<ul class="nav nav-tabs" role="tablist">
			<?php
				$i=0;
				foreach($tabs as $key => $value)
				{
					$i++;
					$classes = array();
					$href = $key;
					if(!filter_var($key, FILTER_VALIDATE_URL)) $href = "#" . $href;
					if((!array_key_exists("current", $wp_query->byline) && !filter_var($key, FILTER_VALIDATE_URL)) || (array_key_exists("current", $wp_query->byline) && $wp_query->byline['current'] == $key))
					{
						$wp_query->byline['current'] = $key;
						$classes[] = "active";
					}
				?>
					<li class="<?php echo implode(" ", $classes); ?>">
						<a href="<?php echo $href; ?>"><?php echo $value; ?></a>
					</li>
				<?php
				}
			?>
		</ul>
		<div class="tab-content">
			<?php
				$i=0;
				foreach($tabs as $key => $value)
				{
					get_template_part( "templates/bylines/section", $key );
				}
			?>
		</div>
	</div>
</section><!-- end .EntryByline -->