define([
	"jquery",
	"underscore",
	"backbone"
],
function(
	$,
	_,
	Backbone
)
{
	"use strict";
	var Search = Backbone.View.extend({
		_timelineProgress : 0,
		initialize : function(options)
		{
			// Views
			this.$inner = this.$( "> .Inner" );
			this.$toggleButton = $("#header #searchButton");

			// Models
			this.timeline = new TimelineLite({
				onUpdate : _.bind( this.onTimelineUpdate, this )
			});
			if(this.$el.hasClass("Hidden"))
			{
				this.timeline
					.to( this.$el, 0, {top:"-100%"} )
					.to( $("body"), 0, {overflow:"auto"} )
					.to( this.$el, 0.3, {top:"0%", ease:Power4.easeOut} )
					.to( $("body"), 0, {overflow:"hidden"} )
					.paused( true );
			}
			// else
			// {
			// 	this.timeline
			// 		.to( this.$el, 0, {top:"100%"} )
			// 		.paused( true );
			// }
		},
		toggle : function()
		{
			if(this.timeline.progress() > .5) this.hide();
			else this.show();
		},
		isVisible : function()
		{
			return this.timeline.progress() > 0;
		},
		show : function()
		{
			this.timeline.paused( false );
			this.timeline.play();

			if(this.$toggleButton.find(".genericon").hasClass("genericon-search"))
			{
				this.$toggleButton.find(".genericon").removeClass("genericon-search");
				this.$toggleButton.find(".genericon").addClass("genericon-close");
			}

			this.$( "input[type=search]" ).focus();
		},
		hide : function()
		{
			this.timeline.paused( false );
			this.timeline.reverse();

			if(this.$toggleButton.find(".genericon").hasClass("genericon-close"))
			{
				this.$toggleButton.find(".genericon").addClass("genericon-search");
				this.$toggleButton.find(".genericon").removeClass("genericon-close");
			}
		},
		// Events
		onTimelineUpdate : function()
		{
			if(this._timelineProgress < this.timeline.progress())
			{
				this.$el.addClass("PriorityHigh");
				
			}
			else
			{
				this.$el.removeClass("PriorityHigh");
			}

			this._timelineProgress = this.timeline.progress();
		}
	});

	return Search;
});