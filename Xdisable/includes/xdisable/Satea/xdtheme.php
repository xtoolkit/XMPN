<?php
function xdisable_theme(){
global $sitename,$xdemailset,$nukeurl;
if(isset($xdemailset)){
echo"success";
die();
}
?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="includes/xdisable/Satea/css/bootstrap.min.css" rel="stylesheet">
	<link href="includes/xdisable/Satea/css/font-awesome.min.css" rel="stylesheet">
	<link href="includes/xdisable/Satea/css/animate.css" rel="stylesheet">
	<link href="includes/xdisable/Satea/css/style.css" rel="stylesheet">
	<script src="includes/xdisable/Satea/js/jquery-1.11.1.min.js"></script>
</head>
<body class="color color-variation-1">
	
	<div class="preloader">
		<div class="bounce">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>

	<div class="wraper container-fluid">
		<div class="row">
			<div class="left col-md-6 col-sm-6 col-xs-12">
				<div class="slider">
					<ul class="slides">
						<li style="background-image: url(includes/xdisable/Satea/images/1.jpg);">
							<div class="title">
								<a href=""></a>
							</div>
							<span class="title-text"><?php echo xdvs(4); ?></span>
						</li>
						<li style="background-image: url(includes/xdisable/Satea/images/2.jpg);">
							<div class="title">
								<a href=""></a>
							</div>
							<span class="title-text"><?php echo xdvs(4); ?></span>
						</li>
						<li style="background-image: url(includes/xdisable/Satea/images/3.jpg);">
							<div class="title">
								<a href=""></a>
							</div>
							<span class="title-text"><?php echo xdvs(4); ?></span>
						</li>
						<li style="background-image: url(includes/xdisable/Satea/images/4.jpg);">
							<div class="title">
								<a href=""></a>
							</div>
							<span class="title-text"><?php echo xdvs(4); ?></span>
						</li>
					</ul>
				</div>
			</div>
			<div class="right col-md-6 col-sm-6 col-xs-12">
				<section class="countdown">
					<div style="direction:rtl;text-align:right;"><span class="title-soon wow fadeIn" data-wow-delay=".2s"><?php echo xdvs(3); ?></span></div>
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 countdown-item wow fadeIn" data-wow-delay=".2s">
							<input class="knob" id="days" data-readonly=true data-min="0" data-max="365" data-width="125" data-height="125" data-bgColor="#f1f1f1" data-fgColor="#91e0d0" data-thickness=".1" data-angleOffset="180">
							<span class="countdown-text">days</span>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 countdown-item wow fadeIn" data-wow-delay=".4s">
							<input class="knob" id="hours" data-readonly=true data-min="0" data-max="24" data-width="125" data-height="125" data-bgColor="#f1f1f1" data-fgColor="#91e0d0" data-thickness=".1" data-angleOffset="180">
							<span class="countdown-text">hours</span>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 countdown-item wow fadeIn" data-wow-delay="0.6s">
							<input class="knob" id="mins" data-readonly=true data-min="0" data-max="60" data-width="125" data-height="125" data-bgColor="#f1f1f1" data-fgColor="#91e0d0" data-thickness=".1" data-angleOffset="180">
							<span class="countdown-text">minutes</span>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 countdown-item wow fadeIn" data-wow-delay="0.8s">
							<input class="knob" id="secs" data-readonly=true data-min="0" data-max="60" data-width="125" data-height="125" data-bgColor="#f1f1f1" data-fgColor="#91e0d0" data-thickness=".1" data-angleOffset="180">
							<span class="countdown-text">seconds</span>
						</div>
					</div>
				</section>
				<?php if(xdvs(10)==1){ ?><div style="direction:rtl;text-align:right;"><div class="subscribe wow fadeIn" data-wow-delay="0.3s">
					<span class="sub-text">من را با خبر کنید :</span>
					<form role="form" method="post" id="subscribe">
						<fieldset>
							<input type="email" id="email" name="xdemailset" placeholder="ایمیل من" value="">
							<input id="signup-button" type="submit" value="ثبت" />
						</fieldset>
					</form>
					<div class="message"></div>
				</div></div><?php } ?>
			

				<footer>
					<ul class="social-links" data-wow-delay="0.3s">
						<?php if(xdvs(11)==""){}else{ ?><li><a href="<?php echo xdvs(11); ?>"><i class="fa fa-facebook"></i></a></li><?php } ?>
						<?php if(xdvs(12)==""){}else{ ?><li><a href="<?php echo xdvs(12); ?>"><i class="fa fa-google-plus"></i></a></li><?php } ?>
						<?php if(xdvs(13)==""){}else{ ?><li><a href="<?php echo xdvs(13); ?>"><i class="fa fa-twitter"></i></a></li><?php } ?>
						<?php if(xdvs(14)==""){}else{ ?><li><a href="<?php echo xdvs(14); ?>"><i class="fa fa-linkedin"></i></a></li><?php } ?>
					</ul>
					<div class="copyright">© All Rights Reserved 2014</div>
				</footer>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="includes/xdisable/Satea/js/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="includes/xdisable/Satea/js/jquery.knob.js"></script>
	<script type="text/javascript" src="includes/xdisable/Satea/js/countdown.js"></script>
	<script type="text/javascript" src="includes/xdisable/Satea/js/wow.min.js"></script>
	<script type="text/javascript" src="includes/xdisable/Satea/js/retina.min.js"></script>
<script type="text/javascript">
$('.slides').bxSlider({
	mode: 'fade',
	pause: 6000,
	auto: true,
	pager: true,
	
});

/*===========================================================*/
/*	Countdown
/*===========================================================*/

$('.countdown').countdown( { date: '<?php echo xdvs(5); ?>/<?php echo xdvs(6); ?>/<?php echo xdvs(7); ?> <?php echo xdvs(8); ?>:<?php echo xdvs(9); ?>:00' } );

$(".knob").knob();

$('#subscribe').submit(function() {
	if (!valid_email_address($("#email").val()))
	{
		$(".message").html('<span class="response-error">آدرس ایمیل معتبر وارد کنید.</span>');
	}
	else
	{
		$(".message").html('در حال پردازش ایمیل...');
		$.ajax({
			url: 'index.php',
			data: $('#subscribe').serialize(),
			type: 'POST',
			success: function(msg) {
				if(msg=="success")
				{
					$("#email").val("");
					$(".message").html('<span class="response-success">ایمیل شما ثبت شد.</span>');
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
/*	Preloader
/*===========================================================*/

$(window).load(function(){

	"use strict";

	WOW = new WOW()

	WOW.init();

	setTimeout(function(){
		$('.preloader').fadeOut(500);
	}, 150)
	
});</script>
</body>
</html>
<?php
die();
}
?>