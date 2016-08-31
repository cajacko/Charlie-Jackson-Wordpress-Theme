(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);
    
    function twitterTimeline(callback) {
    	var articleHeight = $("article").height();
    	
    	if (articleHeight > 2500 ) {
    		articleHeight = 2500;
    	}
    	$(".twitter-timeline").height(articleHeight).attr("height", articleHeight);
    	
    	if(callback) {
    		!function(d,s,id){
	    		var js,fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https';
	    		
	    		if(!d.getElementById(id)) {
	    			js = d.createElement(s);
	    			js.id = id;
	    			js.src = p + "://platform.twitter.com/widgets.js";
	    			fjs.parentNode.insertBefore(js,fjs);
	    		}
	    	}(document,"script","twitter-wjs");
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
        
        twitterTimeline(false);
    }

    function onPageLoad() {   	
    	twitterTimeline(true);
    }

	
    function onPageLoadOrResize () {  	
    	
    }

})(jQuery);