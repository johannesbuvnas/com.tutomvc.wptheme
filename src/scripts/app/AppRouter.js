define([
	"underscore",
	"backbone",
	"app/controller/filter/PageNavigationFilterCommand"
],
function(_, Backbone, PageNavigationFilterCommand)
{
	"use strict";
	var Router = Backbone.Router.extend({
		inTransition : false,
		navigateToPage : function( contentBlockContainerIndex, contentBlockIndex, options )
		{
			var defaultOptions = {
				isFiltered : false
			};
			options = _.extend( defaultOptions, options );

			// No filter applied, need filter
			if(!options.isFiltered)
			{
				return Backbone.$(window).trigger( PageNavigationFilterCommand.NAME, [this, contentBlockContainerIndex, contentBlockIndex, options] );
			}
			// OK it's filtered, lets go
			else
			{
				if(contentBlockIndex) this.navigate( "page/" + contentBlockContainerIndex + "/" + contentBlockIndex, options );
				else this.navigate( "page/" + contentBlockContainerIndex, options );
			}
		}
	});

	return new Router();
});