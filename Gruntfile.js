module.exports = function( grunt ) {

	'use strict';

	var banner = '/**\n * MPH Starter\n * http://matth.eu\n *\n * Copyright (c) 2013 Matthew Haines-Young (@matth_eu)\n */\n';

	var themeScripts = [
		'assets/js/vendor/flexslider.min.js',
		'assets/js/src/functions.js', 
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
					beautify: true
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

		
		// Compile SASS
		sass: {

			dev: {
				files: {
					'assets/css/theme.css' : 'assets/css/sass/theme.scss'
				}
			}

		},

		// Minify CSS
		cssmin: {

			theme: {

				options: {
					banner: banner
				},

				files: {
					'assets/css/theme.min.css': ['assets/css/theme.css']
				}

			}

		},
		

		// Watch for changes
		watch:  {

			sass: {
				files: ['assets/css/*/**/*.scss'],
				tasks: ['sass'],
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
	
	grunt.registerTask( 'default', ['uglify', 'sass', 'cssmin'] );
	

	grunt.util.linefeed = '\n';

};