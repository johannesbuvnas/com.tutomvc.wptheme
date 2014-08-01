define([
	"doc-ready/doc-ready",
	"jquery",
	"underscore",
	"backbone",
	"app/AppConstants",
	"app/AppModel",
	"app/controller/StartUpCommand"
],
function(
	DocReady,
	$,
	_,
	Backbone,
	AppConstants,
	AppModel,
	StartUpCommand
	)
{
	"use strict";

	var AppView = Backbone.View.extend({
		el : "body",
		_started : false,
		initialize : function()
		{
			this.on( AppConstants.STARTUP, StartUpCommand );

			this.$el.addClass("Ready");
		},
		startup : function()
		{
			if(!this._started) app.trigger( AppConstants.STARTUP );
		},
		render : function()
		{
			if(AppModel.get("inTransition"))
			{
				return this.listenToOnce( AppModel, "change:inTransition", this.render );
			}

			this.trigger( AppConstants.RENDER );

			return this;
		}
	});

	var app = new AppView;

	return DocReady(function()
		{
			app.startup();
		});
});
