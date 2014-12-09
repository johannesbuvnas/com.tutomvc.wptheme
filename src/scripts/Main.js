define( [
        "doc-ready/doc-ready",
        "jquery",
        "underscore",
        "backbone",
        "app/AppConstants",
        "app/AppModel",
        "app/view/components/hentry/Hentry",
        "app/controller/StartUpCommand",
        "bootstrap",
        "ekko-lightbox",
    ],
    function ( DocReady,
               $,
               _,
               Backbone,
               AppConstants,
               AppModel,
               Hentry,
               StartUpCommand,
               bootstrap,
               ekkoLightbox )
    {
        "use strict";

        var AppView = Backbone.View.extend( {
            el: "body",
            _started: false,
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

                // Controllers
                this.on( AppConstants.STARTUP, StartUpCommand );
            },
            startup: function ()
            {
                if ( !this._started ) app.trigger( AppConstants.STARTUP );
            },
            render: function ()
            {
                if ( AppModel.get( "inTransition" ) )
                {
                    return this.listenToOnce( AppModel, "change:inTransition", this.render );
                }

                this.trigger( AppConstants.RENDER );

                return this;
            },
            events: {
                "click .SiteNavigationToggleButton": "onToggleSiteNavigation",
                "click .SiteNavigationOverlay": "onToggleSiteNavigation",
                "click .MainDashboardToggleButton": "onToggleMainDashboard"
            },
            onToggleSiteNavigation: function ()
            {
                $( "body" ).toggleClass( "SiteNavigationOpen" );
            },
            onToggleMainDashboard: function ()
            {
                $( "#main" ).toggleClass( "DashboardOpen" );
            }
        } );

        var app = new AppView;

        return DocReady( function ()
        {
            app.startup();
        } );
    } );
