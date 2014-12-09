<?php
	namespace tutomvc\theme;

	?>

<!-- #mainDashboard -->
<section id="mainDashboard">
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
<!-- end #mainDashboard -->