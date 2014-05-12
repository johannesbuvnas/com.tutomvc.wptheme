define([
	"underscore",
	"jquery",
	"backbone",
	"text!app/view/components/navigation/Pagination.tpl.html",
	"app/AppRouter",
	"app/AppConstants",
	"app/AppModel"
],
function(_, $, Backbone, HTML, AppRouter, AppConstants, AppModel)
{
	"use strict";
	var Pagination = Backbone.View.extend({
		tagname : "ul",
		attributes : {
			id : "pagination"
		},
		initialize : function()
		{
			this.$el.on( "click", _.bind(this.toggle, this) );
		},
		render : function( collection )
		{
			this.$el.html( HTML );
			var _this = this;
			var i = 0;
			collection.forEach(function(model)
				{
					i++;

					var thumbnail = model.get("view").thumbnail;
					_this.$("> .Inner").append( thumbnail.$el );
					thumbnail.render();
				});
		},
		toggle : function()
		{
			this.$el.toggleClass("Expanded");

			if( this.$el.hasClass( "Expanded" ) )
			{
				$("#stage > .Inner").animate({
					opacity : 0
				}, 300);

				var _this = this;
				var width = $(".ContentBlockContainerThumbnail").first().outerWidth();
				var scale = AppModel.getViewPortWidth() / width;
				var y = ( $("body").scrollTop() / ($("body").height() - AppModel.get("windowHeight")) ) * 100;
				this.$el.css("overflow", "hidden");
				this.reflectScroll();
				this.$("> .Inner").animate({
					transform : "scale("+scale+")",
					transformOrigin : "50% "+y+"%"
				}, 0);

				this.$("> .Inner").delay(200).animate({
					transform : "scale(1)"
				},1000, Expo.easeInOut, function()
				{
					_this.$("> .Inner").attr("style","");
					_this.$el.css("overflow", "scroll");
				});

				$("body").css("overflow", "hidden");
			}
			else
			{
				$("#stage > .Inner").animate({
					opacity : 1
				}, 0);
				$("body").css("overflow", "visible");
			}
		},
		reflectScroll : function()
		{
			var y = ( $("body").scrollTop() / ($("body").height() - AppModel.get("windowHeight")) );

			// this.$el.scrollTop( 0 );
			// this.$el.scrollTop( this.$(".ContentBlockContainerThumbnail.Current").position().top );
			this.$el.scrollTop( y * this.$el.height() );
		},
		// Events
		events : {
			"click a.ContentBlockContainerThumbnail" : "onThumbnailClick"
		},
		onThumbnailClick : function(e)
		{
			e.preventDefault();

			AppRouter.navigateToPage( Backbone.$( e.currentTarget ).attr("data-index"), null, {trigger:true} );
		}
	});

	return Pagination;
});