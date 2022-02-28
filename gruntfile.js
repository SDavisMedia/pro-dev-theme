module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		// combine all JS scr files into a single theme JS file
		concat: {
			main: {
				options: {
					separator: ';'
				},
				src: ['src/js/**/*.js'],
				dest: 'includes/assets/js/<%= pkg.name %>.js'
			}
		},

		// now take that theme JS file and make an uglier version of it
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

		// turn all SCSS into a single theme CSS file
		sass: {
			default: {
				files: {
					"style.css" : "src/scss/style.scss",
				}
			}
		},

		// actively watch all src files ... run the above tasks if any of them are modified
		watch: {
			css: {
				files: 'src/scss/**/*.scss',
				tasks: ['sass']
			},
			js: {
				files: ['src/js/**/*.js', 'src/js/<%= pkg.name %>.js'],
				tasks: ['concat:main', 'uglify:js'],
			},
		},
	});

	// saves having to declare each dependency
	require( "matchdep" ).filterDev( "grunt-*" ).forEach( grunt.loadNpmTasks );

	// run 'grunt watch' while working to do this all on the fly
	grunt.registerTask( 'default', [ 'concat', 'uglify', 'sass' ] );
};