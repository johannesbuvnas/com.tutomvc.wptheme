define([
	"underscore",
	"backbone"
],
function(_, Backbone)
{
	"use strict";
	var Router = Backbone.Router.extend({
		navigateToPage : function( contentBlockContainerIndex, contentBlockIndex, options )
		{
			if(contentBlockIndex) this.navigate( "post/" + contentBlockContainerIndex + "." + contentBlockIndex, options );
			else this.navigate( "post/" + contentBlockContainerIndex, options );
		}
	});

	return new Router();
});