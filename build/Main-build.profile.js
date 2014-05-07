({
	baseUrl : "../src/scripts",
	paths : {
		"requirejs" : "libs/requirejs/require",
		text : "libs/requirejs-text/text",
		"outlayer/outlayer" : "libs/outlayer/outlayer",
		'get-size/get-size' : "libs/get-size/get-size",
		"Masonry" : "libs/masonry/masonry",
		"eventie/eventie" : "libs/eventie/eventie",
		"doc-ready/doc-ready" : "libs/doc-ready/doc-ready",
		"get-style-property/get-style-property" : "libs/get-style-property/get-style-property",
		"outlayer/item" : "libs/outlayer/item",
		"matches-selector/matches-selector" : "libs/matches-selector/matches-selector",
		"eventEmitter/EventEmitter" : "libs/eventEmitter/EventEmitter",
		"imagesloaded/imagesloaded" : "libs/imagesloaded/imagesloaded",
		"modernizr" : "libs/modernizr"
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
				"modernizr"
			]
		}
	},
	map : {
		"*" : {
			jquery : "app/modules/jQuery",
			underscore : "app/modules/underscore",
			backbone : "app/modules/Backbone"
		}
	},
	include : [
		"requirejs",
		"Main.config"
	],
	// optimize : "none",
	out : "../src/scripts/Main.pkgd.js"
})