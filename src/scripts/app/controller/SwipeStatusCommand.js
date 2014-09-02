define([
	"backbone"
],
function(
	Backbone
)
{
	"use strict";
	var startX = 0;
	var startY = 0;
	var y = 0;
	var x = 0;
	var startProgress = 0;
	var progress = 0;
	var focus = undefined;
	var unfocus = undefined;
	var lockedDirection = undefined;

	function getPositionParam( param, event )
	{
		var val = event[param];
		if(val == undefined)
		{
			if(event.touches && event.touches.length)
			{
				val = event.touches[ 0 ][ "page" + param.toUpperCase() ];
			}
		}

		return val;
	}

	return function(event, phase, direction, distance, duration, fingerCount)
	{
		if(fingerCount < 500) return;
		
		if(phase == "end" || phase == "cancel")
		{
			if(progress == undefined) return;
			if(startProgress < .5 && progress > .25) focus.show(), unfocus.hide();
			else if(progress < .75) focus.hide();

			return;
		}
		// Set startX
		if(phase == "start")
		{
			startX = getPositionParam( "x", event );
			startY = getPositionParam( "y", event );
			startProgress = undefined;
			progress = undefined;
			focus = undefined;
			unfocus = undefined;
			lockedDirection = undefined;

			return;
		}

		if(!lockedDirection)
		{
			if(direction == "right" || direction == "left") lockedDirection = "horizontally";
			else if(direction == "up" || direction == "down") lockedDirection = "vertically";
		}

		// Swiping horizontally
		if((direction == "right" || direction == "left") && lockedDirection == "horizontally")
		{
			x = getPositionParam( "x", event );
			focus = this.stage.header.navigation;
			unfocus = this.stage.header.search;

			if(!startProgress) startProgress = focus.timeline.progress();

			progress = ((x - startX) / (this.stage.header.navigation.$inner.width())) + startProgress;
			if(progress > 1) progress = 1;
			if(progress < 0) progress = 0;

			focus.timeline.paused( true );
			focus.timeline.progress( progress );

			if(unfocus.isVisible())
			{
				unfocus.timeline.paused( true );
				unfocus.timeline.progress( 1 - progress );
			}
		}
		else if((direction == "up" || direction == "down") && lockedDirection == "vertically")
		{
			y = getPositionParam( "y", event );
			focus = this.stage.header.search;
			unfocus = this.stage.header.navigation;

			if(!startProgress) startProgress = focus.timeline.progress();

			progress = ((y - startY) / (Backbone.$(window).height())) + startProgress;
			if(progress > 1) progress = 1;
			if(progress < 0) progress = 0;

			focus.timeline.paused( true );
			focus.timeline.progress( progress );

			if(unfocus.isVisible())
			{
				unfocus.timeline.paused( true );
				unfocus.timeline.progress( 1 - progress );
			}
		}
	};
});