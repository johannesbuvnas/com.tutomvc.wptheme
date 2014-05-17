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
		console.log("ScrollTopChange:", model.get("scrollTop"));

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
		console.log("transition time");
		// Transition time
		model.set({
			inTransition : true
		});
		// Disable scroll
		$( "body" ).css( "overflow", "hidden" );
		// Stop animations
		$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).stop();
		// Animation
		$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).animate( {
			scrollTo : {
				y : newValue
			}
		},
		400,
		Sine.easeOut,
		function()
		{
			console.log("transition time over:", newValue);
			// Enable scroll again
			$("body").css("overflow", "visible");
			// Transition is over
			model.set({
				inTransition : false
			});
			_this.navigation.indicator.flash();
			return $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).trigger( AppConstants.SCROLL_TOP_UPDATED );
		} );
	};
});