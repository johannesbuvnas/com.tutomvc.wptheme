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
			windowWidth : $(window).width(),
			windowHeight : $(window).height()
		});

		this.$el.trigger( AppConstants.RESIZE );
	};
});