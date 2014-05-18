define([
	"underscore",
	"backbone",
	"app/view/components/navigation/Indicator",
	"app/model/navigation/ContentBlockContainerCollection",
	"app/view/components/navigation/Pagination",
	"app/view/components/navigation/buttons/MainButton",
	"app/view/components/navigation/buttons/NextButton",
	"app/view/components/navigation/buttons/PreviousButton"
],
function(
	_,
	Backbone,
	Indicator,
	ContentBlockContainerCollection, 
	Pagination, 
	MainButton, 
	NextButton, 
	PreviousButton
)
{
	"use strict";
	var Navigation = Backbone.View.extend({
		initialize : function()
		{
			// Models
			this.collection = new ContentBlockContainerCollection();
			this.listenTo( this.collection, "add", this.onCollectionChange );

			// Views
			this.indicator = new Indicator({
				el : this.$("#indicator")
			});
			this.pagination = new Pagination();

			// Controllers
			this.collection.on( "add", _.bind( this.pagination.add, this.pagination ) );
		},
		render : function()
		{
			if(this.collection.length > 1 && !Backbone.$("#stage").hasClass("Preview"))
			{
				this.indicator.flash();

				if(this.collection.length > 1)
				{
					this.$("#mainButton").animate({autoAlpha:1},0);
				}
			}

			this.collection.renderAll();

			return this;
		},
		events : {
			"click #mainButton" : "onNavigationButtonClick"
		},
		onNavigationButtonClick : function(e)
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