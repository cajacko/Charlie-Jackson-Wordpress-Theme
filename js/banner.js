(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);
    $(window).scroll(windowScrollFunction);

    function documentReadyFunction() {
        // functions for document ready
        onPageLoadOrResize();
        onPageLoad();
    }

    function windowResizeFunction() {
        // functions for window resize
        onPageLoadOrResize();
    }

    function onPageLoad() {	
	   	scrollToBlog();
	   	pulseBlogLink();
	   	$('#banner').css('background-image', 'none');
    }
	
    function onPageLoadOrResize () {
	    positionBannerElements();
	    positionNav();
	    imageFillContainer($('#banner-img'));
    }
    
    var lastScrollPos = 0;
    var preventScroll = false;
    
    function windowScrollFunction() {
	    positionNav();
	}
    
    function positionNav() {
	    var scroll = $(window).scrollTop();
	    var bannerHeight = $("#banner").height();

	    if(scroll >= bannerHeight) {
			$('#site-navigation').removeClass('absolute-nav').addClass('fixed-nav'); 
		} else {
			$('#site-navigation').addClass('absolute-nav').removeClass('fixed-nav');
		}
	}
    
    function positionBannerElements() {
	    var windowHeight = $(window).height();
	    var windowWidth = $(window).width();
	    var asideHeight = $("#banner aside").height();
	    var minBannerHeight = parseInt($("#banner").css("min-height"));
	    var bannerMobileBreak = $("#banner").data("banner-mobile-width");
	    
	    if(windowHeight < minBannerHeight) {
		    var asideTop = (minBannerHeight - asideHeight) / 2;
		} else {
	    	var asideTop = (windowHeight - asideHeight) / 2;
	    }
	    
	    if(bannerMobileBreak < windowWidth) {	    
		    $("#banner").height(windowHeight);
		    $("#banner-image-container").height(windowHeight);
		    $("#banner-content-container").height(windowHeight);
		    $("#banner aside").css("bottom", asideTop);
		} else {
			$("#banner").height('auto');
		    $("#banner-image-container").height('auto');
		    $("#banner-content-container").height('auto');
		    $("#banner aside").css("bottom", 'auto');
		}
	}
	
	function scrollToBlog() {
		var hashTagActive = "";
	    $("#go-to-blog").click(function (event) {
	        if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
	            event.preventDefault();
	            //calculate destination place
	            var dest = 0;
	            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
	                dest = $(document).height() - $(window).height();
	            } else {
	                dest = $(this.hash).offset().top;
	            }
	            //go to destination
	            $('html,body').animate({
	                scrollTop: dest
	            }, 500, 'swing', function(){
		            hashTagActive = "";
		        });
	            hashTagActive = this.hash;
	        }
	    });
	}
	
	function pulseBlogLink() {
	    if($('#go-to-blog').css('opacity') == 0.5) {
		 	$( "#go-to-blog" ).animate({
				opacity: 1
			}, 2000, function() {
				pulseBlogLink();
			}); 
		} else {
			$( "#go-to-blog" ).animate({
				opacity: 0.5
			}, 2000, function() {
				pulseBlogLink();
			});
		} 
	}
	
	function imageFillContainer(image) {
		var parent = $(image).parent();
		var parentHeight = $(parent).height();
		var parentWidth = $(parent).width();
		var parentAspectRatio = parentHeight / parentWidth;
		
		var imageHeight = $(image).height();
		var imageWidth = $(image).width();
		var imageAspectRatio = imageHeight / imageWidth;
		
		if(imageAspectRatio > parentAspectRatio) {
			imageHeight = imageAspectRatio * (parentHeight / parentAspectRatio);
			var marginTop = '-' + (imageHeight/2) + 'px';
			
			$(image).css({
				'width' : '100%',
				'height' : 'auto',
				'left' : 0,
				'top' : '50%',
				'margin-top' : marginTop,
				'margin-left' : 'auto',
			});
		} else {
			imageWidth =  parentHeight / imageAspectRatio;
			var marginLeft = '-' + (imageWidth/2) + 'px';
			
			$(image).css({
				'height' : '100%',
				'width' : 'auto',
				'left' : '50%',
				'top' : 0,
				'margin-left' : marginLeft,
				'margin-top' : 'auto',
			});
		}
	}

})(jQuery);