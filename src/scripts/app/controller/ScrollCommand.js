define([
	"jquery",
	"backbone",
	"app/view/components/content/ContentBlockContainer",
	"app/AppModel",
	"app/AppRouter"
],
function($, Backbone, ContentBlockContainer, AppModel, AppRouter)
{
	"use strict";
	return function(e)
	{
		if(AppRouter.inTransition) return e.preventDefault();

		var _this = this;
		var contentBlockContainer = this.contentBlockContainerCollection.at( this.contentBlockContainerCollection.pagination.model.get("index") - 1 ).get("view");
		// If focus isn't lost from the current page, don't bother
		var focusMinY = contentBlockContainer.$el.offset().top - ContentBlockContainer.OVERLAP;
		var focusMaxY = contentBlockContainer.$el.offset().top + ( ContentBlockContainer.OVERLAP ) + ( contentBlockContainer.$el.height() - AppModel.getViewPortHeight() );
		if( $(window).scrollTop() > focusMinY && $(window).scrollTop() < focusMaxY ) return;

		// Focus is lost from current page, need to find out the next page
		var newIndex = this.contentBlockContainerCollection.pagination.model.get("index");
		// Determine scroll direction
		if($(window).scrollTop() > contentBlockContainer.$el.offset().top) newIndex++; // Scrolling down, next index
		else newIndex--; // Scrolling up, previous index

		if(newIndex >= 1 && newIndex <= this.contentBlockContainerCollection.pagination.model.get("total") && this.contentBlockContainerCollection.at(newIndex - 1))
		{
			var view = this.contentBlockContainerCollection.at(newIndex-1).get("view");
			return view.pagination.model.get("total") > 1 ? AppRouter.navigateToPage( newIndex, view.pagination.model.get("index"), {trigger:true} ) : AppRouter.navigateToPage( newIndex, null, {trigger:true} );;
		}
	};
});