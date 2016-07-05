var $ = global.jquery  = require('jquery');
var animating = {};
var duration = 500;

function isAnimating(element) {
  var id = $(element).attr('id');

  if (animating[id]) {
    return true;
  } else {
    return false;
  }
}

function isCloseIcon(element) {
  if ($(element).hasClass('u-closeIcon')) {
    return true;
  } else {
    return false;
  }
}

function setAnimationStatus(element, status) {
  var id = $(element).attr('id');
  animating[id] = status;
}

function translateLinesToMiddle(topLine, middleLine, bottomLine, next) {
  $(topLine).animate({
    top: '11px'
  });

  $(bottomLine).animate({
    top: '11px'
  }, function() {
    $(middleLine).hide();
    if (next) {
      next(topLine, middleLine, bottomLine);
    }
  });
}

var rotateBy = 45;

function rotateElement(element, start, end, next) {
  console.log(element, start, end, next, duration);

  $(element).velocity({
    rotateZ: "45deg"
  });
}

function middleToClose(topLine, middleLine, bottomLine, next) {
  $(middleLine).hide();
  rotateElement(topLine, 0, rotateBy, function() {
    console.log('hihoi');
  });
}

function closeIcon(element, topLine, middleLine, bottomLine) {
  setAnimationStatus(element, true);

  // translateLinesToMiddle(topLine, middleLine, bottomLine, function(topLine, middleLine, bottomLine) {
  //   console.log('next');
  //   middleToClose(topLine, middleLine, bottomLine);
  // });

  $(topLine).animate({
    top: '11px'
  });

  $(bottomLine).animate({
    top: '11px'
  }, function() {
    $(middleLine).hide();

    $(topLine).rotate({
      endDeg:45, 
      duration:0.25, 
      persist:true,
      complete: function() {
        console.log('hello');
      }
    });

    $(bottomLine).rotate({
      endDeg: -45, 
      duration: 0.25, 
      persist: true,
      complete: function() {
        console.log('hello');
      }
    });
  });
}

$(document).ready(function() {
  $('.MenuIcon').click(function() {
    // var icon = $(this);
    // var topLine = $('#MenuIcon-topLine');
    // var middleLine = $('#MenuIcon-middleLine');
    // var bottomLine = $('#MenuIcon-bottomLine');
    $('#SiteNavigation').toggleClass('u-menuActive');
    $('.SiteNavigation-menu').slideToggle(500);

    // if (isAnimating(icon)) {
    //   return false;
    // } else if (isCloseIcon(icon)) {
    //   barsIcon(icon, topLine, middleLine, bottomLine);
    // } else {
    //   closeIcon(icon, topLine, middleLine, bottomLine);
    // }
  });
});


/*
jQuery-Rotate-Plugin v0.2 by anatol.at
http://jsfiddle.net/Anatol/T6kDR/
*/
$.fn.rotate=function(options) {
  var $this=$(this), prefixes, opts, wait4css=0;
  prefixes=['-Webkit-', '-Moz-', '-O-', '-ms-', ''];
  opts=$.extend({
    startDeg: false,
    endDeg: 360,
    duration: 1,
    count: 1,
    easing: 'linear',
    animate: {},
    forceJS: false,
    complete: options.complete
  }, options);

  function supports(prop) {
    var can=false, style=document.createElement('div').style;
    $.each(prefixes, function(i, prefix) {
      if (style[prefix.replace(/\-/g, '')+prop]==='') {
        can=true;
      }
    });
    return can;
  }

  function prefixed(prop, value) {
    var css={};
    if (!supports.transform) {
      return css;
    }
    $.each(prefixes, function(i, prefix) {
      css[prefix.toLowerCase()+prop]=value || '';
    });
    return css;
  }

  function generateFilter(deg) {
    var rot, cos, sin, matrix;
    if (supports.transform) {
      return '';
    }
    rot=deg>=0 ? Math.PI*deg/180 : Math.PI*(360+deg)/180;
    cos=Math.cos(rot);
    sin=Math.sin(rot);
    matrix='M11='+cos+',M12='+(-sin)+',M21='+sin+',M22='+cos+',SizingMethod="auto expand"';
    return 'progid:DXImageTransform.Microsoft.Matrix('+matrix+')';
  }

  supports.transform=supports('Transform');
  supports.transition=supports('Transition');

  opts.endDeg*=opts.count;
  opts.duration*=opts.count;

  if (supports.transition && !opts.forceJS) { // CSS-Transition
    if ((/Firefox/).test(navigator.userAgent)) {
      wait4css=(!options||!options.animate)&&(opts.startDeg===false||opts.startDeg>=0)?0:25;
    }
    $this.queue(function(next) {
      if (opts.startDeg!==false) {
        $this.css(prefixed('transform', 'rotate('+opts.startDeg+'deg)'));
      }
      setTimeout(function() {
        $this
          .css(prefixed('transition', 'all '+opts.duration+'s '+opts.easing))
          .css(prefixed('transform', 'rotate('+opts.endDeg+'deg)'))
          .css(opts.animate);
      }, wait4css);

      setTimeout(function() {
        $this.css(prefixed('transition'));
        if (!opts.persist) {
          $this.css(prefixed('transform'));
        }
        next();
      }, (opts.duration*1000)-wait4css);
    });

  } else { // JavaScript-Animation + filter
    if (opts.startDeg===false) {
      opts.startDeg=$this.data('rotated') || 0;
    }
    opts.animate.perc=100;

    $this.animate(opts.animate, {
      duration: opts.duration*1000,
      easing: $.easing[opts.easing] ? opts.easing : '',
      step: function(perc, fx) {
        var deg;
        if (fx.prop==='perc') {
          deg=opts.startDeg+(opts.endDeg-opts.startDeg)*perc/100;
          $this
            .css(prefixed('transform', 'rotate('+deg+'deg)'))
            .css('filter', generateFilter(deg));
        }
      },
      complete: function() {
        if (opts.persist) {
          while (opts.endDeg>=360) {
            opts.endDeg-=360;
          }
        } else {
          opts.endDeg=0;
          $this.css(prefixed('transform'));
        }
        $this.css('perc', 0).data('rotated', opts.endDeg);

        if (opts.complete) {
          complete();
        }
      }
    });
  }

  return $this;
};