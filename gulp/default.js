var config = require('../config.json');

module.exports = function(gulp) {
  gulp.task('default',[config.gulpTasks.phpcs, config.gulpTasks.phpunit]);
};
