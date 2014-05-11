module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
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