define([
	"jquery",
	"backbone",
	"app/AppRouter"
],
function($, Backbone, AppRouter)
{
	"use strict";
	return function()
	{
		AppRouter.inTransition = true;
		$("body").css("overflow", "hidden");
		this.stage.render();
		this.navigation.collection.renderAll();

		var contentBlockContainer = this.navigation.collection.findWhere({current:true}).get("view");
		var newScrollTop = contentBlockContainer.$el.offset().top - 10;
		$(window).animate( {
			scrollTo : {
				y : newScrollTop
			}
		},
		0,
		Power2.easeOut,
		function()
		{
			$("body").css("overflow", "visible");

			AppRouter.inTransition = false;
		} );
	};
});