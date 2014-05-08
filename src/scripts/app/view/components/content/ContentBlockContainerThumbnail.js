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
			"class" : "ContentBlockContainerThumbnail"
		},
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
			else if(this.model.get("src"))
			{
				this.$el.html( this.template( this.model.toJSON() ) );
			}
		},
		draw : function()
		{
			// TODO: Check if canvas is supported, else fallback
			var _this = this;
			html2canvas( this.iframe.$el.contents().find(".ContentBlock").first().find("> .Wrapper > .Inner"), {
				onrendered: function(canvas)
				{
					_this.$el.html("");

					// Make an extra canvas to make it a thumbnail
					var extra_canvas = document.createElement("canvas");
					extra_canvas.setAttribute('width',106);
					extra_canvas.setAttribute('height',75);
					
					var ctx = extra_canvas.getContext('2d');
					ctx.drawImage(canvas,0,0,canvas.width, canvas.height,0,0,106,75);
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