define([
	"jquery",
	"backbone",
	"app/AppRouter",
	"app/AppModel",
	"app/AppConstants"
],
function(
	$,
	Backbone,
	AppRouter,
	AppModel,
	AppConstants
)
{
	"use strict";
	function AppRenderCommand()
	{
		var app = this;
		
		AppModel.set({inTransition:true});
		var oldOverflow = $("body").css("overflow");
		$("#stage > .Inner").animate({
			autoAlpha : 1
		}, 0);

		app.$el.css("overflow", "hidden");
		this.stage.render();
		this.navigation.render();

		var contentBlockContainer = this.navigation.collection.findWhere({current:true}).get("view");
		var newScrollTop = this.navigation.collection.length > 1 ? contentBlockContainer.$el.offset().top - 10 : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop();
		$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).animate( {
			scrollTo : {
				y : newScrollTop
			}
		},
		0,
		Power2.easeOut,
		function()
		{
			app.$el.css( "overflow", oldOverflow );
			app.$el.css({
				"overflow" : oldOverflow
			});
			app.$el.trigger( AppConstants.RESIZE_CONTENT );

			AppModel.set({inTransition:false});
		} );

		if( !this.$el.hasClass("Ready") ) this.$el.addClass("Ready");
		if( !Backbone.History.started ) Backbone.history.start();

		return false;
	}

	return AppRenderCommand;
});