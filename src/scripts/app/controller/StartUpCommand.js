define([
	"backbone",
	"app/AppConstants",
	"app/AppModel",
	"app/AppRouter",
	"jquery",
	"underscore",
	"app/controller/WindowResizeCommand",
	"app/modules/MasonryModule",
	"app/view/components/content/ContentBlockContainer",
	"app/controller/ScrollCommand",
	"app/controller/router/PageRouterCommand"
],
function( Backbone, AppConstants, AppModel, AppRouter, $, _, WindowResizeCommand, MasonryModule, ContentBlockContainer, ScrollCommand, PageRouterCommand )
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

			app.contentBlockContainerCollection = new ContentBlockContainer.Collection();
			app.$el.on( AppConstants.RESIZE, _.bind( app.contentBlockContainerCollection.render, app.contentBlockContainerCollection ) );
		}

		function prepView()
		{
			app.$stage = app.$( "#stage" );

			app.$( ".ContentBlockContainer" ).each(function()
			{
				var view = new ContentBlockContainer({
					el : this
				});
				app.contentBlockContainerCollection.add({
					view : view
				});
			});
			app.contentBlockContainerCollection.render();
			app.$stage.append( app.contentBlockContainerCollection.pagination.$el );

			prepViewFallbacks();

			MasonryModule.autoInstance( app.$el );
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
			AppRouter.route( PageRouterCommand.ROUTE, _.bind( PageRouterCommand, app ) );

			$(window).on( "resize", _.bind( WindowResizeCommand, app ) );
			$(window).on( "scroll", _.bind( ScrollCommand, app ) );
			$(window).trigger("scroll");

			Backbone.history.start();
		}

		prepModel();
		prepView();
		prepController();
	};
});
