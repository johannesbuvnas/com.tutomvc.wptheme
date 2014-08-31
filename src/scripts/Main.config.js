require.config({
	baseUrl : AppFacade.getURL( "src/scripts" ),
	urlArgs : AppFacade.isProduction ? "v=" + AppFacade.version : "v=" + (new Date()).getTime(),
	paths : {
	  "requirejs" : "../../lib/script/requirejs/require",
	  "text" : "../../lib/script/requirejs-text/text",
	  "outlayer/outlayer" : "../../lib/script/outlayer/outlayer",
	  'get-size/get-size' : "../../lib/script/get-size/get-size",
	  "Masonry" : "../../lib/script/masonry/masonry",
	  "eventie/eventie" : "../../lib/script/eventie/eventie",
	  "doc-ready/doc-ready" : "../../lib/script/doc-ready/doc-ready",
	  "get-style-property/get-style-property" : "../../lib/script/get-style-property/get-style-property",
	  "outlayer/item" : "../../lib/script/outlayer/item",
	  "matches-selector/matches-selector" : "../../lib/script/matches-selector/matches-selector",
	  "eventEmitter/EventEmitter" : "../../lib/script/eventEmitter/EventEmitter",
	  "imagesloaded/imagesloaded" : "../../lib/script/imagesloaded/imagesloaded",
	  "jquery-easytabs" : "../../lib/script/jquery-easytabs/lib/jquery.easytabs",
	  "jquery-touchswipe" : "../../lib/script/jquery-touchswipe/jquery.touchSwipe",
	  "html2canvas" : "../../lib/script/html2canvas/build/html2canvas",
	  "bootstrap" : "../../lib/script/bootstrap/dist/js/bootstrap",
	  "tweenmax" : "../../lib/script/gsap/src/uncompressed/TweenMax",
	  "timelinelite" : "../../lib/script/gsap/src/uncompressed/TimelineLite",
	  "TweenLite" : "../../lib/script/gsap/src/uncompressed/TweenLite"
	},
	shim : {
	  backbone : {
	    deps : [
	      "jquery",
	      "underscore"
	    ]
	  },
	  "Main" : {
	    deps : [
	      "backbone",
	      "modernizr",
	      "html2canvas"
	    ]
	  }
	},
	map : {
	  "app/modules/Backbone" : {
	    "backbone" : "../../lib/script/backbone/backbone"
	  },
	  "app/modules/jQuery" : {
	    "jquery" : "../../lib/script/jquery/jquery"
	  },
	  "app/modules/underscore" : {
	    "underscore" : "../../lib/script/underscore/underscore"
	  },
	  "*" : {
	    "jquery" : "app/modules/jQuery",
	    "underscore" : "app/modules/underscore",
	    "backbone" : "app/modules/Backbone"
	  },
	}
});

require(["Main"]);