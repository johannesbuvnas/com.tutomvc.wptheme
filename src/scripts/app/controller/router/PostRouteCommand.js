define([
	"jquery",
	"backbone",
	"app/AppRouter"
],
function($, Backbone, AppRouter)
{
	"use strict";
	var previousIndex = 1;

	PostRouteCommand.ROUTE = "post/:id";
	function PostRouteCommand( id )
	{
		var id = id.split(".");
		var index = parseInt(id[0]);
		if(id.length > 1)
		{
			var subIndex = parseInt(id[1]);
		}

		// Filter value
		if(index < 1) index = 1;
		if(index > this.navigation.collection.length) index = this.navigation.collection.length;

		var contentBlockContainer = this.navigation.collection.at(index-1).get("view");

		// Reset and set new index
		this.navigation.collection.forEach(function(model)
			{
				model.set({current:false});
			});
		this.navigation.collection.at(index-1).set({
			current : true
		});


		// Transition time
		if(index > previousIndex) // Only do a transition if scrolling down
		{

		}
		var _this = this;
		AppRouter.inTransition = true;

		var newScrollTop = contentBlockContainer.$el.offset().top - 10;
		$("body").css("overflow", "hidden");
		$(window).stop();
		$(window).animate( {
			scrollTo : {
				y : newScrollTop
			}
		},
		400,
		Sine.easeOut,
		function()
		{
			$("body").css("overflow", "visible");

			AppRouter.inTransition = false;

			if(subIndex) contentBlockContainer.pagination.model.set({index:parseInt(subIndex)});
		} );

		this.navigation.indicator.model.set({index:index});
		this.navigation.indicator.flash();

		previousIndex = index;
	}

	return PostRouteCommand;
});