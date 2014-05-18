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
			this.$el.html( HTML );
		},
		add : function(model, collection, event)
		{
			var thumbnail = model.get("view").thumbnail;
			this.$("> .Inner").append( thumbnail.$el );
			thumbnail.render();
			return this;
		},
		toggle : function()
		{
			this.$el.toggleClass("Expanded");

			if( this.$el.hasClass( "Expanded" ) )
			{
				this.reflectScroll();

				this.$el.addClass("InTransition");
				$("#stage > .Inner").animate({
					opacity : 0
				}, 300);

				var _this = this;
				var width = $(".ContentBlockContainerThumbnail").first().outerWidth();
				var scale = AppModel.getViewPortWidth() / width;
				var windowHeight = (this.$("> .Inner").height() / AppModel.get("windowHeight"));
				if(windowHeight > 1) windowHeight = 1;
				if(windowHeight < 0) windowHeight = 0;
				windowHeight = windowHeight * AppModel.get("windowHeight");
				var y = ( $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() / ($("body").height() - windowHeight) ) * 100;
				this.$el.css("overflow", "hidden");

				var cssFrom = {
					"transform" : "scale("+scale+")",
					"transformOrigin" : "50% "+y+"%",
					"top" : "0px",
					"margin-top" : "0px"
				};
				var cssPosition = {};

				if(this.$("> .Inner").outerHeight() < AppModel.get("windowHeight"))
				{
					cssPosition.position = "absolute";
					cssPosition.top = "50%";
					cssPosition['margin-top'] = 0 - (this.$("> .Inner").outerHeight() / 2);
					cssPosition.left = "50%";
					cssPosition['margin-left'] = 0 - (this.$("> .Inner").outerWidth() / 2);
				}

				var cssTo  = {
					"transform" : "scale(1)"
				};


				this.$("> .Inner").animate( _.defaults( cssFrom, cssPosition ), 0 );
				this.$("> .Inner").delay(200).animate( _.extend( cssTo, cssPosition ),1000, Expo.easeInOut, function()
				{
					_this.$("> .Inner").attr("style","");
					_this.$("> .Inner").css( cssPosition );
					_this.$el.css( "overflow", "scroll" );
					_this.$el.removeClass( "InTransition") ;
					_this.$el.trigger('touchstart'); // Bugfix in touch devices?
				});

				$("body").css("overflow", "hidden");
			}
			else
			{
				$("#stage > .Inner").animate({
					opacity : 1
				}, 0);
				$("body").css("overflow", "auto");
			}
		},
		reflectScroll : function()
		{
			var y = ( $( AppConstants.SELECTOR_SCROLLABLE_ELEMENT ).scrollTop() / ($("body").height() - AppModel.get("windowHeight")) );
			var paddingPercentage = parseInt($("#stage").css("padding-top")) / AppModel.get("windowHeight");

			var scrollTop = y * this.$("> .Inner").height();
			scrollTop -= AppModel.get("windowHeight") / 2;

			this.$el.scrollTop( scrollTop );
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