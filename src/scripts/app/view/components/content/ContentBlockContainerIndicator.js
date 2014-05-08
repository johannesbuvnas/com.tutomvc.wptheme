define([
	"backbone",
	"underscore",
	"text!app/view/components/content/ContentBlockContainerIndicator.tpl.html"
],
function(Backbone, _, HTML)
{
	"use strict";
	var ContentBlockContainerIndicator = Backbone.View.extend({
		attributes : {
			"id" : "contentBlockContainerIndicator"
		},
		template : _.template( HTML ),
		initialize : function()
		{
			this.model = new ContentBlockContainerIndicator.Model();
			this.listenTo( this.model, "change", this.render );
		},
		render : function()
		{
			this.$el.html( this.template( this.model.toJSON() ) );

			return this;
		},
		_flashTimeOut : null,
		flash : function()
		{
			clearTimeout( this._flashTimeOut );
			this.show();
			this._flashTimeOut = setTimeout( _.bind( this.hide, this ), 2000 );
		},
		show : function()
		{
			this.$el.stop();
			this.$el.animate({
				autoAlpha : 1
			},
			0);
		},
		hide : function()
		{
			this.$el.stop();
			this.$el.animate({
				autoAlpha : 0
			},
			400);
		}
	},
	{
		Model : Backbone.Model.extend({
			defaults : {
				index : 1,
				total : 0
			}
		})
	});

	return ContentBlockContainerIndicator;
});