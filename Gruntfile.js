'use strict'
module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    // uglify
    uglify: {
      options: {
        banner: '/*! skafora 1.0.0 by Jamaludin Rajalu <%= grunt.template.today("yyyy-mm-dd") %> */\n'
      },
      build: {
        src: [
        'js/script.js'
      ],
        dest: 'js/script.min.js'
      }
    },
    // compass
    compass: {
      dist: { 
        options: { 
          sassDir: 'scss',
          cssDir: '.',
          environment: 'production',
          outputStyle: 'compressed'
        }
      }
    },
    // watch
    watch: {
      configFiles: {
        files: ['Gruntfile.js']
      },
      css: {
        files: [
          'scss/style.scss',
          'scss/*.scss'
        ],
        tasks: ['compass'],
          options: {
            livereload: true
          }
      },
      js: {
        files: ['js/script.js'],
        tasks: ['uglify'],
          options: {
            spawn: false
          }
      }
    } 

  }); // closing task

  // load grunt task

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('default', 'watch');

};