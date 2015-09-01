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
        onPageLoadOrResize();
    }

    function onPageLoad() {
	    portfolioNavHighlight();
	    scrollToPortfolioItem();
    }
	
    function onPageLoadOrResize () {
    }
    
    function windowScrollFunction() {		
		portfolioNavHighlight();
	}
    
    /* -----------------------------
	SUPPORT FUNCTIONS
	----------------------------- */
		function portfolioNavHighlight() {
			var scrollMiddle = $(window).scrollTop() + ($(window).height()/2);

			$('article').each( function(){ 
	            var articleTop = $(this).offset().top;
	            var articleBottom = articleTop + $(this).outerHeight(true);
	            var navId = $(this).find('.anchor').attr('id');	            
	            navId = '#nav-' + navId;

	            if(scrollMiddle > articleTop && scrollMiddle < articleBottom) {
		            $(navId).addClass('active-portfolio-item');
		        } else {
			     	$(navId).removeClass('active-portfolio-item');
			    }
	        });
	    }
	    
	    function scrollToPortfolioItem() {
		var hashTagActive = "";
	    $(".portfolio-link").click(function (event) {
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

})(jQuery);