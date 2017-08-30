/* STEM THEME CUSTOM SCRIPTS
 * http://www.hugestem.com */

window.jQuery = window.$ = jQuery;
$(document).ready(function(){
	
/*--------------------------------------------------*/
/*	SMART MENU
/*--------------------------------------------------*/
	//Main menu
	$('.navbar .menu-parent').smartmenus();
	$('.navbar .menu-parent').addClass('sm menu-base-theme');
	
	//Mobile menu toggle
	$('.navbar-toggle').click(function(){
		$('.region-primary-menu').slideToggle();
	});
	
	if ( $(window).width() < 767) {
		//Mobile dropdown menu
		$(".region-primary-menu li a:not(.has-submenu)").click(function () {
			$('.region-primary-menu').hide();
	    });
	}
	 
/*----------------------------------------------------*/
/*	TOOLTIP
/*----------------------------------------------------*/	
$('[data-toggle="tooltip"]').tooltip();
$(".tab-content .my-group:first").addClass("active");

/*-----------------------------------------------------*/
/*	SEARCH FORM
/*-----------------------------------------------------*/
 	//SEARCH TOGGLE
	$('#search .search-trigger').on('click',function(){
        $('.search-bar').animate({height: 'toggle'},500);
    });
});

$(window).load(function () {
/*--------------------------------------------------*/
/*	PRELOADER
/*--------------------------------------------------*/
	$(".preloaderimg").fadeOut();
	$(".preloader").delay(200).fadeOut("slow").delay(200, function(){
		$(this).remove();
	});
	
});

/*-------------------------------------------------*/
/*	BACK TO TOP
/*-------------------------------------------------*/
$(window).scroll(function() {
    if($(this).scrollTop() != 0) {
        $(".back-to-top").fadeIn();	
    } else {
        $(".back-to-top").fadeOut();
    }
});
 $(".back-to-top").click(function() {
    $("body, html").animate({scrollTop:0},800);
 });