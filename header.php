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
				"nonce" : "<?php echo wp_create_nonce( AppFacade::NONCE_NAME ); ?>",
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
			if(AppFacade::isProduction()) do_action( \tutomvc\modules\analytics\AnalyticsModule::ACTION_RENDER );
			
			$classes = array();
			$classes[] = AppFacade::$isPreview ? "Preview" : "";
		?>

		<div id="stage" class="<?php echo implode(" ", $classes); ?>">
			<div class="Inner BorderBox">
			
				<!-- #header -->
				<header id="header">
				
					<div class="Inner">
						<button id="navButton" class="SimpleButton">
							<span class="glyphicon glyphicon-align-justify"></span>
						</button>
						<button id="searchButton" class="SimpleButton">
							<span class="glyphicon glyphicon-search"></span>
						</button>
						<h1 id="navTitle"><?php echo get_bloginfo( 'name' ); ?></h1>
					</div>

					<!-- #navigation -->
					<section id="navigation" class="Hidden PriorityMedium">
						<div class="Inner BorderBox">
							<?php
								wp_nav_menu( array(
									"theme_location" => AppFacade::NAV_MENU_NAVIGATION,
									"container" => "nav",
									"fallback_cb" => NULL,
									"echo" => TRUE,
									'menu_class' => 'nav nav-tabs nav-stacked',
									"walker" => new NavMenuWalker()
								) );
							?>
							<?php if(is_user_logged_in()): 
								$user = wp_get_current_user();
							?>
								<!-- <ul class="nav nav-tabs nav-stacked">
								  <li>
								  	<a href="<?php echo admin_url(); ?>">
								  		<?php echo get_avatar($user->ID, 36); ?>
								  		<span><?php echo $user->display_name; ?></span>
								  	</a>
								  </li>
								</ul> -->
								<!-- Single button -->
								<div class="WPAdmin btn-group dropup">
								  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								    <?php echo get_avatar($user->ID, 30); ?> <span><?php echo $user->display_name; ?></span> <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
								  	<li><a href="<?php echo wp_logout_url(); ?>"><span class="glyphicon glyphicon-remove"></span> <?php _e( "Log out", "tutomvc-theme" ); ?></a></li>
								    <li><a href="<?php echo admin_url(); ?>"><span class="glyphicon glyphicon-wrench"></span> <?php _e( "Dashboard", "tutomvc-theme" ); ?></a></li>
								  </ul>
								</div>
							<?php endif; ?>
						</div>
					</section>
					<!-- end #navigation -->

					<!-- #search -->
					<?php 
						$classes = array( "PriorityMedium", "Hidden" );
						if(is_404()) $classes = array( "PriorityLow" );
					?>
					<section id="search" class="<?php echo implode( " ", $classes ); ?>">
						<div class="Inner container">
							<div class="row">

								<div class="col-md-12">
									<?php 
										get_search_form( TRUE );
									?>
								</div>
								
							</div>

							<section class="WidgetArea">
								<?php dynamic_sidebar( AppFacade::SIDEBAR_SEARCH ); ?>
							</section>
						</div>
					</section>
					<!-- end #search -->

				</header>
				<!-- end #header -->

				<!-- #main -->
				<section id="main">