define( [
        "jquery",
        "jquery-touchswipe",
        "underscore",
        "backbone",
        "app/AppConstants",
        "app/AppRouter",
        "app/controller/SwipeStatusCommand",
        "imagesloaded/imagesloaded"
    ],
    function ( $,
               jQueryTouchSwipe,
               _,
               Backbone,
               AppConstants,
               AppRouter,
               SwipeStatusCommand,
               ImagesLoaded )
    {
        "use strict";
        return function ()
        {
            var app = this;

            function prepModel()
            {
            }

            function prepView()
            {
                prepViewFallbacks();
            }

            function prepViewFallbacks()
            {
                // Input placeholder fallback
                if ( !Modernizr.input.placeholder )
                {
                    $( '[placeholder]' ).focus( function ()
                    {
                        var input = $( this );
                        if ( input.val() == input.attr( 'placeholder' ) )
                        {
                            input.val( '' );
                            input.removeClass( 'placeholder' );
                        }
                    } ).blur( function ()
                    {
                        var input = $( this );
                        if ( input.val() == '' || input.val() == input.attr( 'placeholder' ) )
                        {
                            input.addClass( 'placeholder' );
                            input.val( input.attr( 'placeholder' ) );
                        }
                    } ).blur();
                    $( '[placeholder]' ).parents( 'form' ).submit( function ()
                    {
                        $( this ).find( '[placeholder]' ).each( function ()
                        {
                            var input = $( this );
                            if ( input.val() == input.attr( 'placeholder' ) )
                            {
                                input.val( '' );
                            }
                        } )
                    } );
                }
            }

            function prepController()
            {
                ImagesLoaded( app.$el, _.bind( app.render, app ) );

                // Only touch screens
                if ( Modernizr.touch )
                {
                    // TODO: Swipe disables scroll.
                    // app.$el.swipe( {
                    // 	swipeStatus : _.bind( SwipeStatusCommand, app )
                    // } );
                }
            }

            prepModel();
            prepView();
            prepController();
            Backbone.history.start();
        };
    } );
