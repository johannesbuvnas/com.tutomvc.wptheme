<?php
	namespace tutomvc\theme;
	/**
	 * The Header for our theme
	 *
	 * Displays all of the <head> section and everything up till #stage
	 */
	$ajaxCommands = array();
	global $themeFacade;
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo \tutomvc\WordPressUtil::getPageTitle(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable=no"/>
	<script type="text/javascript">
		AppFacade = window.AppFacade = {
			"getURL": function ( relativePath )
			{
				var url = "<?php echo $themeFacade->getURL(); ?>";
				return relativePath ? url + "/" + relativePath : url;
			},
			"isProduction": <?php echo AppFacade::isProduction() ? "true" : "false"; ?>,
			"version": "<?php echo AppFacade::VERSION; ?>",
			"nonce": "<?php echo wp_create_nonce( AppFacade::NONCE_NAME ); ?>",
			"ajaxURL": "<?php echo admin_url( 'admin-ajax.php' ); ?>",
			"wpQuery": {
				"vars": <?php echo json_encode($wp_query->query_vars); ?>,
				"max_num_pages": <?php echo $wp_query->max_num_pages; ?>
			},
			"nextPageURL": "<?php echo get_next_posts_page_link(); ?>",
			"prevPageURL": "<?php echo get_previous_posts_page_link(); ?>",
			"ajaxCommands": <?php echo json_encode( $ajaxCommands ); ?>
		};
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
	if ( AppFacade::isProduction() ) do_action( \tutomvc\modules\analytics\AnalyticsModule::ACTION_RENDER );
?>

<?php get_template_part( "templates/site", "navigation" ); ?>
<!-- .SiteNavigationOverlay -->
<div class="SiteNavigationOverlay"></div>
<!-- end .SiteNavigationOverlay -->

<!-- #main -->
<section id="main">

	<?php get_template_part( "templates/main", "header" ); ?>

	<!-- #mainContent -->
	<div id="mainContent">