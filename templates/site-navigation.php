<?php
	namespace tutomvc\theme;
?>
<!-- #siteNavigation -->
<section id="siteNavigation" tabindex="-1">
	<div class="Inner">
		<?php
			wp_nav_menu( array(
				"theme_location" => AppFacade::NAV_SITE_NAVIGATION,
				"container"      => "nav",
				"fallback_cb"    => NULL,
				"echo"           => TRUE,
				'menu_class'     => 'nav nav-tabs nav-stacked',
				"walker"         => new NavSiteWalker()
			) );
		?>
	</div>
	<div class="Blinder"></div>
</section>
<!-- end #siteNavigation -->