define([
	"jquery",
	"app/AppConstants",
	"app/AppModel"
],
function($, AppConstants, AppModel)
{
	"use strict";
	return function()
	{
		AppModel.set({
			windowWidth : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).width(),
			windowHeight : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).height()
		});

		this.$el.trigger( AppConstants.RESIZE );
	};
});