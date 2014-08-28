<?php namespace tutomvc\theme;
/**
*	section.EntryDiscussion
*/
if ( post_password_required() ) return;
if ( !comments_open() && !get_comments_number() ) return;
global $post;
?>
<section class="EntryDiscussion">
	<div class="Inner">
		<ul class="nav nav-tabs" role="tablist">
			<li class="">
				<a href="#discussion">
					<span class='glyphicon glyphicon-comment'></span> <?php echo get_comments_number() ? __("Discussion", "tutomvc-theme") . " ( ".get_comments_number()." )" : __( "Discuss", "tutomvc-theme" ); ?>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<?php
				$wp_query->byline = array(
					//"current" => "discussion"
				);
				comments_template();
			?>
		</div>
	</div>
</section>