define([
	"jquery",
	"backbone",
	"app/AppRouter"
],
function($, Backbone, AppRouter)
{
	"use strict";
	PageRouterCommand.ROUTE = "page/:id(/:subid)";
	function PageRouterCommand( index, subIndex )
	{
		index = parseInt(index);

		// Filter value
		if(index < 1) index = 1;
		if(index > this.navigation.collection.length) index = this.navigation.collection.length;

		// Reset and set new index
		this.navigation.collection.forEach(function(model)
			{
				model.set({current:false});
			});
		this.navigation.collection.at(index-1).set({
			current : true
		});


		// Transition time
		var _this = this;
		AppRouter.inTransition = true;

		var contentBlockContainer = this.navigation.collection.at(index-1).get("view");
		var newScrollTop = contentBlockContainer.$el.offset().top - 10;
		$("body").css("overflow", "hidden");
		$(window).stop();
		$(window).animate( {
			scrollTo : {
				y : newScrollTop
			}
		},
		400,
		Power2.easeOut,
		function()
		{
			$("body").css("overflow", "visible");

			AppRouter.inTransition = false;

			if(subIndex) contentBlockContainer.pagination.model.set({index:parseInt(subIndex)});
		} );

		this.navigation.indicator.model.set({index:index});
		this.navigation.indicator.flash();
	}

	return PageRouterCommand;
});