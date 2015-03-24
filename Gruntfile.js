module.exports = function( grunt ) {

	'use strict';

	var banner = '/**\n * MPH Starter\n * http://matth.eu\n *\n * Copyright (c) 2013 Matthew Haines-Young (@matth_eu)\n */\n';

	var themeScripts = [
		'assets/js/vendor/flexslider/jquery.flexslider.js',
		'assets/js/vendor/fitvids/jquery.fitvids.js',
		'assets/js/src/theme.js'
	];

	// Load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Project configuration
	grunt.initConfig( {

		pkg:    grunt.file.readJSON( 'package.json' ),

		// JS Minification & Concatenation
		uglify: {

			dev: {
				options: {
					preserveComments: true,
					sourceMap: function( dest ) { return dest + '.map' },
					sourceMappingURL: function( dest ) { return dest.replace(/^.*[\\\/]/, '') + '.map' },
					sourceMapRoot: '/',
					beautify: true,
					mangle: false
				},
				files: {
					'assets/js/theme.js': themeScripts
				}
			},

			prod: {
				options: {
					preserveComments: false,
					banner: banner,
					mangle: { except: ['jQuery'] }
				},
				files: {
					'assets/js/theme.js': themeScripts
				}
			}

		},

		compass: {
			prod: {
				options: {
					sassDir: 'assets/css/sass',
					cssDir: 'assets/css',
					environment: 'production'
				}
			},
			dev: {
				options: {
					sassDir: 'assets/css/sass',
					cssDir: 'assets/css',
				}
			}
		},

		pixrem: {
    		options: {
      			rootvalue: '16px'
    		},
			dist: {
				src: 'assets/css/theme.css',
				dest: 'assets/css/theme.css'
			}
		},

		// Watch for changes
		watch:  {

			sass: {
				files: ['assets/css/*/**/*.scss'],
				tasks: ['compass', 'pixrem'],
				options: {
					debounceDelay: 500,
					livereload: true
				}
			},

			scripts: {
				files: ['assets/js/*/**/*.js'],
				tasks: ['uglify'],
				options: {
					debounceDelay: 500
				}
			}

		}

	} );

	// Default task.

	grunt.registerTask( 'default', ['uglify:prod', 'compass:prod', 'pixrem'] );
	grunt.registerTask( 'dev', ['uglify:dev', 'compass:dev', 'pixrem'] );


	grunt.util.linefeed = '\n';

};