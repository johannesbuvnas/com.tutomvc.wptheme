define([
	"jquery",
	"underscore",
	"backbone",
	"app/AppModel",
	"app/AppConstants",
	"app/view/components/hentry/Hentry"
],
function(
	$, 
	_, 
	Backbone, 
	AppModel, 
	AppConstants,
	Hentry
	)
{
	"use strict";
	var Stage = Backbone.View.extend({
		initialize : function()
		{
			Hentry.autoInstance( this.$el );
		},
		render : function()
		{
			return this;
		}
	});

	return Stage;
});