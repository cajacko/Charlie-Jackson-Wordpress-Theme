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
    	
		$('#portfolio-header').affix({
			offset: {
				top: function() {
					return $("#site-header").height();
				},
				bottom: 0
			}
		});
		
		$(".portfolio-article").appear();
		$(".portfolio-article").on('appear', function() {

			var id = $(this).attr("id");
						
			$("#li-" + id).addClass("in-view");
			
			$(".active").removeClass("active");
			$(".in-view").last().addClass("active");			
		});
		
		$(".portfolio-article").on('disappear', function() {

			var id = $(this).attr("id");
		
			$("#li-" + id).removeClass("in-view");
		});
		
		if($(window).width() > 1000) {
			$('.article-content').columnize({ columns: 2 });
		}
    }
	
    function onPageLoadOrResize () {  

    }

})(jQuery);