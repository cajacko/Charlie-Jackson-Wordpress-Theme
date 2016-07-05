var $ = require('jquery');
var activeClass = 'u-active';

function inputFocus(element) {
  $(element).addClass('u-active');
  $(element).find('.Newsletter-input').focus();
}

function inputBlur(element) {
  if (!$(element).find('.Newsletter-input').val()) {
    $(element).removeClass(activeClass);
  }
}

$('.Newsletter-label').click(function() {
  if (!$(this).hasClass(activeClass)) {
    inputFocus($(this).parent());
  }
});

$('.Newsletter-input').blur(function() {
  inputBlur($(this).parent());
});

$('.Newsletter-input').focus(function() {
  inputFocus($(this).parent());
});
