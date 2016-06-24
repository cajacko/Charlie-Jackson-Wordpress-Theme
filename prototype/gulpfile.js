var gulp = require('gulp');
var sass = require('gulp-sass');
var rename = require('gulp-rename');
var minifyCss  = require('gulp-minify-css');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync').create();
var reload = browserSync.reload;
var browserify = require('browserify');
var buffer = require('vinyl-buffer');
var source = require('vinyl-source-stream');

gulp.task('sass', function () {
  gulp.src('./sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 version', "> 1%", 'ie 8', 'ie 9'],
      cascade: false
    }))
    .pipe(rename({basename: 'style'}))
    .pipe(gulp.dest('./public/'))
    .pipe(browserSync.stream());

  return gulp.src('./sass/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 version', "> 1%", 'ie 8', 'ie 9'],
      cascade: false
    }))
    .pipe(rename({basename: 'style.min'}))
    .pipe(gulp.dest('./public/'))
    .pipe(browserSync.stream());
});

gulp.task('scripts', function() {
  return browserify('./javascripts/import.js')
    .bundle()
    .pipe(source('script.js'))
    .pipe(gulp.dest('./public/'))
    .pipe(buffer())
    .pipe(rename('script.min.js'))
    .pipe(uglify()) 
    .pipe(gulp.dest('./public/'));
});

gulp.task('serve', ['sass', 'scripts','watch'], function() {
  browserSync.init({
    proxy: 'http://prototype.charlie-jackson.local.com:81',
    ghostMode: {
      clicks: false,
      forms: false,
      scroll: false
    },
    reloadOnRestart: true
  });
});

gulp.task('watch', function() {
  gulp.watch('./sass/*.scss', ['sass']);
  gulp.watch(['./javascripts/**/*.js'], ['scripts']);
  gulp.watch(['./layouts/**/*.twig', './sublayouts/**/*.twig', './public/**/*.php']).on('change', reload);
  gulp.watch('./public/script.js').on('change', reload);
});

// Default task
gulp.task('default', ['serve']);
