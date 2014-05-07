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
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1374603952818476";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

		<?php
			// Google Analytics if is in PRODUCTION MODE
			if(AppFacade::$environment == AppConstants::ENVIRONMENT_PRODUCTION):
		?>
				<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				  ga('create', '<?php echo AppConstants::ANALYTICS_ID; ?>', '<?php echo AppConstants::DOMAIN; ?>');
				  ga('send', 'pageview');
				</script>
		<?php
			endif;
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