module.exports = function(grunt) {
  	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});
  	require('time-grunt')(grunt);
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		banner: '/*\n' +
				'  Theme Name:       <%= pkg.name%>\n' +
				'  Theme URI:        <%= pkg.homepage %>\n' +
				'  Author:           Lacy Morrow\n' +
				'  Author URI:       http://lacymorrow.com\n' +
				'  Description:      <%= pkg.description %>\n' +
				'  Version:          <%= pkg.version%>\n' + 
				'  License:          GNU General Public License v2.0\n' +
				'  License URI:      http://www.gnu.org/licenses/gpl-2.0.html\n' +
				'  Text Domain:      dauid\n' +
				'  Domain Path:      /languages/\n' +
				'  Tags:             responsive-layout, black, white, one-column, fluid-layout, custom-header, custom-menu, editor-style\n' +
				'  GitHub Theme URI: <%= pkg.repository.url %>\n' +
				'  GitHub Branch:    master\n' +
				'  dauid is based on Underscores http://underscores.me/, (C) 2012-2014 Automattic, Inc.\n' + 
				'*/',
		autoprefixer: {
		    options: {
		        browsers: ['> 1%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie 9']
		    },
		    dauid: {
				expand: true,
				flatten: true,
				src: '<%= concat.dauid.dest %>'
		    },
		},
		concat: {
			options: {
				banner: '<%= banner %>\n',
				stripBanners: true
			},
			dauid: {
				src: ['css/style.css', 'src/css/**/*.css'],
				dest: 'css/style.css'
			}
		},
		csscomb: {
			dauid: {
				src: '<%= concat.dauid.dest %>',
				dest: '<%= concat.dauid.dest %>'
			}
		},
		csslint: {
			src: [
				'<%= concat.dauid.dest %>'
			]
		},
		cssmin: {
			dauid: {
				options: {
					banner: '<%= banner %>',
					noAdvanced: true,
					compatibility: 'ie8',
					keepSpecialComments: 0
				},
				files: {
				        'style.css': ['<%= concat.dauid.dest %>'],
				        "rtl.css": ['css/rtl.css']
			        }
			}
		},
		imagemin: {
		    dauid: {
		        files: [{
					expand: true,                  // Enable dynamic expansion
					cwd: 'src/img/',               // Src matches are relative to this path
					src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match
					dest: 'img/'                   // Destination path prefix
				}]
		    }
		},
		jshint: {
			dauid: ['Gruntfile.js', 'src/js/**/*.js', 'js/**/*.js'],
			options: {
				globals: {
					jQuery: true,
					console: true,
					module: true,
					document: true
				}
			}
		},
		less: {
			dauid: {
				files: {
					"css/style.css": ["src/less/style.less"],
					"css/rtl.css": ["src/less/rtl.less"]
				}
			}
		},
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
			},
			dauid: {
				src: 'src/js/**/*.js',
				dest: 'js/main.js'
			}
		},
		watch: {
			options: {
				livereload: true,
			},
		    dauid: {
		    	files: ['Gruntfile.js', 'src/**/*'],
		    	tasks: ['default'],
		    	options: {
		    		nospawn: true
		    	}
		    }, 
		}
	});
	grunt.registerTask('js', [ /* 'jshint', */ 'uglify']);
	grunt.registerTask('css', ['less', 'concat', 'csscomb', /* 'csslint', */ 'autoprefixer', 'cssmin']);
	grunt.registerTask('default', ['css', 'js', 'imagemin']);

};
