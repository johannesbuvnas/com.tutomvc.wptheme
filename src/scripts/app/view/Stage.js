define( [
        "jquery",
        "underscore",
        "backbone",
        "app/AppConstants",
        "app/view/components/hentry/Hentry"
    ],
    function ( $,
               _,
               Backbone,
               AppConstants,
               Hentry )
    {
        "use strict";
        var Stage = Backbone.View.extend( {
            initialize: function ()
            {
                // Views
                Hentry.autoInstance( this.$el );

                this.$( ".JSLink" ).click( function ( e )
                {
                    e.preventDefault();
                    var link = $( e.currentTarget ).attr( "href" );
                    location.href = link;
                } );

                this.$( ".nav-tabs a" ).click( function ( e )
                {
                    var link = $( e.currentTarget ).attr( "href" );

                    if ( link && link.slice( 0, 1 ) == "#" )
                    {
                        e.preventDefault();
                        // if(!$(this).parent().hasClass("active")) $(this).tab('show');
                        $( this ).tab( 'show' );
                    }
                    else if ( $( e.target ).hasClass( "JSLink" ) )
                    {
                        e.preventDefault();
                    }
                } );
                this.$( '*[data-toggle="lightbox"]' ).click( function ( e )
                {
                    e.preventDefault();
                    $( e.currentTarget ).ekkoLightbox();
                } );
                var i = 0;
                this.$( '.modal.auto-open' ).each( function ()
                {
                    i++;
                    if ( i == 1 )
                    {
                        $( this ).modal( "show" );
                    }
                } );
            },
            events: {
                "click #navButton": "onNavButtonClick",
                "click #siteNavigationOverlay": "onNavButtonClick",
                "click #searchButton": "onSearchButtonClick"
            },
            onNavButtonClick: function ()
            {
                $( "body" ).toggleClass( "SiteNavigationOpen" );
            },
            onSearchButtonClick: function ()
            {
                $( "body" ).toggleClass( "SearchOpen" );
            }
        } );

        return Stage;
    } );