<?php
namespace tutomvc\theme;
global $themeFacade;
global $wp_query;

$ajaxCommands = array(
	UploadThumbnailAjaxCommand::NAME
);
?>
<title><?php echo \tutomvc\WordPressUtil::getPageTitle(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<?php
	if(!AppFacade::isProduction()):
?>
	<meta name="googlebot" content="noindex" />
	<meta name="googlebot" content="nosnippet" />
	<meta name="slurp" content="noydir">
	<meta name="robots" content="noimageindex,nomediaindex,noindex,nofollow,noarchive,noodp" />
<?php
	endif;
?>
<script type="text/javascript">
	AppFacade = window.AppFacade = {
		"getURL" : function(relativePath)
		{
			var url = "<?php echo $themeFacade->getURL(); ?>";
			return relativePath ? url + "/" + relativePath : url;
		},
		"version" : "<?php echo AppFacade::VERSION; ?>",
		"nonce" : "<?php echo wp_create_nonce( AppConstants::NONCE_NAME ); ?>",
		"ajaxURL" : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
		"wpQuery" : {
			"vars" : <?php echo json_encode($wp_query->query_vars); ?>,
			"max_num_pages" : <?php echo $wp_query->max_num_pages; ?>
		},
		"nextPageURL" : "<?php echo get_next_posts_page_link(); ?>",
		"prevPageURL" : "<?php echo get_previous_posts_page_link(); ?>",
		"ajaxCommands" : <?php echo json_encode( $ajaxCommands ); ?>
	};
</script>