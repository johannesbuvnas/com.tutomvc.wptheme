define([
	"jquery",
	"backbone",
	"app/view/components/content/ContentBlockContainer",
	"app/AppModel",
	"app/AppRouter",
	"app/AppConstants"
],
function(
	$, 
	Backbone, 
	ContentBlockContainer, 
	AppModel, 
	AppRouter, 
	AppConstants
)
{
	"use strict";
	return function(e)
	{
		if(AppModel.get("inTransition")) return e.preventDefault();

		var _this = this;
		var contentBlockContainer = this.navigation.collection.at( AppModel.get("index") - 1 ).get("view");
		// If focus isn't lost from the current page, don't bother
		var focusMinY = contentBlockContainer.$el.offset().top - AppModel.getContentBlockScrollOverlap();
		var focusMaxY = contentBlockContainer.$el.offset().top + ( AppModel.getContentBlockScrollOverlap() ) + ( contentBlockContainer.$el.height() - AppModel.getViewPortHeight() );
		if( $(window).scrollTop() > focusMinY && $(window).scrollTop() < focusMaxY ) return;

		// Focus is lost from current page, need to find out the next page
		// Determine scroll direction
		var newIndex = AppModel.get("index");
		var subIndex;
		AppModel.set({
			scrolling : true
		});

		if($(window).scrollTop() > AppModel.get("scrollTop")) newIndex++;
		else newIndex--;

		var view = this.navigation.collection.at( newIndex-1 ).get("view");
		if(view.pagination.model.get("total") > 1) subIndex = view.pagination.model.get("index");
		
		AppRouter.navigateToPage( newIndex, subIndex, {trigger:true} );
		AppModel.set({
			scrolling : false
		});
	};
});