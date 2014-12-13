jQuery(function($) {
	$("#top-slider").carouFredSel({
		responsive	: true,
		auto: {
			timeoutDuration: 4000,
			duration: 1000
		},
		scroll		: {
			fx			: "crossfade"
		},
		prev	: {	
			button	: ".slide-left-arr",
			key		: "left"
		},
		next	: { 
			button	: ".slide-right-arr",
			key		: "right"
		},
		items		: {
			visible		: 1,
			width		: 980
		}
	});

	$(".wrap-featured").carouFredSel({
		circular: false,
		infinite: false,
		auto 	: false,
		prev	: {	
			button	: ".featured-left-arr",
			key		: "left"
		},
		next	: { 
			button	: ".featured-right-arr",
			key		: "right"
		},
		items		: {
			visible		: 4
		}
	});

	$('.feedback-title').click(function(){
		$('#feedback-form').slideToggle(400);
		return false;
	});

	$('#lng-selection, .events-selection').click(function(e){
		e.stopPropagation();
	});

	$('#lng-selection span, .events-selection span').click(function(){
		$(this).next().toggleClass('active');
	});

	$(document).click(function() {
	    $('#lng-selection ul').removeClass('active');
	    $('.events-selection ul').removeClass('active');
	});
});
