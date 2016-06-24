/**
 * Run the php unit tests
 */
var config = require('../config.json');
var exec = require('child_process').exec;

module.exports = function(gulp) {
  var phpTestDir = config.tests.dirs.php;
  var phpTestAutoload = config.tests.phpAutoload;

  gulp.task(config.gulpTasks.phpunit, function() {
    exec('php ./vendor/phpunit/phpunit/phpunit --bootstrap ' + phpTestAutoload + ' --colors=always ' + phpTestDir, function(error, stdout) {
      console.log(stdout);
    });
  });
};
