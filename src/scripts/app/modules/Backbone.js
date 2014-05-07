define([
	"libs/backbone/backbone"
],
function(backbone)
{
	"use strict";

	var BackboneModule = Backbone.noConflict();

	BackboneModule.ajax = function()
	{
		// console.log("BackboneModule::ajax", arguments);
		return BackboneModule.$.ajax.apply( BackboneModule.$, arguments );
	};

	return BackboneModule;
});