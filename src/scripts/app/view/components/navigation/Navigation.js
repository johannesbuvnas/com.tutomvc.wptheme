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
		attributes : {
			"id" : "navigation"
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
		// Events
		onCollectionChange : function(e)
		{
			this.indicator.model.set({
				index : this.collection.indexOf( this.collection.findWhere( {current:true} ) ) + 1,
				total : this.collection.length
			});

			this.pagination.render( this.collection );
		}
	});

	return Navigation;
});