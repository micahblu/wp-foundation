module.exports = function(grunt) {

	grunt.initConfig({
	
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					style: 'expanded'
				},
				files: {
					'src/assets/stylesheets/style.css': 'src/assets/sass/main.scss',
				}
			}
		},	

		copy: {
			php: {
				expand: true,
				cwd: 'src', 
				src: ['*.php', 'inc/**/*.php'], 
				dest: 'dist/'
			},

			css: {
				expand: true,
				cwd: 'src/assets/stylesheets',
				src: ['style.css'],
				dest: 'dist/'
			},

			modernizr_js: {
				expand: true,
				cwd: 'src/vendors/foundation/js/vendor',
				src: ['modernizr.js'],
				dest: 'dist/js/'
			},

			foundation_js: {
				expand: true,
				cwd: 'src/vendors/foundation/js/',
				src: ['foundation.min.js'],
				dest: 'dist/js/'
			},

			js: {
				expand: true,
				cwd: 'src/assets/',
				src: ['js/**/*.js'],
				dest: 'dist/'
			},

			layouts: {
				expand: true,
				cwd: 'src/assets/',
				src: ['layouts/*.css'],
				dest: 'dist/'
			},

			language: {
				expand: true,
				cwd: 'src',
				src: ['languages/*'],
				dest: 'dist/'
			}
		},

		rsync: {
		    options: {
		        args: ["--verbose"],
		        exclude: [".git*","*.scss","node_modules"],
		        recursive: true
		    },
		    dist: {
		        options: {
		            src: "./dist/",
		            dest: "../wp-foundation/"
		        }
		    },
		    stage: {
		        options: {
		            src: "dist/",
		            dest: "/remote/path",
		            host: "you@site.com",
		            syncDestIgnoreExcl: true
		        }
		    }
		}
	});

	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-rsync');

	grunt.registerTask('default', ['sass', 'copy', 'rsync:dist']);

	grunt.registerTask('deploy', ['rsync:stage']);

};