define([
	"backbone",
	"jquery",
	"underscore",
	"imagesloaded/imagesloaded"
],
function(Backbone, $, _, ImagesLoaded)
{
	"use strict";
	var Statics = {};
	Statics.READY = "ready";
	Statics.METHOD_STRETCH = function( width, height, imgWidth, imgHeight )
	{
		var diffX = imgWidth / width;
		var diffY = imgHeight / height;
		var ratio;
		if(diffY < diffX)
		{
			ratio = (imgHeight / diffY) / imgHeight;
		}
		else
		{
			ratio = (imgWidth / diffX) / imgWidth;
		}
		return ratio;
	};
	Statics.Model = Backbone.Model.extend({
		defaults : {
			ratio : 0,
			imgWidth : 0,
			imgHeight : 0,
			width : 0,
			height : 0,
			method : Statics.METHOD_STRETCH
		},
		initialize : function()
		{
			this.set( {ratio:this.calculateRatio()} );

			this.on( "change", this.onChange );
		},
		calculateRatio : function()
		{
			return this.get( "method" )( this.get( "width" ), this.get( "height" ), this.get( "imgWidth" ), this.get( "imgHeight" ) );
		},
		calculateImgWidth : function()
		{
			return this.get( "imgWidth" ) * this.get("ratio");
		},
		calculateImgHeight : function()
		{
			return this.get( "imgHeight" ) * this.get("ratio");
		},
		calculatePosX : function()
		{
			var width = this.calculateImgWidth();
			var overflowX = width - this.get("width");

			return 0 - (overflowX / 2);
		},
		calculatePosY : function()
		{
			var height = this.calculateImgHeight();
			var overflowY = height - this.get("height");

			return 0 - (overflowY / 2);
		},
		// EVENTS
		onChange : function()
		{
			if(this.hasChanged('ratio')) return;

			this.set( {ratio:this.calculateRatio()} );
		}
	});

	var ImagePlaceholder = Backbone.View.extend({
		model : new Statics.Model(),
		constructor : function(options)
		{
			Backbone.View.call( this, _.extend(this, options) );
		},
		initialize : function()
		{
			if(this.$el.attr("data-src"))
			{
				this.$el.append( '<img src="'+this.$el.attr("data-src")+'" width="'+this.$el.attr("data-width")+'" height="'+this.$el.attr("data-height")+'" />' );
			}
			else
			{
				this.$el.append( $(_.unescape( this.$("noscript").html() )) );
			}

			ImagesLoaded( this.$el, _.bind( this.onImageLoaded, this ) );
		},
		render : function()
		{
			this.model.set( {
				width : this.$el.outerWidth(),
				height : this.$el.outerHeight(),
				imgWidth : parseInt( this.$("img").attr("width") ) || this.$("img").width(),
				imgHeight : parseInt( this.$("img").attr("height") ) || this.$("img").height()
			} );

			this.$("img").animate( {
				width : this.model.calculateImgWidth(),
				height : this.model.calculateImgHeight(),
				top : this.model.calculatePosY(),
				left : this.model.calculatePosX()
			}, 0, Quint.easeOut );

			return this;
		},
		// EVENTS
		onImageLoaded : function()
		{
			var _this = this;
			this.render();
			this.$("img").css("display", "block");
			this.$el.animate( {autoAlpha: 1}, 300, Power2.easeIn,
			function(){
				_this.trigger( ImagePlaceholder.READY );
			} );

			this.trigger( ImagePlaceholder.READY );
		}
	},
	Statics
	);

	return ImagePlaceholder;
});
