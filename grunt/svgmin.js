'use-strict';

module.exports = {                                           // Task
  options: {                                      // Configuration that will be passed directly to SVGO
    plugins: [
      { removeViewBox: false },
      { removeUselessStrokeAndFill: true }
    ]
  },
//  dist: {                                         // Target
//    files: {                                    // Dictionary of files
//      'dist/figure.svg': 'app/figure.svg'     // 'destination': 'source'
//    }
//  },
  dist: {                     // Target
    files: [{               // Dictionary of files
      expand: true,       // Enable dynamic expansion.
      cwd: 'images/',     // Src matches are relative to this path.
      src: ['**/*.svg'],  // Actual pattern(s) to match.
      dest: 'images/',       // Destination path prefix.
      ext: '.min.svg'     // Dest filepaths will have this extension.
      // ie: optimise img/src/branding/logo.svg and store it in img/branding/logo.min.svg
    }]
  }
};