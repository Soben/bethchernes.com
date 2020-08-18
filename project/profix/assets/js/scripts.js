// ==============================================================
    // CSS TABLE OF CONTENTS
// ==============================================================
    // 01. START PRELOADER
    // 02. START MENU STICKY JS
    // 03. START SMOTH SCROOL JS
    // 04. START TOGGLE DROPDOWN JS
    // 05. START MAGNIFICPOPUP JS
    // 06. START COUNTDOWN JS
    // 07. START WOW ANIMATION JS
// ==============================================================

(function ($) {
    "use strict";
	
	jQuery(document).ready(function($){
		
		// 01. START PRELOADER
		$(window).load(function() {
		// Animate loader off screen
			$(".preloader").fadeOut("slow");
		});
		// 01. END PRELOADER

		// 02. START MENU STICKY JS
		$(".header-top-area").sticky({
			topSpacing: 0,
		});
		// 02. END MENU STICKY JS
		
		// 03. START  SMOTH SCROOL JS
		$('.mainmenu li a[href*=#]:not([href=#])').on('click', function(e) {
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top - 60
					}, 1000);
					e.preventDefault();
				}
			}
		});
		// 03. END SMOTH SCROOL JS
		
		// 04. START TOGGLE DROPDOWN JS
		$(document).on('click','.navbar-collapse.in',function(e) {
			if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
				$(this).collapse('hide');
			}
		});
		// 04. END TOGGLE DROPDOWN JS
		
		// 05. START MAGNIFICPOPUP JS
		$(".image-popup").magnificPopup({
		type:"image",
		gallery:{
			enabled:true
		},
		removalDelay: 300,
		mainClass: "mfp-fade",
		});
		// 05. END MAGNIFICPOPUP JS

		// 06. START COUNTDOWN JS
		$('.profi-fun-facts, .progress').on('inview', function(event, visible, visiblePartX, visiblePartY) {
			if (visible) {
				$(this).find('.timer').each(function () {
					var $this = $(this);
						$({ Counter: 0 }).animate({ Counter: $this.text() }, {
						duration: 3000,
						easing: 'swing',
						step: function () {
							$this.text(Math.ceil(this.Counter));
						}
					});
				});
			$(this).unbind('inview');
			}
		});
		// 06. END COUNTDOWN JS

	});
	
	// 07. START WOW ANIMATION JS
	new WOW().init();
	// 07. END WOW ANIMATION JS
	
})(jQuery);