define([
	"jquery",
	"underscore",
	"backbone"
],
function(
	$, 
	_,
	Backbone
)
{
	"use strict";
	var Model = Backbone.Model.extend({	
		defaults : {
			index : 0,
			total : 0
		}
	});

	var HeroBanner = Backbone.View.extend({
		initialize : function()
		{
			this.model = new Model({
				total : this.$el.find("> .Inner").children().length
			});

			var i = 0;
			var _this = this;
			this.$el.find("> .Inner").children().each(function()
			{
				i++;
				if(i < _this.model.get("total")) $(this).css("right", "-100%");
				else $(this).css("right", "0%");
			});

			var _this = this;

			this.listenTo( this.model, "change:index", this.onChangeIndex );

			this.$el.addClass("HeroBannerInitialized");
		},
		render : function()
		{
			return this;
		},
		// Set and get
		getEl : function(index)
		{
			return $( this.$el.find("> .Inner").children().eq( (this.model.get("total") - 1) - index ) );
		},
		// Events
		events : {
			"click .Next" : "onNextClick",
			"click .Previous" : "onPreviousClick"
		},
		onNextClick : function(e)
		{
			e.preventDefault();

			if((this.model.get("index") + 1) < this.model.get("total")) this.model.set({index:this.model.get("index") + 1});
			else this.model.set({index:0});
		},
		onPreviousClick : function(e)
		{
			e.preventDefault();

			if((this.model.get("index") - 1) >= 0) this.model.set({index:this.model.get("index") - 1});
			else this.model.set({index:this.model.get("total") - 1});
		},
		onChangeIndex : function(model, newValue)
		{
			if(this.model.get("total") > 0)
			{
				if(model.previous("index") != newValue)
				{
					var oldEl = this.getEl( model.previous("index") );
					var newEl = this.getEl( newValue );

					oldEl.animate( {right:"100%"} );
					newEl.css("right", "-100%");
					newEl.animate( {right:"0%"} );
				}
			}
		}
	},
	{
		Model : Model,
		autoInstance : function($el)
		{
			$el.find(".HeroBanner.template_wide").each(function()
				{
					if(!$(this).hasClass("HeroBannerInitialized")) new HeroBanner( { el : this } );
				});
		}
	});

	return HeroBanner;
});
