define([
	"jquery",
	"underscore",
	"backbone",
	"app/AppModel",
	"app/AppConstants",
	"app/view/components/hentry/Hentry",
	"app/view/components/header/Header",
	"app/view/components/cards/Cards",
	"app/view/components/cards/CardsComponent"
],
function(
	$, 
	_, 
	Backbone, 
	AppModel, 
	AppConstants,
	Hentry,
	Header,
	Cards,
	CardsComponent
	)
{
	"use strict";
	var Stage = Backbone.View.extend({
		initialize : function()
		{
			// Views
			this.header = new Header({
				el : this.$("#header")
			});
			Hentry.autoInstance( this.$el );
			CardsComponent.autoInstance( this.$el );
			Cards.autoInstance( this.$el );
		}
	});

	return Stage;
});