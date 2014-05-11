module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    vars: {
      'cssBanner': '/*\n' +
        'Theme Name: Anarchostar\n' +
        'Theme URI: http://anarchostar.com/\n' +
        'Description: None\n' +
        'Version: 1.0.0\n' +
        'Author: Eric Masiello\n' +
        'Author URI: http://www.synbydesign.com\n' +
        '*/'
    },

    pkg: grunt.file.readJSON('package.json'),
    compass: require('./grunt/compass.js'),
    autoprefixer: require('./grunt/autoprefixer.js'),
    cssmin: require('./grunt/cssmin.js'),
    clean: require('./grunt/clean.js')
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-clean');

  // Default task(s).
  grunt.registerTask('style', ['compass', 'autoprefixer', 'cssmin', 'clean:css']);

  grunt.registerTask('default', ['style']);

};