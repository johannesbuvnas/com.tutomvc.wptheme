define([
	"jquery",
	"backbone",
	"app/AppRouter",
	"app/AppModel",
	"app/AppConstants"
],
function($, Backbone, AppRouter, AppModel, AppConstants)
{
	"use strict";
	PostRouteCommand.ROUTE = "post/:id";
	function PostRouteCommand( id )
	{
		var _this = this;
		var id = id.split(".");
		var index = parseInt(id[0]);
		var subIndex = 1;
		if(id.length > 1)
		{
			subIndex = parseInt(id[1]);
		}

		var updateSubIndex = function()
		{
			var view = _this.navigation.collection.at( index - 1 ).get("view");
			view.pagination.model.set({index:parseInt(subIndex)});
		};

		AppModel.set({
			index : index
		});

		if(AppModel.get("inTransition"))
		{
			$(window).one( AppConstants.SCROLL_TOP_UPDATED, updateSubIndex );
		}
		else
		{
			updateSubIndex();
		}

		return;
	}

	return PostRouteCommand;
});