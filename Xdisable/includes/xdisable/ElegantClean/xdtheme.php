<?php
function xdisable_theme(){
global $sitename,$xdemailset,$adminmail;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
	<link rel="stylesheet" href="includes/xdisable/ElegantClean/css/style.css" type="text/css" charset="utf-8" />
	<link rel="stylesheet" href="includes/xdisable/ElegantClean/css/ie.css" type="text/css" charset="utf-8" />
	<script language="Javascript" type="text/javascript" src="includes/xdisable/ElegantClean/js/jquery-1.4.4.js"></script>
	<script language="Javascript" type="text/javascript" src="includes/xdisable/ElegantClean/js/jquery.lwtCountdown-1.0.js"></script>
	<script language="Javascript" type="text/javascript" src="includes/xdisable/ElegantClean/js/misc.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="logo"><img class="xdlogo" src="<?php echo xdvs(15); ?>" alt="logo"/>
		</div> <!-- end of logo -->
		
		<div id="main">
		<div class="xdtitle"><?php echo xdvs(3); ?></div>
		<div class="xddes"><?php echo xdvs(4); ?></div>
			<div id="countdown">
				
					<div class="dash weeks_dash">
						<span class="dash_title">weeks</span>
						<div class="digit">0</div>
						<div class="digit">0</div>
					</div>

					<div class="dash days_dash">
						<span class="dash_title">days</span>
						<div class="digit">0</div>
						<div class="digit">0</div>
					</div>

					<div class="dash hours_dash">
						<span class="dash_title">hours</span>
						<div class="digit">0</div>
						<div class="digit">0</div>
					</div>

					<div class="dash minutes_dash">
						<span class="dash_title">minutes</span>
						<div class="digit">0</div>
						<div class="digit">0</div>
					</div>

					<div class="dash seconds_dash">
						<span class="dash_title">seconds</span>
						<div class="digit">0</div>
						<div class="digit">0</div>
					</div>

				
					
			</div> <!-- end of countdown -->
			
			<div id="bottom">
				<div class="bottom-text">
				<?php if(isset($xdemailset)){if($xdemailset=='0'){ ?>Wrong email<?php }else{ ?>E-mail has been registered successfully.<?php }}else{if(xdvs(10)==1){ ?>Sign up for updates<?php }} ?>
				</div>
				<?php if(xdvs(10)==1){ ?><div id="newsletter"> <!-- start of newsletter zone -->
					<form action="" method="post" >
					<input type="text" size="30" value="Enter Your E-mail" onfocus="if(this.value=='Enter Your E-mail'){this.value=''};" 	onblur="if(this.value==''){this.value='Enter Your E-mail'};" id="email_field" name="xdemailset" />
					<input type="image" src="includes/xdisable/ElegantClean/css/images/notify.jpg" id="submit" value="submit" />
					</form>
				</div><?php } ?> <!-- end of newsletter zone -->
				<div id="social"> <!-- start of social icons list --> 
					<ul>					
					<li><a href="<?php echo xdvs(11); ?>"><img src="includes/xdisable/ElegantClean/facebook.jpg" alt="Facebook Page" /></a></li>
					<li><a href="<?php echo xdvs(12); ?>"><img src="includes/xdisable/ElegantClean/twitter.jpg" alt="Twitter" /></a></li>
					<li><a href="<?php echo xdvs(14); ?>"><img src="includes/xdisable/ElegantClean/linkedin.jpg" alt="LinkedIn Profile" /></a></li>
					<li><a href="mailto:<?php echo $adminmail; ?>"><img src="includes/xdisable/ElegantClean/mail.jpg" alt="Contact via mail" /></a></li>
					</ul>
				</div> <!-- end of social icons list --> 
							
			</div> <!-- end of bottom div -->
			

			
	
		</div> <!-- end of main -->
		<!-- start of the javascript code that handles the countdown -->
		<script language="javascript" type="text/javascript">
			jQuery(document).ready(function() {
				$('#countdown').countDown({
					targetDate: {
						'day': 		<?php echo xdvs(7); ?>,
						'month': 	<?php echo xdvs(6); ?>,
						'year': 	<?php echo xdvs(5); ?>,
						'hour': 	<?php echo xdvs(8); ?>,
						'min': 		<?php echo xdvs(9); ?>,
						'sec': 		0
					}
				});
							
				$('#email_field').focus(email_focus).blur(email_blur);
				$('#subscribe_form').bind('submit', function() { return false; });
				
			});
		</script>
		<!-- end of the javascript code that handles the countdown -->
		
	</div> <!-- end of wrapper -->
</body>
</html>
<?php
die();
}
?>