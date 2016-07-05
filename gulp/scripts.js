/**
 * Run the php unit tests
 */
var config = require('../config.json');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var browserSync  = require('browser-sync').create();
var browserify = require('browserify');
var buffer = require('vinyl-buffer');
var source = require('vinyl-source-stream');

module.exports = function(gulp) {
  gulp.task('scripts', function() {
    return browserify('./src/javascripts/import.js')
      .bundle()
      .pipe(source('script.js'))
      .pipe(gulp.dest('./src/public/'))
      .pipe(buffer())
      .pipe(rename('script.min.js'))
      .pipe(uglify()) 
      .pipe(gulp.dest('./src/public/'));
  });
};