define([
	"backbone",
	"underscore"
],
function(Backbone, _)
{
	"use strict";

	var TabsModule = Backbone.View.extend({
		initialize : function()
		{
			this.$el.tabs({
				animate : false
			});
			this.$el.on( "change", _.bind( this.onChange, this ) );

			var _this = this;
			this.$("> ul li a").each(function()
				{
					_this.$( Backbone.$(this).attr("href") ).css( "border-top", "1px solid #b1b3b6" );
				});

			this.$("> div").each(function()
				{
					var $el = Backbone.$(this);
					$el.find( ".Pagination .NavButton a" ).each(function()
					{
						var href = Backbone.$(this).attr("href");
						Backbone.$(this).attr("href", href + "#" + $el.attr("id"));
					})
				});
			
			this.render();
			this.resize();
		},
		render : function()
		{
			this.$("> ul").css("display", "block");
			this.$("> ul").height( this.$("> ul li:first").outerHeight() );
		},
		resize : function()
		{
			this.$el.removeClass("NoFit");

			var width = 0;
			this.$("> ul > li").each(function()
				{
					width += Backbone.$(this).outerWidth();
				});

			width += this.$("> ul > li").length * 20;

			if(width > Backbone.$("#stage").innerWidth()) this.$el.addClass("NoFit");
		},
		events : {
			"click li a" : "onChange"
		},
		onChange : function(e)
		{
			this.trigger( TabsModule.CHANGE, Backbone.$(e.target).attr("href") );
		}
	},
	{
		CHANGE : "change",
		instances : [],
		autoInstance : function( $el )
		{
			$el.find( ".TabGroup" ).each(function()
				{
					TabsModule.instances.push( new TabsModule( {
						el : this
					} ) );
				});

			return TabsModule.instances;
		}
	});

	return TabsModule;
});