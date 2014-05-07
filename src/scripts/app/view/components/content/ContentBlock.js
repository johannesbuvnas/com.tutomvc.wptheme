define([
  "backbone",
  "app/AppModel",
  "app/view/components/image/ImagePlaceholder"
],
function(Backbone, AppModel, ImagePlaceholder)
{
  "use strict";
  var ContentBlock = Backbone.View.extend({
    initialize : function()
    {
      this.$wrapper = this.$( "> .Wrapper" );
      this.$inner = this.$( "> .Wrapper > .Inner" );

      if(this.$( "> .Wrapper > .Inner > .BackgroundImage" ).length)
      {
        this.backgroundImage = new ImagePlaceholder({
          el : this.$( "> .Wrapper > .Inner > .BackgroundImage" )
        });
      }
    },
    render : function()
    {
      this.$el.height( "auto" );
      this.$wrapper.height( "auto" );
      this.$inner.height( "100%" );

      if( this.$el.outerHeight() < AppModel.getViewPortHeight() )
      {
        this.$el.height( AppModel.getViewPortHeight() );
        this.$wrapper.height( AppModel.getViewPortHeight() - parseInt( this.$wrapper.css("padding-top") ) - parseInt( this.$wrapper.css("padding-bottom") ))
        this.$inner.height( parseInt( this.$wrapper.height() ) - parseInt( this.$inner.css("padding-top") ) - parseInt( this.$inner.css("padding-bottom") ))
      }

      if(this.backgroundImage)
      {
        this.backgroundImage.$el.width( this.$inner.outerWidth() );
        this.backgroundImage.$el.height( this.$inner.outerHeight() );
        this.backgroundImage.render();
      }

      return this;
    }
  });

  return ContentBlock;
});
