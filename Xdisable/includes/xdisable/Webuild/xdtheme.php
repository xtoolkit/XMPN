<?php
function xdisable_theme(){
global $sitename,$xdemailset,$nukeurl;
?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="includes/xdisable/Webuild/css/bootstrap.css" rel="stylesheet">
<link href="includes/xdisable/Webuild/css/bootstrap-theme.css" rel="stylesheet">
<link href="includes/xdisable/Webuild/css/style.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1 style="font-family:'Segoe UI',tahoma;direction:rtl;"><?php echo xdvs(3); ?></h1>
					<h2 class="subtitle" style="font-family:'Segoe UI',tahoma;direction:rtl;"><?php echo xdvs(4); ?></h2>
					<div id="countdown"></div>
					<?php if(xdvs(10)==1){ ?><form class="form-inline signup" action="index.php" method="post">
					  <button type="submit" class="btn btn-theme" style="font-family:'Segoe UI',tahoma;">ثبت ایمیل</button>
					  <div class="form-group">
					    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="ایمیل خود را ثبت کنید" name="xdemailset" style="font-family:'Segoe UI',tahoma;">
					  </div>
					</form><?php } ?>	
<?php if(isset($xdemailset)){ ?>
<h2 class="subtitle" style="font-family:'Segoe UI',tahoma;direction:rtl;"><?php if($xdemailset=='0'){ ?>لطفا ایمیل را صحیح وارد کنید. ex : info@xstar.ir<?php }else{ ?>ایمیل شما با موفقیت ثبت گردید.<?php } ?></h2>
<?php } ?>
				</div>
				
			</div>
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
						<p class="copyright">Copyright &copy; 2014 - <a href="<?php echo $nukeurl; ?>"><?php echo $sitename; ?></a></p>
				</div>
			</div>		
		</div>
	</div>
    <script src="includes/xdisable/Webuild/js/jquery.min.js"></script>
    <script src="includes/xdisable/Webuild/js/bootstrap.min.js"></script>
	<script src="includes/xdisable/Webuild/js/jquery.countdown.min.js"></script>
	<script type="text/javascript">
  $('#countdown').countdown('<?php echo xdvs(5); ?>/<?php echo xdvs(6); ?>/<?php echo xdvs(7); ?> <?php echo xdvs(8); ?>:<?php echo xdvs(9); ?>:00', function(event) {
    $(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
  });
</script>
</body>
</html>
<?php
die();
}
?>