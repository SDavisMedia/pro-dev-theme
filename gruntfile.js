module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		// concat
		concat: {
			main: {
				options: {
					separator: ';'
				},
				src: ['includes/assets/js/src/**/*.js'],
				dest: 'includes/assets/js/<%= pkg.name %>.js'
			}
		},

		// uglify
		uglify: {
			options: {
				mangle: false
			},
			js: {
				files: {
					'includes/assets/js/<%= pkg.name %>.min.js': ['includes/assets/js/<%= pkg.name %>.js']
				}
			}
		},

		sass: {
			default: {
				files: {
					"style.css" : "includes/assets/scss/style.scss",
				}
			}
		},

		// watch
		watch: {
			css: {
				files: 'includes/assets/scss/**/*.scss',
				tasks: ['sass']
			},
			js: {
				files: ['includes/assets/js/**/*.js', 'includes/assets/js/<%= pkg.name %>.js'],
				tasks: ['concat:main', 'uglify:js'],
			},
		},
	});

	// Saves having to declare each dependency
	require( "matchdep" ).filterDev( "grunt-*" ).forEach( grunt.loadNpmTasks );

	grunt.registerTask( 'default', [ 'concat', 'uglify', 'sass' ] );

};