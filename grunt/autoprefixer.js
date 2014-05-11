'use-strict';

module.exports = {
  options: {
    browsers: ['last 2 version', 'ie 9']
  },
  single_file: {
    options: {
      // target-specific options go here
    },
    src: './style.css',
    dest: './style.autoprefix.css'
  }
};