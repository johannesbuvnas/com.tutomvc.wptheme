define([
	"backbone"
],
function(Backbone)
{
	"use strict";
	var Router = Backbone.Router.extend({
		inTransition : false,
		navigateToPage : function(contentBlockContainerIndex, contentBlockIndex, options)
		{
			if(contentBlockIndex) this.navigate( "page/" + contentBlockContainerIndex + "/" + contentBlockIndex, options );
			else this.navigate( "page/" + contentBlockContainerIndex, options );
		}
	});

	return new Router();
});