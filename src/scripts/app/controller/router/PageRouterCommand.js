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
		// if(!subIndex) subIndex = 1;

		if(index < 1) index = 1;
		if(index > this.contentBlockContainerCollection.pagination.model.get("total")) index = this.contentBlockContainerCollection.pagination.model.get("total");

		this.contentBlockContainerCollection.pagination.model.set({
			index : index
		});

		var _this = this;
		AppRouter.inTransition = true;

		var contentBlockContainer = this.contentBlockContainerCollection.at( this.contentBlockContainerCollection.pagination.model.get("index") - 1 ).get("view");
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

		this.contentBlockContainerCollection.pagination.flash();
	}

	return PageRouterCommand;
});