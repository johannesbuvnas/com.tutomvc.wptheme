<?php
namespace tutomvc\modules\metatags;

global $post;

	$meta = get_post_meta( $post->ID, MetaTagsMetaBox::NAME );
	$meta = count( $meta ) ? array_pop($meta) : NULL;

	if($meta)
	{
		$description = $meta[MetaTagsMetaBox::DESCRIPTION];
		if(!isset($description) || empty($description)) $description = "";
		$description = apply_filters( MetaTagsMetaBox::FILTER_DESCRIPTION, $description, $post );
		
		$imgsrc = count($meta[MetaTagsMetaBox::IMAGE]) ? wp_get_attachment_image_src( $meta[MetaTagsMetaBox::IMAGE][0]['id'], "large" ) : NULL;
		if(is_array($imgsrc)) $imgsrc['attachmentID'] = $meta[MetaTagsMetaBox::IMAGE][0]['id'];
		$imgsrc = apply_filters( MetaTagsMetaBox::FILTER_IMAGE, $imgsrc, $post );
	?>
		<?php
			if(is_array($imgsrc) && filter_var( $imgsrc[0], FILTER_VALIDATE_URL )):
		?>
			<meta itemprop="image" content="<?php echo $imgsrc[0]; ?>">
			<meta name="twitter:image:src" content="<?php echo $imgsrc[0]; ?>">
			<meta itemprop="image" content="<?php echo $imgsrc[0]; ?>">
			<meta property="og:image" content="<?php echo $imgsrc[0]; ?>" />
		<?php
			endif;
		?>

		<?php
			if(!empty($description)):
		?>
			<meta name="description" content="<?php echo $description; ?>" />
			<meta name="twitter:description" content="<?php echo $description; ?>">
			<meta itemprop="description" content="<?php echo $description; ?>">
			<meta property="og:description" content="<?php echo $description; ?>" />
		<?php
			endif;
		?>
	<?php
	}
?>