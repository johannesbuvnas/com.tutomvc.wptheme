<?php
	namespace tutomvc\theme;

	?>

<!-- #mainHeader -->
<header id="mainHeader" class="">
	<div class="Inner">
		<button id="siteNavigationButton" class="SimpleButton SiteNavigationToggleButton">
			<span class="glyphicon glyphicon-align-justify"></span>
		</button>
		<button id="mainDashboardButton" class="SimpleButton MainDashboardToggleButton">
			<span class="glyphicon glyphicon-search"></span>
		</button>
		<h1 id="navTitle"><?php echo get_bloginfo( 'name' ); ?></h1>
	</div>
</header>
<!-- end #mainHeader -->