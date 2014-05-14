define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/content/ContentBlock",
	"app/view/components/content/ContentBlockPagination",
	"app/AppModel",
	"app/AppRouter",
	"app/view/components/content/ContentBlockContainerThumbnail"
],
function($, _, Backbone, ContentBlock, ContentBlockPagination, AppModel, AppRouter, ContentBlockContainerThumbnail)
{
	"use strict";
	var ContentBlockContainer = Backbone.View.extend({
		initialize : function()
		{
			this.collection = new Backbone.Collection();
			this.pagination = new ContentBlockPagination();
			this.listenTo( this.pagination.model, "change:index", this.onPaginate );
			this.thumbnail = new ContentBlockContainerThumbnail();
			this.thumbnail.model.set({
				src : this.$el.attr( "data-thumbnail" ),
				postID : this.$el.attr( "data-post-id" ),
				permalink : this.$el.attr( "data-permalink" )
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

				$("body").on( "mouseup", _.bind( this.onMouseUp, this ) );
				$("body").on( "mousemove", _.bind( this.onMouseMove, this ) );
			}
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
			this.$el.height( this.collection.at( this.pagination.model.get("index") - 1 ).get("view").$el.outerHeight() );
			var height = this.collection.at( this.pagination.model.get("index") - 1 ).get("view").$el.outerHeight();
			if(this.$("> .Meta").length)
			{
				this.$("> .Meta").css("top", height);
				height += parseInt(this.$("> .Meta").outerHeight());
			}

			this.$el.height( height );
			// this.$el.height( this.collection.at( this.pagination.model.get("index") - 1 ).get("view").$el.outerHeight() );

			var view;
			this.$( ".ContentBlock.Active" ).removeClass("Active");
			view = this.collection.at( this.pagination.model.get("index") - 1 ).get("view");
			// Show active
			view.$el.animate({autoAlpha:1}, 0);
		},
		// Events
		events : {
			// "mousedown" : "onMouseDown"
		},
		dragging : false,
		startDragX : 0,
		onMouseDown : function(e)
		{
			this.dragging = true;
			this.startDragX = e.offsetX;
		},
		onMouseMove : function(e)
		{
			if(this.dragging)
			{
				e.preventDefault();
				
				if(e.offsetX < this.startDragX)
				{
					console.log("dragging left");
				}
				else
				{
					console.log("dragging right");
				}
			}
		},
		onMouseUp : function(e)
		{
			this.dragging = false;
		},
		onPaginate : function(model)
		{
			// Show active
			if(this.collection.at( this.pagination.model.get("index") - 1 ))
			{
				var _this = this;
				var view = view = this.collection.at( this.pagination.model.get("index") - 1 ).get("view");
				view.$el.addClass("Active");
				var fromRight = model.previousAttributes().index < model.get("index") ? "-95%" : "95%";
				view.$el.animate({right:fromRight, autoAlpha:1}, 0);
				view.$el.animate({right:"0px"}, 500, Power2.easeOut, function()
					{
						// Hide others
						_this.$( ".ContentBlock:not(.Active)" ).animate({autoAlpha:0}, 0);
						_this.adjustPagination();
					});
			}
		}
	});

	return ContentBlockContainer;
});
