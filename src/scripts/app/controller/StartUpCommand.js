define([
	"jquery",
	"underscore",
	"backbone",
	"app/AppConstants",
	"app/AppModel",
	"app/AppRouter",
	"app/controller/WindowResizeCommand",
	"app/controller/AppResizeCommand",
	"app/controller/AppContentResizeCommand",
	"app/controller/AppRenderCommand",
	"app/modules/MasonryModule",
	"app/view/Stage",
	"app/controller/ScrollCommand",
	"app/controller/router/PostRouteCommand",
	"app/controller/router/DefaultRouteCommand",
	"app/controller/ScrollTopChangeCommand",
	"app/controller/IndexChangeCommand",
	"imagesloaded/imagesloaded"
],
function( 
	$, 
	_,
	Backbone, 
	AppConstants, 
	AppModel, 
	AppRouter, 
	WindowResizeCommand, 
	AppResizeCommand,
	AppContentResizeCommand,
	AppRenderCommand,
	MasonryModule, 
	Stage, 
	ScrollCommand, 
	PostRouteCommand, 
	DefaultRouteCommand,
	ScrollTopChangeCommand,
	IndexChangeCommand,
	ImagesLoaded
)
{
	"use strict";
	return function()
	{
		var app = this;

		function prepModel()
		{
			AppModel.set({
				windowWidth : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).width(),
				windowHeight : $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).height()
			});
		}

		function prepView()
		{
			app.stage = new Stage({
				el : $("#stage")
			});
			prepViewFallbacks();
		}

		function prepViewFallbacks()
		{
			// Input placeholder fallback
			if(!Modernizr.input.placeholder)
			{
				$('[placeholder]').focus(function() {
				  var input = $(this);
				  if (input.val() == input.attr('placeholder')) {
					input.val('');
					input.removeClass('placeholder');
				  }
				}).blur(function() {
				  var input = $(this);
				  if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				  }
				}).blur();
				$('[placeholder]').parents('form').submit(function() {
				  $(this).find('[placeholder]').each(function() {
					var input = $(this);
					if (input.val() == input.attr('placeholder')) {
					  input.val('');
					}
				  })
				});
			}
		}

		function prepController()
		{
			AppRouter.route( PostRouteCommand.ROUTE, _.bind( PostRouteCommand, app ) );
			AppRouter.route( ":id", _.bind( DefaultRouteCommand, app ) );

			AppModel.on( "change:index", _.bind( IndexChangeCommand, app ) );
			AppModel.on( "change:scrollTop", _.bind( ScrollTopChangeCommand, app ) );

			$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).on( "resize", _.bind( WindowResizeCommand, app ) );

			$( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).on( "scroll", _.bind( ScrollCommand, app ) );

			app.on( AppConstants.RENDER, AppRenderCommand );
			app.$el.on( AppConstants.RESIZE, _.bind( app.render, app ) );
			app.$el.on( AppConstants.RESIZE_CONTENT, _.bind( AppContentResizeCommand, app ) );

			ImagesLoaded( app.$el, _.bind( app.render, app ) );
		}

		prepModel();
		prepView();
		prepController();
	};
});
