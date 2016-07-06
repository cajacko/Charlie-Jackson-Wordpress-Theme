/**
 * Run the php unit tests
 */
var browserify = require('browserify');
var buffer = require('vinyl-buffer');
var config = require('../config.json');
var rename = require('gulp-rename');
var source = require('vinyl-source-stream');
var uglify = require('gulp-uglify');

module.exports = function(gulp) {
  gulp.task(config.gulpTasks.scripts, function() {
    return browserify(config.javascripts.import)
      .bundle()
      .on('error', function(err) {
        console.log(err.message);
        this.emit('end');
      })
      .pipe(source(config.javascripts.main)) //Pass desired output filename to vinyl-source-stream
      .pipe(gulp.dest(config.javascripts.export)) // Output the file
      .pipe(buffer()) // convert from streaming to buffered vinyl file object
      .pipe(rename(config.javascripts.min)) // Rename the minified version
      .pipe(uglify()) // Minify the file
      .pipe(gulp.dest(config.javascripts.export)); // Output the minified file
  });
};
