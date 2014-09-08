<?php
function xdisable_theme(){
global $sitename,$xdemailset;
?><!doctype html>
<html>
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
<style type="text/css">
.main{direction:rtl;padding:0;margin:0;background-color:#87d4f1;margin:100px auto;width:400px;min-height:56px;font:11px tahoma;border:1px solid #2c91b6;text-align:right;color:#111;}
h2{margin:0;padding:3px;border-bottom:1px solid #2c91b6;height:28px;font:11px tahoma;text-align:right;line-height:28px;color:#fff;text-indent:2px;background-color:#33b5e5;}
p{padding:5px;margin:0;}
.notify{height:34px;width:400px;border-top:1px solid #2c91b6;text-align:right;color:#000;text-indent:5px;line-height:30px;}
.xemail{margin:3px;height:22px;width:320px;direction:ltr;}
input{font:normal 11px tahoma;}
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