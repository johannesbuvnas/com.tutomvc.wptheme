define([
	"backbone",
	"underscore",
	"text!app/view/components/content/ContentBlockPagination.tpl.html"
],
function(Backbone, _, HTML)
{
	"use strict";

	var Model = Backbone.Model.extend({	
		defaults : {
			index : 1,
			total : 0
		}
	});

	var ContentBlockPagination = Backbone.View.extend({
		tagName : "ul",
		attributes : {
			"class" : "ContentBlockPagination"
		},
		template : _.template( HTML ),
		initialize : function()
		{
			this.model = new ContentBlockPagination.Model();
			this.listenTo( this.model, "change", this.render );
		},
		render : function()
		{
			this.$el.html( this.template( this.model.toJSON() ) );

			return this;
		},
		events : {
			"click li a" : "onClick"
		},
		onClick : function(e)
		{
			e.preventDefault();

			this.model.set({
				index : parseInt( Backbone.$(e.currentTarget).attr("data-id") )
			});
		}
	},
	{
		Model : Model
	});

	return ContentBlockPagination;
});