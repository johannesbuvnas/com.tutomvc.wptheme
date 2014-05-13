define([
	"backbone",
	"app/view/components/content/ContentBlockContainerIndicator",
	"app/model/navigation/ContentBlockContainerCollection",
	"app/view/components/navigation/Pagination"
],
function(Backbone, ContentBlockContainerIndicator, ContentBlockContainerCollection, Pagination)
{
	"use strict";
	var Navigation = Backbone.View.extend({
		tagName : "a",
		attributes : {
			"id" : "navigationButton",
			"href" : "#"
		},
		initialize : function()
		{
			// Models
			this.collection = new ContentBlockContainerCollection();
			this.listenTo( this.collection, "add", this.onCollectionChange );

			// Views
			this.indicator = new ContentBlockContainerIndicator();
			this.pagination = new Pagination();
		},
		render : function()
		{
			this.collection.renderAll();
			this.pagination.render( this.collection );
			this.$el.html("Navigation");
		},
		events : {
			"click" : "onClick"
		},
		onClick : function(e)
		{
			e.preventDefault();
			this.pagination.toggle();
		},
		// Events
		onCollectionChange : function(e)
		{
			this.indicator.model.set({
				index : this.collection.indexOf( this.collection.findWhere( {current:true} ) ) + 1,
				total : this.collection.length
			});
		}
	});

	return Navigation;
});