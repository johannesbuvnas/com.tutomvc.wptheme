<?php 
// TODO: What to do?
global $post;
if($post->post_parent) wp_redirect(get_permalink($post->post_parent));
else wp_redirect( home_url() );
?>