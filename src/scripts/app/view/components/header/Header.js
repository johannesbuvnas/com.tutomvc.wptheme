define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/header/Navigation",
	"app/view/components/header/Search"
],
function(
	$,
	_,
	Backbone,
	Navigation,
	Search
)
{
	"use strict";
	var Header = Backbone.View.extend({
		initialize : function()
		{
			this.navigation = new Navigation({
				el : this.$("#navigation"),
				$toggleButton : this.$("#navButton")
			});
			this.search = new Search({
				el : this.$("#search")
			});
		},
		render : function()
		{
			return this;
		},
		events : 
		{
			"click #navButton" : "onNavButtonClick",
			"click #searchButton" : "onSearchButtonClick"
		},
		onNavButtonClick : function()
		{
			if(this.search.isVisible()) this.search.hide();
			
			this.navigation.toggle();
		},
		onSearchButtonClick : function()
		{
			if(this.navigation.isVisible()) this.navigation.hide();

			this.search.toggle();
		}
	});

	return Header;
});