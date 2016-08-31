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
		MASONRY
		***************************/
				
		var container = $('#masonry').masonry({
			  itemSelector: 'article'
			});
			
		
		container.imagesLoaded( function() {
			container.masonry({
				itemSelector: 'article'
			});
		});
    }

	
    function onPageLoadOrResize () {
		
    }

})(jQuery);