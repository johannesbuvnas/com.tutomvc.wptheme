define([
	"jquery",
	"underscore",
	"backbone",
	"app/view/components/content/ContentBlock",
	"app/AppConstants",
	"text!app/view/components/content/ContentBlockContainerThumbnail.tpl.html"
],
function($, _, Backbone, ContentBlock, AppConstants, HTML)
{
	"use strict";
	var ContentBlockContainerThumbnail = Backbone.View.extend({
		attributes : {
			"class" : "ContentBlockContainerThumbnail",
			"href" : "#"
		},
		tagName : "a",
		template : _.template( HTML ),
		iframe : null,
		initialize : function()
		{
			this.model = new Backbone.Model({
				defaults : {
					src : null,
					postID : null,
					permalink : null
				}
			});
			this.$el.html( this.template( this.model.toJSON() ) );
		},
		render : function()
		{
			if(!this.model.get("src") && this.model.get("postID") && this.model.get("permalink"))
			{
				var _this = this;
				this.iframe = new ContentBlock.Iframe( this.model.get("permalink") );
				this.listenTo( this.iframe, "ready", this.draw );
				this.$el.append( this.iframe.$el );
			}
			else
			{
				this.$el.html( this.template( this.model.toJSON() ) );
			}
		},
		draw : function()
		{
			// TODO: Check if canvas is supported, else fallback
			var _this = this;
			var html = this.iframe.$el.contents().find(".ContentBlock").first().find("> .Wrapper > .Inner");
			html2canvas( html, {
				onrendered: function(canvas)
				{
					var width = html.outerWidth();
					var height = html.outerHeight();
					_this.$el.html("");

					// Make an extra canvas to make it a thumbnail
					var extra_canvas = document.createElement("canvas");
					extra_canvas.setAttribute( 'width', width / 10 );
					extra_canvas.setAttribute( 'height', height / 10 );
					
					var ctx = extra_canvas.getContext('2d');
					ctx.drawImage( canvas, 0, 0,canvas.width, canvas.height, 0, 0, width / 10, height / 10 );
					var dataURL = extra_canvas.toDataURL();

					_this.model.set({
						src : dataURL
					});
					_this.render();

					// Now we save this in the media library so we don't need to generate it all the time
					_this.saveCanvasAsThumbnail( dataURL, _this.model.get("postID") );
				}
			} );
		},
		saveCanvasAsThumbnail : function( canvasData, postID )
		{
			Backbone.ajax({
				type : "post",
				url : AppFacade.ajaxURL,
				dataType : "json",
				data : {
					nonce : AppFacade.nonce,
					action : AppFacade.ajaxCommands[0],
					postID : postID,
					canvasData : canvasData
				},
				success : function(e)
				{
					console.log(e);
				},
				error : function(e)
				{
					console.log(e);
				}
			});
		}
	});

	return ContentBlockContainerThumbnail;
});