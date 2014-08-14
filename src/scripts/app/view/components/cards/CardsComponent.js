define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/cards/Cards"
],
function(
	$, 
	_,
	Backbone,
	Cards
)
{
	"use strict";
	var CardsComponent = Backbone.View.extend({
		initialize : function()
		{
			// Model
			var options;
			if(this.$el.attr("data-options")) options = $.parseJSON( this.$el.attr("data-options") );
			if(!this.model) this.model = new CardsComponent.Model( options );

			//Views
			this.cards = new Cards( {
				el : this.$(".Cards")
			} );
			this.$title = this.$("h6");
			if(this.model.get("filterEnabled"))
			{
				var placeholder = this.$title.text();
				this.$title.html("");
				this.$title.css("padding", "0");
				var filterval = this.cards.model.isFiltered() ? this.cards.model.get("filter") : "";
				this.$filter = $('<input type="text" placeholder="' + placeholder + '" class="Filter" value="' + filterval + '">');
				this.$title.append( this.$filter );
			}

			this.render();
		},
		render : function()
		{
			return this;
		},
		events : {
			"keyup .Filter" : "onFilter"
		},
		onFilter : function(e)
		{
			if(this.$filter.val() && this.$filter.val().length) this.cards.model.set({filter : this.$filter.val()});
			else this.cards.model.set({filter : undefined});
		}
	},
	{
		Model : Backbone.Model.extend({
			defaults : {
				title : "",
				filterEnabled : true,
				paginationEnabled : false,
				wpQuery : undefined
			}
		}),
		autoInstance : function( $el )
		{
			$el.find(".CardsComponent").each(function()
				{
					if(!$(this).hasClass("CardsComponentInitialized")) new CardsComponent( { el : this } );
				});
		}
	});

	return CardsComponent;
});
