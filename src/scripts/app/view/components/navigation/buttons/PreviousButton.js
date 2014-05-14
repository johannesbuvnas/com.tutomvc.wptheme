define([
	"backbone"
],
function(Backbone)
{
	"use strict";
	var PreviousButton = Backbone.View.extend({
		tagName : "a",
		attributes : {
			"title" : "Previous",
			"id" : "previousButton",
			"href" : "#"
		},
		initialize : function()
		{
			this.render();
		},
		render : function()
		{
			this.$el.html("Previous");
			return this;
		}
	});

	return PreviousButton;
});