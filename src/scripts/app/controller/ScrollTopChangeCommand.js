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
			if($(window).scrollTop() > newValue)
			{
				// Window has already scrolled passed the new value, don't do transition
				model.set({
					scrollTop : $(window).scrollTop()
				},{
					trigger : false
				});

				return $(window).trigger( AppConstants.SCROLL_TOP_UPDATED );
			}
		}
		else
		{
			// Attend to scroll up
			if($(window).scrollTop() < newValue)
			{
				// Window has already scrolled passed the new value, don't do transition
				model.set({
					scrollTop : $(window).scrollTop()
				},{
					trigger : false
				});

				return $(window).trigger( AppConstants.SCROLL_TOP_UPDATED );
			}
		}

		var _this = this;
		// Transition time
		model.set({
			inTransition : true
		});
		// Disable scroll
		$("body").css( "overflow", "hidden" );
		// Stop animations
		$(window).stop();
		// Animation
		$(window).animate( {
			scrollTo : {
				y : newValue
			}
		},
		400,
		Sine.easeOut,
		function()
		{
			// Enable scroll again
			$("body").css("overflow", "visible");
			// Transition is over
			model.set({
				inTransition : false
			});
			_this.navigation.indicator.flash();
			return $(window).trigger( AppConstants.SCROLL_TOP_UPDATED );
		} );
	};
});