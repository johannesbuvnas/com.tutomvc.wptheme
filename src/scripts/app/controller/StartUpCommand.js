define([
	"backbone",
	"app/AppConstants",
	"app/AppModel",
	"app/AppRouter",
	"jquery",
	"underscore",
	"app/controller/WindowResizeCommand",
	"app/controller/AppResizeCommand",
	"app/controller/AppRenderCommand",
	"app/modules/MasonryModule",
	"app/view/Stage",
	"app/view/components/content/ContentBlockContainer",
	"app/view/components/navigation/Navigation",
	"app/controller/ScrollCommand",
	"app/controller/router/PostRouteCommand",
	"app/controller/router/DefaultRouteCommand",
	"app/controller/ScrollTopChangeCommand",
	"app/controller/IndexChangeCommand",
	"imagesloaded/imagesloaded"
],
function( Backbone, 
	AppConstants, 
	AppModel, 
	AppRouter, 
	$, 
	_, 
	WindowResizeCommand, 
	AppResizeCommand,
	AppRenderCommand,
	MasonryModule, 
	Stage, 
	ContentBlockContainer, 
	Navigation, 
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

			app.navigation = new Navigation({
				el : $("#navigation")
			});
			app.stage.$el.append( app.navigation.pagination.$el );

			app.$( ".ContentBlockContainer" ).each(function()
			{
				var view = new ContentBlockContainer({
					el : this
				});
				app.navigation.collection.add({
					view : view,
					current : app.navigation.collection.length == 0 ? true : false
				});
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
			ImagesLoaded( app.$el, _.bind( app.render, app ) );
		}

		prepModel();
		prepView();
		prepController();
	};
});
