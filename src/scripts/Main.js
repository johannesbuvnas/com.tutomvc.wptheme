define([
	"doc-ready/doc-ready",
	"jquery",
	"underscore",
	"backbone",
	"app/AppConstants",
	"app/controller/StartUpCommand"
],
function(DocReady, $, _, Backbone, AppConstants, StartUpCommand )
{
	"use strict";

	// if(console && console.log) console.log( "Hello world" );

	var AppView = Backbone.View.extend({
		el : "body",
		initialize : function()
		{
			this.on( AppConstants.STARTUP, StartUpCommand );
		},
		render : function()
		{
			this.trigger( AppConstants.RENDER );

			return this;
		}
	});

	var app = new AppView;

	return DocReady(function()
		{
			app.trigger( AppConstants.STARTUP );
		});
});
