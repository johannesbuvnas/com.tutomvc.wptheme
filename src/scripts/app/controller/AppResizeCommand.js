define([
	"jquery",
	"backbone",
	"app/AppRouter",
	"app/AppModel"
],
function($, Backbone, AppRouter, AppModel)
{
	"use strict";
	return function()
	{
		AppModel.set({inTransition:true});
		var oldOverflow = $("body").css("overflow");
		$("#stage > .Inner").animate({
			autoAlpha : 1
		}, 0);

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
			$("body").css( "overflow", oldOverflow );

			AppModel.set({inTransition:false});
		} );
	};
});