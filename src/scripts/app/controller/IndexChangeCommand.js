define([
	"jquery",
	"app/AppModel",
	"app/AppConstants"
],
function(
	$,
	AppModel,
	AppConstants
	)
{
	"use strict";
	return function(model, newValue)
	{
		// Adjust indicator
		this.navigation.indicator.model.set({index:newValue});
		this.navigation.indicator.flash();
		// Fetch view
		var contentBlockContainer = this.navigation.collection.at(newValue-1).get("view");
		
		// Reset and set new current
		// TODO : really?
		this.navigation.collection.forEach(function(model)
		{
			model.set({current:false});
		});
		this.navigation.collection.at(newValue-1).set({
			current : true
		});
		//

		var newScrollTop;
		if(newValue > model.previous("index"))
		{
			// Scrolling down
			newScrollTop = contentBlockContainer.$el.offset().top - 10;
		}
		else
		{
			// Scrolling up
			if(AppModel.get("isScrollingEnabled")()) newScrollTop = contentBlockContainer.$el.offset().top + (contentBlockContainer.$el.outerHeight() - AppModel.get("windowHeight")) + 10;
			else newScrollTop = contentBlockContainer.$el.offset().top - 10;
		}

		AppModel.set({
			scrollTop : newScrollTop
		});
	};
});