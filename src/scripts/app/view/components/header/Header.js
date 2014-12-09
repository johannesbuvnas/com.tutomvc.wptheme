define( [
        "jquery",
        "underscore",
        "backbone"
    ],
    function ( $,
               _,
               Backbone,
               Navigation,
               Search )
    {
        "use strict";
        var Header = Backbone.View.extend( {
            initialize: function ()
            {
            },
            render: function ()
            {
                return this;
            },
            events: {
                "click #navButton": "onNavButtonClick",
                "mousedown #siteNavigationOverlay": "onNavButtonClick",
                "click #searchButton": "onSearchButtonClick"
            },
            onNavButtonClick: function ()
            {
                console.log(arguments);
                $( "#stage" ).toggleClass( "StickOutRight" );
                $( "#search" ).toggleClass( "StickOutRight" );

            },
            onSearchButtonClick: function ()
            {
                $( "#search" ).toggleClass( "Hidden" );
            }
        } );

        return Header;
    } );