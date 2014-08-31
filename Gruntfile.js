module.exports = function(grunt)
{
  "use strict";
  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON( 'package.json' ),
    banner: '/**\n' +
            '*  Theme Name: Tuto MVC\n' +
            '*  Text Domain: <%= pkg.name %>\n' +
            '*/\n',
    less: {
      compile : {
          options: {
            rootpath : "src/less/"
          },
          files: {
            "style.css": "src/less/style.less"
          }
        }
    },
    requirejs : {
      "compile-js" : {
        options : {
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
          },
          "baseUrl" : "src/scripts",
          "include" : [
            "requirejs",
            "Main.config"
          ],
          // optimize : "none",
          "out" : "script.min.js"
        }
      },
      "minify-css" : {
        options : {
          cssIn : "style.css",
          out : "style.min.css",
          // optimizeCss: "standard.keepLines.keepWhitespace"
          optimizeCss: "standard"
        }
      }
    },
    usebanner: {
      options: {
        position: 'top',
        banner: '<%= banner %>'
      },
      files: {
        src: ["style.css"]
      }
    },
    watch: {
      scripts: {
        files: ['src/scripts/**/*.js'],
        tasks: ['dist-js']
      },
      less: {
        files : ['src/less/**/*.less'],
        tasks: ['dist-css']
      }
    }
  });

  // Load npm tasks
  grunt.loadNpmTasks( 'grunt-contrib-less' );
  grunt.loadNpmTasks( 'grunt-banner' );
  grunt.loadNpmTasks( 'grunt-requirejs' );
  grunt.loadNpmTasks( 'grunt-contrib-watch' );

  // All CSS tasks
  grunt.registerTask( 'dist-css', ['less:compile', 'requirejs:minify-css', 'usebanner'] );
  // All JS tasks
  grunt.registerTask( 'dist-js', ['requirejs:compile-js'] );

  // All dist tasks
  grunt.registerTask('dist', ['dist-css', 'dist-js']);
  // DEFAULT
  grunt.registerTask( 'default', ['dist'] );
};