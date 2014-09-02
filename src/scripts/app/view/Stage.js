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

			this.$(".nav-tabs a").click(function(e)
			{
				var link = $(e.currentTarget).attr("href");

				if(link && link.slice(0,1) == "#")
				{
					e.preventDefault();
					// if(!$(this).parent().hasClass("active")) $(this).tab('show');
					$(this).tab('show');
				}
			});

			this.$(".JSLink").click(function(e)
			{
				var link = $(e.currentTarget).attr("href");
				location.href = link;
			});
			this.$('*[data-toggle="lightbox"]').click(function(e)
			{
				e.preventDefault();
				$(e.currentTarget).ekkoLightbox();
			});
		}
	});

	return Stage;
});