define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/content/ContentBlock",
	"app/view/components/content/ContentBlockPagination",
	"app/AppModel",
	"app/AppRouter",
	"app/AppConstants",
	"app/view/components/content/ContentBlockContainerThumbnail"
],
function(
	$, 
	_,
	Backbone, 
	ContentBlock, 
	ContentBlockPagination, 
	AppModel, 
	AppRouter, 
	AppConstants,
	ContentBlockContainerThumbnail
)
{
	"use strict";
	var ContentBlockContainer = Backbone.View.extend({
		initialize : function()
		{
			this.collection = new Backbone.Collection();
			this.pagination = new ContentBlockPagination();
			this.thumbnail = new ContentBlockContainerThumbnail();
			this.thumbnail.model.set({
				src : this.$el.attr( "data-thumbnail" ),
				postID : this.$el.attr( "data-post-id" ),
				permalink : this.$el.attr( "data-permalink" ),
				title : this.$el.attr( "data-title" )
			});

			var _this = this;
			this.$(".ContentBlock").each(function()
				{
					var view = new ContentBlock({
						el : this
					});
					_this.collection.add( {
						view : view
					} );
				});

			if(this.collection.length > 1)
			{
				this.$el.append( this.pagination.$el );
				this.pagination.model.set({
					total : this.collection.length
				});
			}

			this.listenTo( this.pagination.model, "change:index", this.onPaginate );
		},
		render : function()
		{
			if(!this.collection.length) return this;

			var _this = this;
			this.collection.forEach(function(model)
				{
					model.get("view").render( AppModel.getViewPortHeight() );
				});

			this.adjustPagination();

			return this;
		},
		adjustPagination : function()
		{
			var view;
			this.$( ".ContentBlock.Active" ).removeClass("Active");
			view = this.collection.at( this.pagination.model.get("index") - 1 ).get("view");

			var viewHeight = view.$el.outerHeight();
			var metaHeight = 0;
			if(this.$("> .Meta").length) metaHeight = parseInt(this.$("> .Meta").outerHeight());

			this.$el.height( viewHeight + metaHeight );

			
			// Show active
			view.$el.animate({autoAlpha:1}, 0);

			this.$("> .Meta").css({
				"top" : viewHeight
			});
		},
		// Events
		events : {
		},
		onPaginate : function(model)
		{
			// Show active
			if(this.collection.at( this.pagination.model.get("index") - 1 ))
			{
				var _this = this;
				var view = view = this.collection.at( this.pagination.model.get("index") - 1 ).get("view");
				var height = view.$el.outerHeight();
				view.$el.addClass("Active");
				var fromRight = model.previousAttributes().index < model.get("index") ? "-95%" : "95%";
				view.$el.animate({right:fromRight, autoAlpha:1}, 0);
				view.$el.animate({right:"0px"}, 500, Power2.easeOut, function()
					{
						// Hide others
						_this.$( ".ContentBlock:not(.Active)" ).animate({autoAlpha:0}, 0);
						_this.adjustPagination();
						// Resize app
						$("body").trigger( AppConstants.RESIZE_CONTENT );
					});
			}
		}
	});

	return ContentBlockContainer;
});
