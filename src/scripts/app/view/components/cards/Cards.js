define([
	"jquery",
	"underscore",
	"backbone",
	"Masonry",
	"text!app/view/components/cards/CardsNavigationButtonMore.html"
],
function(
	$, 
	_,
	Backbone,
	Masonry,
	CardsNavigationButtonMoreHTML
)
{
	"use strict";
	var Cards = Backbone.View.extend({
		masonry : undefined,
		constructor : function()
		{
			Backbone.View.apply( this, arguments );
		},
		initialize : function()
		{
			Cards._instanceMap[ this.cid ] = this;

			// Model
			var options;
			if(this.$el.attr("data-options")) options = $.parseJSON( this.$el.attr("data-options") );
			if(!this.model) this.model = new Cards.Model( options );
			this.model.set({posts:this.$( this.model.get("itemSelector") ).length});

			//Views
			this.$el.addClass("CardsInitialized");
			this.$moreButton = $( CardsNavigationButtonMoreHTML );
			this.$el.append( this.$moreButton );
			this.masonry = new Masonry(this.el, {
				itemSelector : this.model.get("itemSelector"),
				transitionDuration: 0,
				isResizeBound : false
			});

			// Controller
			this.listenTo( this.model, "change:page", this.render );
			this.listenTo( this.model, "change:filter", this.onFilterChange );

			this.render();
		},
		render : function()
		{
			var i = 0;
			var hideAt = (this.model.get("posts_per_page") * this.model.get("page"));
			var validated;
			var _this = this;
			var appendCards = [];
			var columnWidth = 0;
			// this.$el.html("");
			this.$( this.model.get("itemSelector") ).each(function()
				{
					if(_this.model.isFiltered())
					{
						var name = $(this).find(".CardName").text();
						if(name.indexOf( _this.model.get("filter") ) >= 0) validated = true;
						else validated = false;
					}
					else
					{
						validated = true;
					}

					if(validated)
					{
						i++;

						if(hideAt > 0 && i > hideAt) validated = false;
					}
					
					if(validated) $(this).css("display", "block"), columnWidth = $(this).outerWidth();
					else $(this).css("display", "none");
				});


			if(this.model.hasMore()) this.$moreButton.css("display", "block");
			else this.$moreButton.css("display", "none");

			if(this.model.isFiltered()) this.masonry.options.columnWidth = columnWidth;
			else this.masonry.options.columnWidth = undefined;
			this.masonry.layout();

			this.$el.trigger( "render" );

			return this;
		},
		events : {
			"click .MoreButton" : "onMoreClick",
			"render .Cards" : "onCardsRender"
		},
		onCardsRender : function(e)
		{
			this.render();
		},
		onMoreClick : function(e)
		{
			if(this.model.hasMore()) this.model.set({page:this.model.get("page") + 1});
		},
		onFilterChange : function(e)
		{
			var i = 0;

			if(this.model.isFiltered())
			{
				var _this = this;
				this.$( this.model.get("itemSelector") ).each(function()
					{
						if(!$(this).is(".SimpleButton"))
						{
							var name = $(this).find(".CardName").text();
							name = name.toLowerCase();
							if(name.indexOf( _this.model.get("filter").toLowerCase() ) >= 0) i++;
						}
					});
			}
			else
			{
				i = this.$( this.model.get("itemSelector") ).length;
			}

			this.model.set({
				posts : i,
				page : 1
			}, {silent:true});

			this.render();
		}
	},
	{
		_instanceMap : [],
		Model : Backbone.Model.extend({
			defaults : {
				posts_per_page : 6,
				posts : 0,
				page : 1,
				filter : undefined,
				itemSelector: ".Card"
			},
			isFiltered : function()
			{
				return this.get("filter") && this.get("filter").length;
			},
			hasMore : function()
			{
				return this.get("posts_per_page") > 0 && this.get("page") < this.getMaxPage();
			},
			getMaxPage : function()
			{
				return Math.ceil( this.get("posts") / this.get("posts_per_page") );
			}
		}),
		autoInstance : function( $el )
		{
			$el.find(".Cards").each(function()
				{
					if(!$(this).hasClass("CardsInitialized")) new Cards( { el : this } );
				});
		},
		_onWindowResize : function(e)
		{
			for(var key in Cards._instanceMap)
			{
				var instance = Cards._instanceMap[ key ];
				instance.masonry.layout();
			}
		}
	});
	
	// One master resize command to resize them in the right order
	$(window).resize( _.bind( Cards._onWindowResize, Cards ) );

	return Cards;
});
