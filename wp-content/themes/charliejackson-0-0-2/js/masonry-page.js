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
		
		$("#load-more").click(function(){
			var offset = $("#masonry article").length;
		 	var url = "/data/?type=thought&offset=" + offset;
		 	
		 	$.get( url, function( data ) {
			 	$(data).filter('article').each(function(i,v) {
				 	$(v).ready(function() {
					 	console.log(v);
					 	$(container).append(v).masonry( 'appended', v );
					 	$(container).masonry();
					});
				});
			});
		});
    }

	
    function onPageLoadOrResize () {
		
    }

})(jQuery);