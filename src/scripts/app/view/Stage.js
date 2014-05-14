define([
	"jquery",
	"underscore",
	"backbone",
	"app/AppModel",
	"app/AppConstants"
],
function($, _, Backbone, AppModel, AppConstants)
{
	"use strict";
	var Stage = Backbone.View.extend({
		initialize : function()
		{
			console.log(AppFacade);
		},
		render : function()
		{
			if($("#pagination").hasClass("Expanded") && $("#pagination").css("position") == "fixed")
			{
				this.$el.width( AppModel.get("windowWidth") - $("#pagination").outerWidth() );
			}
			else
			{
				this.$el.width( "100%" );
			}

			return this;
		}
	});

	return Stage;
});