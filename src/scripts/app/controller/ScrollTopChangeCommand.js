define([
	"jquery",
	"backbone",
	"app/AppConstants"
],
function($, Backbone, AppConstants)
{
	"use strict";
	return function(model, newValue)
	{
		var _this = this;

		if(model.get("index") > model.previous("index"))
		{
			// Attend to scroll down
			if($( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() > newValue)
			{
				// Window has already scrolled passed the new value, don't do transition
				model.set({
					scrollTop : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop()
				},{
					trigger : false
				});

				return $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).trigger( AppConstants.SCROLL_TOP_UPDATED );
			}
		}
		else if(model.get("index") < model.previous("index"))
		{
			// Attend to scroll up
			if($( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() < newValue)
			{
				// Window has already scrolled passed the new value, don't do transition
				model.set({
					scrollTop : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop()
				},{
					trigger : false
				});

				return $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).trigger( AppConstants.SCROLL_TOP_UPDATED );
			}
		}

		var _this = this;
		// Transition time
		model.set({
			inTransition : true
		});
		// Disable scroll
		_this.$el.css( "overflow", "hidden" );
		// Stop animations
		$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).stop();
		// Animation
		$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).animate( {
			scrollTo : {
				y : newValue
			}
		},
		1000,
		Expo.easeOut,
		function()
		{
			// Enable scroll again
			_this.$el.css("overflow", "auto");
			// Transition is over
			model.set({
				inTransition : false
			});
			_this.navigation.indicator.flash();
			return $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).trigger( AppConstants.SCROLL_TOP_UPDATED );
		} );
	};
});