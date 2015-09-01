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
	    $("#page-nav").addClass('hidden'); 
	    dropDownMenus();

	    $('.hide-without-javascript').removeClass('hide-without-javascript');
    }
	
    function onPageLoadOrResize () {
	    setGlobalVars();
    }
    
    function windowScrollFunction() {   
	}
    
    /* -----------------------------
	SUPPORT FUNCTIONS
	----------------------------- */
		function setGlobalVars() {
		    if($('#mobile-nav-icon').css("display") == 'none') {
		   		mobileView = false;
		   	} else {
			   	mobileView = true;
			}

			if(mobileView) {
				$('#mobile-nav-dropdown').hide();	
			} else {
				$('#mobile-nav-dropdown').show();
			}
		}
		
		function dropDownMenus() {
			$('.site-navigation-item').hover(function(){
				if(!mobileView) {
					$('.top-level-nav-link').addClass('dimmed-nav-item').removeClass('active-sub-nav');
					$('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
					$(this).find('.sub-nav').slideDown();
					$(this).find('.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');
					$(this).find('.top-level-nav-link').removeClass('dimmed-nav-item').addClass('active-sub-nav');
				}
			}, function(){
				if(!mobileView) {
					$('.sub-nav').hide();
					$('.top-level-nav-link').removeClass('dimmed-nav-item').removeClass('active-sub-nav');
					$('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
				}
			});
			
			$('#mobile-nav-icon').click(function(){
				$('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
				
				if($('#mobile-nav-dropdown').is(':visible')) {
					$('#mobile-nav-dropdown').slideUp();
					$('.sub-nav').slideUp();
				} else {
					$('#mobile-nav-dropdown').slideDown();
				}
			});
			
			$('.top-level-nav-link').click(function(){
				$('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
				
				if(mobileView && $(this).siblings('.sub-nav').is(':visible')) {
					$('.sub-nav').slideUp();
				} else if(mobileView) {
					$('.sub-nav').slideUp();
					$(this).siblings('.sub-nav').slideDown();
					$(this).find('.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-up');
				}
			});
			
			$(document).on('click', function(event) {
				if(!$(event.target).closest('#site-navigation-items').length && mobileView) {
					$('#mobile-nav-dropdown').slideUp();
					$('.sub-nav').slideUp();
					$('.fa-caret-up').removeClass('fa-caret-up').addClass('fa-caret-down');
				}
			});
		}

})(jQuery);