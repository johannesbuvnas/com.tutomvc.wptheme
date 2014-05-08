define([
  "underscore",
  "backbone",
  "app/view/components/image/ImagePlaceholder",
  "imagesloaded/imagesloaded"
],
function(_, Backbone, ImagePlaceholder, ImagesLoaded)
{
  "use strict";
  var Iframe = Backbone.View.extend({
    _interval : null,
    tagName : "iframe",
    attributes : {
      width: 1100,
      height: 800,
      src : "http://local.tutomvc.com/?preview=true"
    },
    constructor : function(permalink)
    {
      this.attributes.src = permalink + "?preview=true";

      Backbone.View.apply( this );
    },
    initialize : function()
    {
      this.$el.on( "load", _.bind( this.onLoad, this ) );
    },
    isReady : function()
    {
      return !this.$el.contents().find(".ImagePlaceholder").length || Backbone.$(this.$el.contents().find(".ImagePlaceholder")[0]).hasClass("Ready");
    },
    // Events
    onLoad : function(e)
    {
      var _this = this;
      ImagesLoaded( this.$el.contents().find("body"), function()
        {
          _this._interval = setInterval( _.bind( _this.onInterval, _this ), 1000 );
        } );
      // if(this.isReady())
      // {
      //   // this._interval = setInterval( _.bind( this.onInterval, this ), 500 );
      // }
      // else
      // {
      //   this._interval = setInterval( _.bind( this.onInterval, this ), 100 );
      // }
    },
    onInterval : function(e)
    {
      if(this.isReady())
      {
        clearInterval( this._interval );
        this.trigger("ready");
      }
    }
  });

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
    render : function( viewPortHeight )
    {
      this.$el.height( "auto" );
      this.$wrapper.height( "auto" );
      this.$inner.height( "100%" );

      if( this.$el.outerHeight() < viewPortHeight )
      {
        this.$el.height( viewPortHeight );
        this.$wrapper.height( viewPortHeight - parseInt( this.$wrapper.css("padding-top") ) - parseInt( this.$wrapper.css("padding-bottom") ))
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
  },
  {
    Iframe : Iframe
  });

  return ContentBlock;
});
