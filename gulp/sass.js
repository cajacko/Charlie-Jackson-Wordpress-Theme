/**
 * Run the php unit tests
 */
var config = require('../config.json');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var minifyCss  = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');

module.exports = function(gulp) {
  gulp.task(config.gulpTasks.sass, function () {
    gulp.src('./src/sass/*.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(autoprefixer({
        browsers: ['last 2 version', "> 1%", 'ie 8', 'ie 9'],
        cascade: false
      }))
      .pipe(rename({basename: 'style'}))
      .pipe(gulp.dest('./src/public/'));

    return gulp.src('./src/sass/*.scss')
      .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
      .pipe(autoprefixer({
        browsers: ['last 2 version', "> 1%", 'ie 8', 'ie 9'],
        cascade: false
      }))
      .pipe(rename({basename: 'style.min'}))
      .pipe(gulp.dest('./src/public/'));
  });
};
