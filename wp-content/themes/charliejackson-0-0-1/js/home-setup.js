(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);
    
    function bannerIndicators() {
    	
    	$("#home-banner .carousel-indicators li").css("border", "1px solid #ffffff").css("background-color", "rgba(0, 0, 0, 0)");
    
    	if ($("#home-banner .carousel-inner .active").hasClass("banner-light")) {
			$("#home-banner .carousel-indicators li").css("border", "1px solid #000000");
			$("#home-banner .carousel-indicators .active").css("background-color", "#000000");
		} else {
			$("#home-banner .carousel-indicators li").css("border", "1px solid #ffffff");
			$("#home-banner .carousel-indicators .active").css("background-color", "#ffffff");
		}
    }

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
		INITIALISE POPOVER
		***************************/
		
		$(function () {
		  $('[data-toggle="popover"]').popover();
		});
		
		/***************************
		PROJECT CATS
		***************************/
		
		$(".project-cat").click(function() {
		
			$("#projects header a").removeClass("bold");		
			$(this).addClass("bold");
			
			$("#projects article li").show();
			var projectId = $(this).attr('id');
			
			$("#projects article li").not("." + projectId).hide();
		});
		
		$("#project-cat-all").click(function() {
			$("#projects header a").removeClass("bold");		
			$(this).addClass("bold");
			
			$("#projects article li").show();
		});
		
		/***************************
		THOUGHTS CATS
		***************************/
		/*
		$(".project-cat").click(function() {
		
			$("#projects header a").removeClass("bold");		
			$(this).addClass("bold");
			
			$("#projects article li").show();
			var projectId = $(this).attr('id');
			
			$("#projects article li").not("." + projectId).hide();
		});
		
		$("#project-cat-all").click(function() {
			$("#projects header a").removeClass("bold");		
			$(this).addClass("bold");
			
			$("#projects article li").show();
		}); */
		
		bannerIndicators();
		
		$('#home-banner').on('slid.bs.carousel', function () {
			bannerIndicators();
		})
		
	}

	
    function onPageLoadOrResize () {
    
    	/***************************
		HOME BANNER SIZE
		***************************/
		
		var windowHeight = $( window ).height();
		var windowWidth = $( window ).width();
		var headerHeight = $("#site-header").height();
		var windowRatio = windowWidth/windowHeight;
		
		$("#home-banner .item").height(windowHeight).width(windowWidth);
		$("#home-banner .carousel-control").css("top", headerHeight);
		
		
		
		$(".cover-image").each(function() {
			
			centerImage($(this));
			
		});
		
		function centerImage(image) {
			var imageWidth = $(image).attr("width");
			var imageHeight = $(image).attr("height");
			var imageRatio = imageWidth/imageHeight;
			
			var parentHeight = $(image).parent().outerHeight( true );
			var parentWidth = $(image).parent().outerWidth( true );
			var parentRatio = parentWidth/parentHeight;
			
			if (imageRatio > parentRatio) {
				$(image).css("height", "100%");
				$(image).css("width", "auto");
				
				var left = ((imageRatio * parentHeight) - parentWidth)/2;
				
				$(image).css("top", 0);
				$(image).css("left", -left);
								
			} else {
				$(image).css("height", "auto");
				$(image).css("width", "100%");
				
				var top = ((parentWidth / imageRatio) - parentHeight)/2;
				
				$(image).css("top", -top);
				$(image).css("left", 0);
			}
		}
    }

})(jQuery);