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
	var lastDate = new Date().getTime();
	var lastOffset = 0;
	var speed = 0;

	var getScrollSpeed = function(e)
	{
		var delayInMs = e.timeStamp - lastDate;
		var offset = $("body").scrollTop() - lastOffset;
		var speedInpxPerMs = Math.abs( offset / delayInMs );
		lastDate = e.timeStamp;
		lastOffset = $("body").scrollTop();

		return speedInpxPerMs;
	}

	return function(e)
	{
		speed = getScrollSpeed(e);
		// If scroll fast, don't do anything
		if(speed > .1) return e.preventDefault();

		if(AppModel.get("inTransition")) return e.preventDefault();

		var _this = this;
		var contentBlockContainer = this.navigation.collection.at( AppModel.get("index") - 1 ).get("view");
		// If focus isn't lost from the current page, don't bother
		var focusMinY = contentBlockContainer.$el.offset().top - AppModel.getContentBlockScrollOverlap();
		var focusMaxY = contentBlockContainer.$el.offset().top + ( AppModel.getContentBlockScrollOverlap() ) + ( contentBlockContainer.$el.height() - AppModel.getViewPortHeight() );
		if( $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() > focusMinY && $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() < focusMaxY ) return;

		// Focus is lost from current page, need to find out the next page
		// Determine scroll direction
		var newIndex = AppModel.get("index");
		var subIndex;
		AppModel.set({
			scrollSpeed : speed
		});

		if($( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() > AppModel.get("scrollTop")) newIndex++;
		else newIndex--;

		var view = this.navigation.collection.at( newIndex-1 );
		if(!view) return;
		view = view.get("view");
		if(view.pagination.model.get("total") > 1) subIndex = view.pagination.model.get("index");
		
		AppRouter.navigateToPage( newIndex, subIndex, {trigger:true} );
	};
});