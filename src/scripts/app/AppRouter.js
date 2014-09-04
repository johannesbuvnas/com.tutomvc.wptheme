define([
	"jquery",
	"underscore",
	"backbone"
],
function($, _, Backbone)
{
	"use strict";
	var Router = Backbone.Router.extend({
		routes : {
			"*path" : "respond"
		},
		respond : function(id)
		{
			var $el = $("#" + id);
			if($el && $el.length)
			{
				var $tabPane = $el.closest( ".tab-pane" );
				if($tabPane && $tabPane.length)
				{
					$( "a[href=#" + $tabPane.attr("id") + "]" ).tab("show");
				}

				$(window).scrollTop( $el.offset().top - 45 );
			}
		}
	});

	return new Router();
});