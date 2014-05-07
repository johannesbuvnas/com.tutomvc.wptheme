define([
	"jquery",
	"Masonry",
	"backbone"
],
function($, Masonry, Backbone)
{
	"use strict";

	var MasonryModule = Backbone.View.extend({
		initialize : function()
		{
			this.masonry = new Masonry( this.el, $.parseJSON( this.$el.attr( "data-masonry-options" ) ) );

			this.$el.css("visibility", "visible");
		}
	},
	{
		autoInstance : function( $el )
		{
			$el.find( ".Masonry" ).each(function()
				{
					new MasonryModule( {
						el : this
					} );
				});
		}
	});

	return MasonryModule;
});