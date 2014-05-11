'use-strict';

module.exports = {
  add_banner: {
    options: {
      banner: '/* Eric Masiello */',
      keepSpecialComments: 0
    },
    files: {
      './css/main.min.css': './css/main.autoprefix.css'
    }
  }
};