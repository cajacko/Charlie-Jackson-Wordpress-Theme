(function($) {

    $(document).ready(documentReadyFunction);
    $(window).resize(windowResizeFunction);
    $(window).scroll(windowScrollFunction);
	
	var lastScrollTop = 0;
	var sidebarTopPosition = 0;
	var globalPadding = 20;
	var siteNavHeight = 50;
	var windowHeight = 0;
	var windowWidth = 0;
	var wrapMaxWidth = 960;
	var areGlobalVarsSet = false;
	var minHeightForFixedNav = 600;
	var isHeightTooSmallForFixedNav = false;
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
	    twitterTimeline(true);

	    $('.hide-without-javascript').removeClass('hide-without-javascript');
    }
	
    function onPageLoadOrResize () {
	    setGlobalVars();
  		topPaddingForFixedNavConpensation();
  		positionSidebar();
    }
    
    function windowScrollFunction() {
	    if(areGlobalVarsSet) {
		    positionSidebar();
		}	   
	}
    
    /* -----------------------------
	SUPPORT FUNCTIONS
	----------------------------- */
		function setGlobalVars() {
		    globalPadding = $("main").css('padding-bottom');
		    globalPadding = parseInt(globalPadding);		    
		    siteNavHeight = $("#site-navigation").outerHeight();		    
		    windowHeight = $(window).height();	
		    windowWidth = $(window).width();	    
		    areGlobalVarsSet = true;		    
		    
		    wrapMaxWidth = $(".wrap").css('max-width');
		    wrapMaxWidth = parseInt(wrapMaxWidth);
		    
		    minHeightForFixedNav = $('#less-vars').css('height');
		    minHeightForFixedNav = parseInt(minHeightForFixedNav);

		    if(windowHeight < minHeightForFixedNav) {
			    isHeightTooSmallForFixedNav = true;
			} else {
				isHeightTooSmallForFixedNav = false;
			}
		    
		    if($('#mobile-nav-icon').css("display") == 'none') {
		   		mobileView = false;
		   	} else {
			   	mobileView = true;
			}
			
			$('.sub-nav').hide();
			if(mobileView) {
				$('#mobile-nav-dropdown').hide();	
			} else {
				$('#mobile-nav-dropdown').show();
			}
		}
		
		function positionSidebar() {
			if(windowWidth >= wrapMaxWidth) {
			    var scroll = $(window).scrollTop();
			    var scrollBottom = scroll + windowHeight;
			    
			    var sidebarHeight = $("#sidebar-container").outerHeight();
			    var totalSidebarHeight = sidebarHeight + siteNavHeight + (globalPadding * 2);
			    
			    var sidebarPosition = $("#sidebar").offset();
			    var sidebarTop = sidebarPosition['top'];
			    
			    var fixedToBottomTopPosition = scrollBottom - sidebarTop - sidebarHeight - globalPadding; //Correct
			    var fixedToTopTopPosisiton = scroll - sidebarTop + siteNavHeight + globalPadding; //Correct
			    
			    var bottomGap = scrollBottom - sidebarTop - sidebarHeight - sidebarTopPosition - globalPadding; //Correct
			    var topGap = sidebarTopPosition - (scroll - sidebarTop) - siteNavHeight - globalPadding;
			    
			    if(isHeightTooSmallForFixedNav) {
				    topGap = topGap + siteNavHeight;
				    fixedToTopTopPosisiton = fixedToTopTopPosisiton - siteNavHeight;
				}
			        
			    if(fixedToTopTopPosisiton <= 0) {
					$("#sidebar").addClass('absolute-sidebar').removeClass('fixed-bottom-sidebar').removeClass('fixed-top-sidebar');
					$("#sidebar-container").css("top", 'auto').css("bottom", "auto");
					sidebarTopPosition = 0;
				} else if(totalSidebarHeight < windowHeight || topGap >= 0) {
					if(isHeightTooSmallForFixedNav) {
						var topOffset = globalPadding;
					} else {
						var topOffset = globalPadding + siteNavHeight;
					}
						
					$("#sidebar").removeClass('absolute-sidebar').removeClass('fixed-bottom-sidebar').addClass('fixed-top-sidebar');
					$("#sidebar-container").css("top", topOffset + "px").css("bottom", "auto");
					sidebarTopPosition = fixedToTopTopPosisiton;
				} else if((bottomGap >= 0 && scroll > lastScrollTop) || ($("#sidebar").hasClass("fixed-bottom-sidebar") && scroll > lastScrollTop)) {
					$("#sidebar").removeClass('absolute-sidebar').addClass('fixed-bottom-sidebar').removeClass('fixed-top-sidebar');
					$("#sidebar-container").css("top", 'auto').css("bottom", globalPadding + "px");
					sidebarTopPosition = fixedToBottomTopPosition;
				} else {
					$("#sidebar-container").css("top", sidebarTopPosition + 'px').css("bottom", "auto");
					$("#sidebar").addClass('absolute-sidebar').removeClass('fixed-bottom-sidebar').removeClass('fixed-top-sidebar');
				}
				
				lastScrollTop = scroll;
			}
		}
		
		function topPaddingForFixedNavConpensation() {
			var anchorHeight = siteNavHeight + globalPadding;
	  		$("main").css("padding-top", siteNavHeight);
	  		$(".anchor").css("top", -anchorHeight);
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
		
		function twitterTimeline(callback) {
	    	var articleHeight = $("article").height();
	    	
	    	if (articleHeight > 2500 ) {
	    		articleHeight = 2500;
	    	}
	    	
	    	articleHeight = 1500;
	    	
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

})(jQuery);