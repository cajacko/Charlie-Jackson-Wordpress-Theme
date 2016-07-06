/**
 * Run the php unit tests
 */
var config = require('../config.json');

module.exports = function(gulp) {
  gulp.task(config.gulpTasks.watch, function() {
    gulp.watch([config.styles.files], [config.gulpTasks.sass]);
    gulp.watch([config.javascripts.files], [config.gulpTasks.scripts]);
  });
};
