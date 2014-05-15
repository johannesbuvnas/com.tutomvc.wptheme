define([
	"backbone",
	"app/AppConstants",
	"app/AppModel",
	"app/AppRouter",
	"jquery",
	"underscore",
	"app/controller/WindowResizeCommand",
	"app/controller/AppResizeCommand",
	"app/modules/MasonryModule",
	"app/view/Stage",
	"app/view/components/content/ContentBlockContainer",
	"app/view/components/navigation/Navigation",
	"app/controller/ScrollCommand",
	"app/controller/router/PostRouteCommand",
	"app/controller/router/DefaultRouteCommand",
	"app/controller/ScrollTopChangeCommand",
	"app/controller/IndexChangeCommand"
],
function( Backbone, 
	AppConstants, 
	AppModel, 
	AppRouter, 
	$, 
	_, 
	WindowResizeCommand, 
	AppResizeCommand, 
	MasonryModule, 
	Stage, 
	ContentBlockContainer, 
	Navigation, 
	ScrollCommand, 
	PostRouteCommand, 
	DefaultRouteCommand,
	ScrollTopChangeCommand,
	IndexChangeCommand
)
{
	"use strict";
	return function()
	{
		var app = this;

		function prepModel()
		{
			AppModel.set({
				windowWidth : $(window).width(),
				windowHeight : $(window).height()
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
			app.navigation.collection.renderAll();
			if(app.navigation.collection.length > 1 && !app.stage.$el.hasClass("Preview"))
			{
				// app.stage.$el.append( app.navigation.$el );
				// app.stage.$el.append( app.navigation.indicator.$el );
				app.navigation.indicator.flash();
				app.stage.$el.append( app.navigation.pagination.$el );
				app.navigation.render();
			}

			prepViewFallbacks();

			MasonryModule.autoInstance( app.$el );

			app.stage.render();
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

			$(window).on( "resize", _.bind( WindowResizeCommand, app ) );
			$("body").on( AppConstants.RESIZE, _.bind( AppResizeCommand, app ) );

			$(window).on( "scroll", _.bind( ScrollCommand, app ) );

			Backbone.history.start();
		}

		prepModel();
		prepView();
		prepController();

		$("body").addClass( "Ready" );
	};
});
