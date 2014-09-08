<?php
function xdisable_theme(){
global $sitename,$xdemailset;
?><!doctype html>
<html>
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
<style type="text/css">
html,body,div,h1,h2,h3,h4,p	{margin:0;padding:0;}
body {background: #222;background: -moz-linear-gradient(top,  #222 0%, #111 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#222), color-stop(100%,#111));background: -webkit-linear-gradient(top,  #222 0%,#111 100%);background: -o-linear-gradient(top,  #222 0%,#111 100%);background: -ms-linear-gradient(top,  #222 0%,#111 100%);background: linear-gradient(top,  #222 0%,#111 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#222', endColorstr='#111',GradientType=0 );background-attachment: fixed;}
.main{direction:rtl;background-color:#333;margin:100px auto;width:500px;min-height:160px;font:12px "Segoe UI", tahoma;border:1px solid #fff;text-align:right;color:#eee;border-radius:20px;-moz-border-radius:20px;-webkit-border-radius:20px;-o-border-radius:20px;-khtml-border-radius:20px;-ms-border-radius:20px;box-shadow:0 0 10px #000;}
h2{border-radius:20px 20px 0 0;-moz-border-radius:20px 20px 0 0;-webkit-border-radius:20px 20px 0 0;-o-border-radius:20px 20px 0 0;-khtml-border-radius:20px 20px 0 0;-ms-border-radius:20px 20px 0 0;border-bottom:1px solid #fff;height:48px;font:normal 20px "Segoe UI", tahoma;text-align:center;line-height:48px;color:#fff;text-indent:10px;background-color:#222;}
p{padding:5px;margin:0;}
input{font:normal 14px "Segoe UI", tahoma;}
.notify{border-radius:0 0 20px 20px;-moz-border-radius:0 0 20px 20px;-webkit-border-radius:0 0 20px 20px;-o-border-radius:0 0 20px 20px;-khtml-border-radius:0 0 20px 20px;-ms-border-radius:0 0 20px 20px;border-top:1px solid #fff;height:48px;line-height:40px;}
.xemail{color:#eee;margin:5px;height:22px;padding:5px 5px 9px 5px;width:400px;direction:ltr;border:1px solid #666;background:#222;border-radius:10px;-moz-border-radius:10px;-webkit-border-radius:10px;-o-border-radius:10px;-khtml-border-radius:10px;-ms-border-radius:10px;}
.xemail:focus{color:#fff;border:1px solid #222;background:#111;}
</style>
</head>
<body>
<div class="main">
<h2><?php echo xdvs(3); ?></h2>
<?php echo xdvs(4); ?>
<?php if(xdvs(10)==1){ ?><div class="notify">
<form action="index.php" method="post">
<input type="text" class="xemail" value="" placeholder="برای اطلاع از بازگشایی سایت ایمیل خود را ثبت کنید" name="xdemailset"/>
<input type="submit" value="ثبت نام"/>
</form>
</div><?php } ?>
<?php if(isset($xdemailset)){ ?>
<div class="notify">
<p><?php if($xdemailset=='0'){ ?>لطفا ایمیل را صحیح وارد کنید. ex : info@xstar.ir<?php }else{ ?>ایمیل شما با موفقیت ثبت گردید.<?php } ?></p>
</div>
<?php } ?>
</div>
</body>
</html>
<?php
die();
}
?>