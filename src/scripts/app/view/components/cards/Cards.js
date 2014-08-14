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
		initialize : function()
		{
			// Model
			if(!this.model) this.model = new Cards.Model();
			this.model.set({posts:this.$(".Card").length});

			var cardWidthPercentage = this.$(".Card").first().width() / this.$el.width();
			if(cardWidthPercentage <= .33) this.model.set({posts_per_page:6});
			else if(cardWidthPercentage > .5) this.model.set({posts_per_page:4});

			//Views
			this.$el.addClass("CardsInitialized");
			if(this.$(".Card").length > 6)
			{
				this.$moreButton = $( CardsNavigationButtonMoreHTML );
				this.$el.append( this.$moreButton );
			}
			this.masonry = new Masonry(this.el, {
				itemSelector : ".Card",
				transitionDuration: 0
			});

			// Controller
			this.listenTo( this.model, "change:page", this.render );

			this.render();
		},
		render : function()
		{
			var i = 0;
			var hideAt = (this.model.get("posts_per_page") * this.model.get("page"));
			this.$( ".Card" ).each(function()
				{
					if(!$(this).is(".SimpleButton"))
					{
						i++;

						if(i < hideAt) $(this).css("display", "block");
						else $(this).css("display", "none");
					}
				});

			if(!this.model.hasMore() && this.$moreButton) this.$moreButton.css( "display", "none" );

			this.masonry.layout();

			return this;
		},
		events : {
			"click .MoreButton" : "onMoreClick"
		},
		onMoreClick : function(e)
		{
			console.log(this.model.hasMore());
			if(this.model.hasMore()) this.model.set({page:this.model.get("page") + 1});
		}
	},
	{
		Model : Backbone.Model.extend({
			defaults : {
				posts_per_page : 6,
				posts : 0,
				page : 1
			},
			hasMore : function()
			{
				return this.get("page") < this.getMaxPage();
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
		}
	});

	return Cards;
});
