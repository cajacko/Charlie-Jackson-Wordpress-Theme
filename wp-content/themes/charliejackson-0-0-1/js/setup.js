(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);

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
    				
		/***************************
		NAVIGATION
		***************************/
		
		$(".mobile-nav > a").click(function() {
			if($(".mobile-nav > ul").hasClass("show-mobile-nav")) {
				$(".mobile-nav > ul").removeClass("show-mobile-nav");
			} else {
				$(".mobile-nav > ul").addClass("show-mobile-nav");
			}
		}); 
		
		$(".sub-nav > a").click(function() {
			if($(".sub-nav > ul").hasClass("show-sub-nav")) {
				$(".sub-nav > ul").removeClass("show-sub-nav");
			} else {
				$(".sub-nav > ul").addClass("show-sub-nav");
			}
		});
		
		
		$('#myModal').on('show.bs.modal', function () {
		  	$("#mce-EMAIL").val($("#mailchimp-email-input").val());
		});
    }

	
    function onPageLoadOrResize () {
    
		$(".content img").not( ".wp-smiley, .gallery-item img" ).each(function() {
			var imageWidth = $(this).attr("width");
			var imageHeight = $(this).attr("height");
			var imageRatio = imageWidth/imageHeight;
			var containerWidth = $(this).parents().width();
			
			var height = (containerWidth * imageHeight ) / imageWidth;
			
			$(this).width(containerWidth).height(height);
			
		});
		
    }

})(jQuery);