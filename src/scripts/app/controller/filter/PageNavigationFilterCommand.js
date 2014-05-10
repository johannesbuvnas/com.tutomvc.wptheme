define([
	"backbone"
],
function(Backbone, AppRouter)
{
	"use strict";
	PageNavigationFilterCommand.NAME = "tutomvc/theme/event/filter/page_navigation";

	function PageNavigationFilterCommand( event, router, contentBlockContainerIndex, contentBlockSubIndex, options )
	{
		var view = this.navigation.collection.at(contentBlockContainerIndex-1).get("view");
		if(view.pagination.model.get("total") > 1)
		{
			contentBlockSubIndex = view.pagination.model.get("index");
		}

		options.isFiltered = true;

		router.navigateToPage( contentBlockContainerIndex, contentBlockSubIndex, options );
	}

	return PageNavigationFilterCommand;
});