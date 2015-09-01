(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);
    $(window).scroll(windowScrollFunction);
	
	var mobileView = false;

    function documentReadyFunction() {
        // functions for document ready
        onPageLoadOrResize();
        onPageLoad();
    }

    function windowResizeFunction() {
        onPageLoadOrResize();
    }

    function onPageLoad() {
    }
	
    function onPageLoadOrResize () {
	    if($(window).width() > 600) {
		    $('#projects-loop').masonry({
				itemSelector: 'article'
			});
		} else {
			$('#projects-loop').masonry('destroy');
		}
    }
    
    /* -----------------------------
	SUPPORT FUNCTIONS
	----------------------------- */
		

})(jQuery);