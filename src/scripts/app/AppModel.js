define([
	"jquery",
	"backbone"
],
function($, Backbone)
{
	"use strict";
	var AppModel = Backbone.Model.extend({
		defaults : {
			windowWidth : 0,
			windowHeight : 0,
			scrollTop : 0
		},
		getContentBlockScrollOverlap : function()
		{
			return this.getViewPortHeight() / 3;
		},
		getViewPortHeight : function()
		{
			return this.get( "windowHeight" ) - parseInt($("#stage").css("padding-bottom")) - parseInt($("#stage").css("padding-top"));
		},
		getViewPortWidth : function()
		{
			return this.get( "windowWidth" ) - parseInt($("#stage > .Inner").css("padding-left")) - parseInt($("#stage > .Inner").css("padding-right"));
		}
	});

	return new AppModel();
});