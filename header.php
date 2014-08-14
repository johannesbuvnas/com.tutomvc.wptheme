<?php
namespace tutomvc\theme;
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till #stage
 */
$ajaxCommands = array(
	UploadThumbnailAjaxCommand::NAME
);
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
		<meta name="viewport" content="width=device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable=no" />
		<script type="text/javascript">
			AppFacade = window.AppFacade = {
				"getURL" : function(relativePath)
				{
					var url = "<?php echo $themeFacade->getURL(); ?>";
					return relativePath ? url + "/" + relativePath : url;
				},
				"isProduction" : <?php echo AppFacade::isProduction() ? "true" : "false"; ?>,
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
		<?php wp_head(); ?>
		<?php
			if(!AppFacade::isProduction()):
		?>
			<noscript>
				<link rel="stylesheet" type="text/css" media="all" href="<?php echo $themeFacade->getURL( "src/css/noscript.css" ); ?>"/>
			</noscript>
		<?php
			else:
		?>
			<noscript>
				<link rel="stylesheet" type="text/css" media="all" href="<?php echo $themeFacade->getURL( "src/css/noscript.pkgd.css" ); ?>"/>
			</noscript>
		<?php
			endif;
		?>
	</head>

	<body <?php body_class(); ?>>
		<?php
			$classes = array();
			$classes[] = AppFacade::$isPreview ? "Preview" : "";
		?>

		<div id="stage" class="<?php echo implode(" ", $classes); ?>">
			<div class="Inner">
			
				<!-- #header -->
				<header id="header">
				
					<div class="Inner">
						<button id="navButton" class="SimpleButton">
							<span class="genericon genericon-menu"></span>
						</button>
						<button id="searchButton" class="SimpleButton">
							<span class="genericon genericon-search"></span>
						</button>
						<h1><?php echo \tutomvc\WordPressUtil::getPageTitle(); ?></h1>
					</div>

					<!-- #navigation -->
					<section id="navigation" class="Hidden PriorityMedium">
						<div class="Inner BorderBox">
							<h6>Navigation</h6>
							<?php
								wp_nav_menu( array(
									"theme_location" => AppConstants::NAV_MENU_NAVIGATION,
									"container" => "nav"
								) );
							?>
							<?php if(is_user_logged_in()): ?>
								<h6>Administration</h6>
								<?php
									wp_nav_menu( array(
										"theme_location" => AppConstants::NAV_MENU_ADMINISTRATION,
										"container" => "nav"
									) );
								?>
							<?php endif; ?>
						</div>
					</section>
					<!-- end #navigation -->

					<!-- #search -->
					<?php 
						$classes = array( "PriorityMedium", "Hidden" );
						// $classes = array( "PriorityMedium" );
					?>
					<section id="search" class="<?php echo implode( " ", $classes ); ?>">
						<div class="Inner BorderBox">
							<?php 
								get_search_form( TRUE ); 
							?>
							<section class="WidgetArea">
								<?php dynamic_sidebar( AppConstants::SIDEBAR_SEARCH ); ?>
							</section>
						</div>
					</section>
					<!-- end #search -->

				</header>
				<!-- end #header -->

				<!-- #main -->
				<section id="main">