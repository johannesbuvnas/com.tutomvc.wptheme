define([
	"backbone",
	"underscore"
],
function(backbone, _)
{
	"use strict";

	var BackboneModule = Backbone.noConflict();

	// BackboneModule.ajax = function( settings )
	// {
	// 	var defaultSettings = {
	// 		url : AppFacade.ajaxURL,
	// 		data : {
	// 			nonce : AppFacade.nonce
	// 		}
	// 	};
	// 	console.log(_.extend( settings, defaultSettings ));
	// 	return BackboneModule.$.ajax( _.extend( defaultSettings, settings ) );
	// };

	return BackboneModule;
});