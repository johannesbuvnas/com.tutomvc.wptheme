define([
	"jquery",
	"backbone",
	"app/view/components/content/ContentBlock",
	"app/AppConstants"
],
function($, Backbone, ContentBlock, AppConstants)
{
	"use strict";
	var ContentBlockContainerThumbnail = Backbone.View.extend({
		attributes : {
			"class" : "ContentBlockContainerThumbnail"
		},
		iframe : null,
		initialize : function()
		{
		},
		render : function( contentBlockContainer )
		{
			this.$el.html("");
			var _this = this;

			this.iframe = new ContentBlock.Iframe( contentBlockContainer.$el.attr("data-permalink") );
			this.listenTo( this.iframe, "ready", this.draw );
			this.$el.append( this.iframe.$el );
		},
		draw : function()
		{
			var _this = this;
			html2canvas( this.iframe.$el.contents().find(".ContentBlock").first().find("> .Wrapper > .Inner"), {
				onrendered: function(canvas)
				{
					// return;
					_this.$el.html("");

					var extra_canvas = document.createElement("canvas");
					extra_canvas.setAttribute('width',106);
					extra_canvas.setAttribute('height',75);
					
					var ctx = extra_canvas.getContext('2d');
					ctx.drawImage(canvas,0,0,canvas.width, canvas.height,0,0,106,75);
					var dataURL = extra_canvas.toDataURL();
					var img = $(document.createElement('img'));
					img.attr('src', dataURL);
					var $el = $("<div class='Inner'></div>").append(img);

					_this.$el.append( $el );
				}
			} );
		}
	});

	return ContentBlockContainerThumbnail;
});