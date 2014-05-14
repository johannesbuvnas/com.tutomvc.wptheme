define([
	"backbone"
],
function(Backbone)
{
	"use strict";
	var NextButton = Backbone.View.extend({
		tagName : "a",
		attributes : {
			"title" : "Next",
			"id" : "nextButton",
			"href" : "#"
		},
		initialize : function()
		{
			this.render();
		},
		render : function()
		{
			this.$el.html("Next");
			return this;
		}
	});

	return NextButton;
});