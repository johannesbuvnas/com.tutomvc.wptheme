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
		},
		render : function()
		{
			return this;
		}
	});

	return Stage;
});