define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/hero/HeroBanner"
],
function(
	$, 
	_,
	Backbone,
	HeroBanner
)
{
	"use strict";
	var Hentry = Backbone.View.extend({
		initialize : function()
		{
			if(this.$(".HeroBanner.template_wide").length)
			{
				this.hero = new HeroBanner({
					el : this.$(".HeroBanner")
				});
				this.listenTo( this.hero.model, "change:index", this.onHeroIndexChange );
			}

			this.$el.addClass("HentryInitialized");
		},
		render : function()
		{
			return this;
		},
		// Events
		onHeroIndexChange : function(model, newValue)
		{
			if(newValue != 0 && $(window).width() >= 740) this.$(".EntryTitles").fadeOut();
			else this.$(".EntryTitles").fadeIn();
		}
	},
	{
		autoInstance : function($el)
		{
			$el.find(".hentry").each(function()
				{
					if(!$(this).hasClass("HentryInitialized")) new Hentry( { el : this } );
				});
		}
	});

	return Hentry;
});
