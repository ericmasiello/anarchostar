'use-strict';

module.exports = {
  add_banner: {
    options: {
      banner: '<%= vars.cssBanner %>',
      keepSpecialComments: 0
    },
    files: {
      './style.css': './style.autoprefix.css'
    }
  }
};