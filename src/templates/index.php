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
			$gaAccount = get_option( ThemeSettings::GOOGLE_ANALYTICS_CODE );
			if(!empty($gaAccount) && AppFacade::$environment == AppConstants::ENVIRONMENT_PRODUCTION && !AppFacade::$isPreview)
			{
				$user = wp_get_current_user();
		?>
				<script>
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];
					a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
					<?php
					// New Google Analytics code to set User ID.
					// $userId is a unique, persistent, and non-personally identifiable string ID.
					if( is_user_logged_in() )
					{
						$user = wp_get_current_user();

						$gacode = "ga('create', '{$gaAccount}', { 'userId': '%s' });";
						echo sprintf( $gacode, $user->user_login );
					}
					else
					{
						$gacode = "ga('create', '{$gaAccount}', 'auto');";
						echo sprintf( $gacode );
					}
					?>
					ga('send', 'pageview');
				</script>
		<?php
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