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
	var Navigation = Backbone.View.extend({
		_timelineProgress : 0,
		initialize : function()
		{
			// Views
			this.$inner = this.$( "> .Inner" );

			// Models
			this.timeline = new TimelineLite({
				onUpdate : _.bind( this.onTimelineUpdate, this )
			});
			this.timeline
				.to( this.$el, 0, {left: "-100%", autoAlpha: 0} )
				.to( $("body"), 0, {overflow:"auto"} )
				.to( this.$el, 0, {left: 0} )
				.to( this.$el, .3, {autoAlpha: 1}, "first" )
				.from( this.$inner, .3, {left: "-100%", ease:Strong.easeOut}, "first" )
				.to( $("body"), 0, {overflow:"hidden"} )
				.paused( true );
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
			this.$el.addClass("PriorityHigh");
		},
		hide : function()
		{
			this.timeline.paused( false );
			this.timeline.reverse();
			this.$el.removeClass("PriorityHigh");
		},
		// Events
		events : {
			"click" : "onClick"
		},
		onClick : function(e)
		{
			if($(e.target).attr("id") == "navigation") this.hide();
		},
		onTimelineUpdate : function()
		{
			if(this._timelineProgress < this.timeline.progress()) this.$el.addClass("PriorityHigh");
			else this.$el.removeClass("PriorityHigh");

			this._timelineProgress = this.timeline.progress();
		}
	});

	return Navigation;
});