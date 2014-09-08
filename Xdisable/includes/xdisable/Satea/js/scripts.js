/*===========================================================*/
/*	Tweet JS
/*===========================================================*/

jQuery(function($){

	"use strict";

	$("#ticker").tweet({
	modpath: 'twitter/index.php',
	username: "Subsolar Designs",
	page: 1,
	count: 3, //number of tweets
	loading_text: "loading tweets..."
	})
});

$( document ).ready(function() {

	"use strict";

/*===========================================================*/
/*	Slider
/*===========================================================*/

$('.slides').bxSlider({
	mode: 'fade',
	pause: 6000,
	auto: true,
	pager: true,
	
});

/*===========================================================*/
/*	Countdown
/*===========================================================*/

$('.countdown').countdown( { date: '27 march 2015 8:37:00' } );

$(".knob").knob();

/*===========================================================*/
/*	Ticker
/*===========================================================*/

var ul = $(this).find(".tweet_list");
var tweets = ul.children().length;
var currentTweet = 1;

function ticker() {

	setTimeout(function() {

		var top = ul.position().top;
		var h = ul.height();
		var incr = (h / ul.children().length);
		var newTop = top - incr;

		if (currentTweet == tweets) {
			newTop = 0;
			currentTweet = 0;
		};

		ul.animate( {top: newTop}, 500 );
		currentTweet++;

		ticker();

	}, 5000);

};

ticker();
$('#ticker a').attr('target','_blank');


/*===========================================================*/
/*	SignUp
/*===========================================================*/

$('#subscribe').submit(function() {
	if (!valid_email_address($("#email").val()))
	{
		$(".message").html('<span class="response-error">You have entered an invalid email address!</span>');
	}
	else
	{
		$(".message").html('Adding your email address...');
		$.ajax({
			url: 'subscribe.php',
			data: $('#subscribe').serialize(),
			type: 'POST',
			success: function(msg) {
				if(msg=="success")
				{
					$("#email").val("");
					$(".message").html('<span class="response-success">You have been signed up!</span>');
				}
				else
				{
					$(".message").html('<span class="response-error">Ooops, there\'s been a technical error!</span>');
				}
			}
		});
	}

	return false;
});
function valid_email_address(email)
{
	var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	return pattern.test(email);
}

/*===========================================================*/
/*	videoResize
/*===========================================================*/

var $video = $('.player video');

function videoResize() {
	$video.css('height', $(window).height());
}

videoResize();

$(window).on("resize", function(){

	videoResize();
});

}); // end document ready

/*===========================================================*/
/*	Preloader
/*===========================================================*/

$(window).load(function(){

	"use strict";

	WOW = new WOW()

	WOW.init();

	setTimeout(function(){
		$('.preloader').fadeOut(500);
	}, 150)
	
});