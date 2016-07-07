/**
 * Run the php unit tests
 */
var config = require('../config.json');
var fs = require('fs-extra');

var classNamesIterator = [0];
var characterArray = [];
var classRel = {};

function genCharArray(charA, charZ) {
    var i = charA.charCodeAt(0);
    var j = charZ.charCodeAt(0);

    for (; i <= j; ++i) {
        characterArray.push(String.fromCharCode(i));
    }
}

genCharArray('a', 'z');
genCharArray('A', 'Z');

var characterArrayLength = characterArray.length;

function returnNewName(isClass) {
  var name = '';
  var newIterator = [];
  var iterate = true;

  for (var i = 0; i < classNamesIterator.length; i++) {
    var character = classNamesIterator[i];
    name = characterArray[character] + name;

    var newCharacter = character;

    if (iterate) {
      iterate = false;
      newCharacter++;

      if (newCharacter >= characterArray.length) {
        newCharacter = 0;

        var j = i + 1;

        if (classNamesIterator[j] == null) {
          newIterator.push(0);
        } else {
          iterate = true;
        }
      }
    }

    newIterator.push(newCharacter);
  }

  classNamesIterator = newIterator;
  return name;
}

function isClassInBlackList(className) {
  return false;
}

module.exports = function(gulp) {
  gulp.task(config.gulpTasks.minifyAttrs, function() {
    gulp.src(['./src/views/**/*'])
      .pipe(gulp.dest('./src/views-min'));

    fs.readFile('./src/public/style.min.css', 'utf8', function (err,data) {
      if (err) {
        return console.log(err);
      }

      var re = /\.([a-zA-Z-]+?)(,| |{|:|\+|\>|\.)/g;
      

      var data = data.replace(re, function(match, p1) {
        if (isClassInBlackList(p1)) {
          return match;
        }

        if (!classRel[p1]) {
          var name = returnNewName();
          classRel[p1] = name;
        }

        var replacement = match.replace(p1, classRel[p1]);

        return replacement;
      });

      fs.writeFile('./src/public/style-temp.min.css', data, function(err) {
          if(err) {
              return console.log(err);
          }

          console.log("The file was saved!");
      });
      
    });
  });
};
