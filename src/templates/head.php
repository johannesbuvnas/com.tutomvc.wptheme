<?php
namespace tutomvc\theme;
global $themeFacade;
?>
<title><?php echo \tutomvc\WordPressUtil::getPageTitle(); ?></title>
<meta name="description" content="The Construction Climate Challenge is really about making the future a better place. In times where construction as an industry will continue to grow we need to do it in a responsible and sustainable way saving the climate for future generations.">
<meta name="keywords" content="construction climate">
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
		ajaxURL : "<?php echo admin_url( 'admin-ajax.php' ); ?>"
	};
</script>