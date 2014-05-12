<?php
namespace tutomvc\theme;
global $themeFacade;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	
	<head>
		<?php echo $headContent; ?>
		<?php wp_head(); ?>
		<?php
			if(AppFacade::$environment == AppConstants::ENVIRONMENT_STAGE):
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

	<?php ob_flush(); ?>

	<body <?php body_class(); ?>>

		<?php
			// Google Analytics if is in PRODUCTION MODE
			if(AppFacade::$environment == AppConstants::ENVIRONMENT_PRODUCTION)
			{
				echo get_option( ThemeSettings::GOOGLE_ANALYTICS_CODE );
			}
		?>
		
		<?php 
			echo $bodyContent;
			if(AppFacade::$environment == AppConstants::ENVIRONMENT_PRODUCTION)
			{
		?>
			<script async type="text/javascript" src="<?php echo $themeFacade->getURL( "src/scripts/Main.pkgd.js?v=" . AppFacade::VERSION ); ?>"></script>
		<?php
			}
		?>

		<?php wp_footer(); ?>
	</body>

</html>