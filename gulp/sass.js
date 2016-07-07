/**
 * Run the php unit tests
 */
var autoprefixer = require('gulp-autoprefixer');
var config = require('../config.json');
var cleanCSS = require('gulp-clean-css');
var rename = require('gulp-rename');
var sass = require('gulp-sass');

module.exports = function(gulp) {
  gulp.task(config.gulpTasks.sass, function() {
    var stylesExport = config.styles.export;

    return gulp.src(config.styles.import)
      .pipe(sass().on('error', sass.logError))
      .pipe(rename(config.styles.main))
      .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      }))
      .pipe(gulp.dest(stylesExport))
      .pipe(rename(config.styles.min))
      .pipe(cleanCSS())
      .pipe(gulp.dest(stylesExport));
  });
};
