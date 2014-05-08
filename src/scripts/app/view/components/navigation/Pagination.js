define([
	"underscore",
	"backbone"
],
function(_, Backbone)
{
	"use strict";
	var Pagination = Backbone.View.extend({
		tagname : "ul",
		attributes : {
			id : "pagination"
		},
		render : function( collection )
		{
			this.$el.html("");
			var _this = this;
			var i = 0;
			collection.forEach(function(model)
				{
					_this.$el.append( model.get("view").thumbnail.$el );
					model.get("view").thumbnail.render();

					i++;
				});
		},
		reset : function(index)
		{

		}
	});

	return Pagination;
});