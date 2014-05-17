define([
	"jquery",
	"app/AppModel"
],
function($, AppModel)
{
	"use strict";
	return function(model, newValue)
	{
		console.log("Index Change Command");
		// Adjust indicator
		this.navigation.indicator.model.set({index:newValue});
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

		if(newValue > model.previous("index") || !AppModel.get("scrolling"))
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