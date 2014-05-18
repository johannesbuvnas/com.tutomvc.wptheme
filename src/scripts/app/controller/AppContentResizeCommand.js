define([
	"backbone"
],
function(Backbone)
{
	"use strict";
	return function()
	{
		this.$el.css({
			"height" : this.$("#stage").outerHeight()
		});
	};
});