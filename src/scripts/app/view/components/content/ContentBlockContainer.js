define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/content/ContentBlock",
	"app/view/components/content/ContentBlockPagination",
	"app/AppModel",
	"app/view/components/content/ContentBlockContainerPagination",
	"app/AppRouter"
],
function($, _, Backbone, ContentBlock, ContentBlockPagination, AppModel, ContentBlockContainerPagination, AppRouter)
{
	"use strict";
	var Model = Backbone.Model.extend({
	    defaults : {
	    	view : null
	    }
	  });

	var Collection = Backbone.Collection.extend({
		initialize : function()
		{
			this.pagination = new ContentBlockContainerPagination();

			this.on( "add", this.onAdd );
		},
	  render : function()
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

	        contentBlockContainer.model.set({
	          y : contentBlockContainer.$el.offset().top
	          // height : contentBlockContainer.$el.outerHeight()
	        });
	      } );
	  },
	  // Events
	  onAdd : function(model)
	  {
	  	model.get("view").pagination.model.on("change:index", _.bind( this.onContentBlockNavigation, this ));
	  	this.pagination.model.set({
	  		total : this.length
	  	});
	  },
	  onContentBlockNavigation : function(model)
	  {
	  	AppRouter.navigateToPage( this.pagination.model.get("index"), model.get("index") );
	  }
	});

	var ContentBlockContainer = Backbone.View.extend({
		initialize : function()
		{
			this.model = new ContentBlockContainer.Model();
			this.collection = new Backbone.Collection();
			this.pagination = new ContentBlockPagination();
			this.listenTo( this.pagination.model, "change:index", this.onPaginate );

			var _this = this;
			this.$(".ContentBlock").each(function()
				{
					_this.collection.add( {
						view : new ContentBlock({
							el : this
						})
					} );
				});

			if(this.collection.length > 1)
			{
				this.$el.append( this.pagination.$el );
				this.pagination.model.set({
					total : this.collection.length
				});
			}
		},
		render : function()
		{
			if(!this.collection.length) return this;

			var _this = this;
			this.collection.forEach(function(model)
				{
					model.get("view").render();
				});

			this.model.set({
			  y : this.$el.offset().top,
			  focusMinY : this.$el.offset().top - ContentBlockContainer.OVERLAP,
			  focusMaxY : this.$el.offset().top + ( ContentBlockContainer.OVERLAP * 2 ) + ( this.$el.height() - AppModel.getViewPortHeight() )
			});

			this.adjustPagination();

			return this;
		},
		adjustPagination : function()
		{
			this.$el.height( this.collection.at( this.pagination.model.get("index") - 1 ).get("view").$el.outerHeight() );
			this.model.set({
			  focusMaxY : this.$el.offset().top + ( ContentBlockContainer.OVERLAP * 2 ) + ( this.$el.height() - AppModel.getViewPortHeight() )
			});

			var view;
			this.$( ".ContentBlock.Active" ).removeClass("Active");
			view = this.collection.at( this.pagination.model.get("index") - 1 ).get("view");
			// Show active
			view.$el.animate({autoAlpha:1}, 0);
		},
		// Events
		onPaginate : function(model)
		{
			// Show active
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
	},
	{
		OVERLAP : 180,
		Model : Model,
		Collection : Collection
	});

	return ContentBlockContainer;
});