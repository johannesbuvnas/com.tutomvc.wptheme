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
		var contentBlockContainer = this.navigation.collection.findWhere({current:true}).get("view");
		// If focus isn't lost from the current page, don't bother
		var focusMinY = contentBlockContainer.$el.offset().top - AppModel.getContentBlockScrollOverlap();
		var focusMaxY = contentBlockContainer.$el.offset().top + ( AppModel.getContentBlockScrollOverlap() ) + ( contentBlockContainer.$el.height() - AppModel.getViewPortHeight() );
		if( $(window).scrollTop() > focusMinY && $(window).scrollTop() < focusMaxY ) return;

		// Focus is lost from current page, need to find out the next page
		var newIndex = this.navigation.collection.indexOf( this.navigation.collection.findWhere({current:true}) ) + 1;
		// Determine scroll direction
		if($(window).scrollTop() > AppModel.get("scrollTop")) newIndex++; // Scrolling down, next index
		else newIndex--; // Scrolling up, previous index

		if(newIndex >= 1 && newIndex <= this.navigation.collection.length && this.navigation.collection.at(newIndex - 1))
		{
			var view = this.navigation.collection.at(newIndex-1).get("view");
			return AppRouter.navigateToPage( newIndex, null, {trigger:true} );;
		}
	};
});