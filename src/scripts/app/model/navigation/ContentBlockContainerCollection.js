define([
	"underscore",
	"backbone",
	"app/AppRouter"
],
function(_, Backbone, AppRouter)
{
	"use strict";
	var Model = Backbone.Model.extend({
			defaults : {
				view : null,
				current : false
			},
			initialize : function()
			{
				this.on( "change:current", this.onChangeCurrent );
			},
			// Events
			onChangeCurrent : function()
			{
				if(this.get("current")) this.get("view").thumbnail.$el.addClass("Current");
				else this.get("view").thumbnail.$el.removeClass("Current");
			}
		});

	var ContentBlockContainerCollection = Backbone.Collection.extend({
		model : Model,
		initialize : function()
		{
			this.on( "add", this.onAdd );
		},
		renderAll : function()
		{
			var contentBlockContainer;
			this.forEach( function(model)
			{
				contentBlockContainer = model.get("view");
				contentBlockContainer.$el.attr("style", null);
				contentBlockContainer.render();
			} );
			contentBlockContainer.$el.css("margin-bottom", "0px");

			this.forEach( function(model)
				{
					contentBlockContainer = model.get("view");
				} );
		},
		// Events
		onAdd : function(model)
		{
			model.get("view").thumbnail.$el.attr("data-index", this.length);
			model.get("view").pagination.model.on("change:index", _.bind( this.onContentBlockNavigation, this ));
		},
		onContentBlockNavigation : function(model)
		{
			AppRouter.navigateToPage( this.indexOf( this.findWhere( {current:true} ) ) + 1, model.get("index") );
		}
	});

	return ContentBlockContainerCollection;
});