define([
	"backbone"
],
function(Backbone)
{
	"use strict";
	var MainButton = Backbone.View.extend({
		tagName : "a",
		attributes : {
			"id" : "mainButton",
			"href" : "#"
		},
		initialize : function()
		{
			this.render();
		},
		render : function()
		{
			this.$el.html("Navigation");
		}
	});

	return MainButton;
});