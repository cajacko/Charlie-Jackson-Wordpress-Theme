(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);
    $(window).scroll(windowScrollFunction);

	var loadingPosts = false;
		
    function documentReadyFunction() {
        // functions for document ready
        onPageLoadOrResize();
        onPageLoad();
    }

    function windowResizeFunction() {
        onPageLoadOrResize();
    }

    function onPageLoad() {
	    setNewArticlesOpacitytoZero();
	    $("#page-nav").remove(); 
	    showLoadingImage();
	    fadeInArticles();
    }
	
    function onPageLoadOrResize () {
    }
    
    function windowScrollFunction() {		
		checkPositionAndLoadPosts();
		fadeInArticles();
	}
    
    /* -----------------------------
	SUPPORT FUNCTIONS
	----------------------------- */
		
		function checkPositionAndLoadPosts() {
			var scroll = $(window).scrollTop();
		    var windowHeight = $(window).height();
		    var documentHeight = $(document).height(); 
		    var setHeight = documentHeight - (windowHeight * 2);
		    
		    if(scroll >= setHeight) {
				loadMorePosts();
			}
		}
		
		function loadMorePosts() {
			if(!$('#no-more-posts').length && !loadingPosts){
				var url = $('.next-page-link a').last().attr('href');
				
				if(url.indexOf("?action=load_posts") == -1){
					url = url + '?action=load_posts';	
				}
				
				loadingPosts = true;
				
				$.ajax({
					url: url,
					}).done(function(data) {
						$(".loading-img").fadeOut('slow', function(){
							$(this).remove();
						});
						$(".next-page-link").remove();
						$("#post-loop").append(data);
						setNewArticlesOpacitytoZero();
						loadingPosts = false;
						showLoadingImage();
				});	
			}
		}
		
		function setNewArticlesOpacitytoZero() {
			$('.new-article').css('opacity', '0');
		}
		
		function fadeInArticles() {
			var scrollBottom = $(window).scrollTop() + $(window).height();
		
			$('article').each( function(i){ 
	            var articleTop = $(this).offset().top;
	 
	            if(scrollBottom > articleTop){
	                $(this).animate({'opacity':'1'},500);
	                
	                $(this).removeClass('new-article');    
	            }          
	        });
	    }
	    
	    function showLoadingImage() {
		 	$(".loading-img").css('display', 'block');    
		}

})(jQuery);