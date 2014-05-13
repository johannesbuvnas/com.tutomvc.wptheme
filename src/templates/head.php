<?php
namespace tutomvc\theme;
global $themeFacade;

$ajaxCommands = array(
	UploadThumbnailAjaxCommand::NAME
);
?>
<title><?php echo \tutomvc\WordPressUtil::getPageTitle(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<?php
	if(AppFacade::$environment == AppConstants::ENVIRONMENT_STAGE):
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
		getURL : function(relativePath)
		{
			var url = "<?php echo $themeFacade->getURL(); ?>";
			return relativePath ? url + "/" + relativePath : url;
		},
		version : "<?php echo AppFacade::VERSION; ?>",
		nonce : "<?php echo wp_create_nonce( AppConstants::NONCE_NAME ); ?>",
		ajaxURL : "<?php echo admin_url( 'admin-ajax.php' ); ?>",
		ajaxCommands : <?php echo json_encode($ajaxCommands); ?>
	};
</script>