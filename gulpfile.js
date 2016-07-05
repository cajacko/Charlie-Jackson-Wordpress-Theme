var gulp = require('gulp');
var fs = require('fs');

// Run phpunit tests
require('./gulp/phpunit')(gulp);

// Run Javascript codesniffer to check code styling
require('./gulp/phpcs')(gulp);

// Run Javascript codesniffer to check code styling
require('./gulp/sass')(gulp);

// Run Javascript codesniffer to check code styling
require('./gulp/scripts')(gulp);

// The default gulp task
require('./gulp/default')(gulp);
