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

		if(newValue > model.previous("index"))
		{
			// Scrolling down
			var newScrollTop = contentBlockContainer.$el.offset().top - 10;
			AppModel.set({
				scrollTop : newScrollTop
			});
		}
		else
		{
			// Scrolling up
			var newScrollTop = contentBlockContainer.$el.offset().top + (contentBlockContainer.$el.outerHeight() - AppModel.get("windowHeight")) + 10;
			AppModel.set({
				scrollTop : newScrollTop
			});
		}
	};
});