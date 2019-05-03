<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'))?>
<div class="container container-alt">
	<?php include(T('Image/Header'))?>
	<?php
	$ImageList = $I['ImageList'];
	$MoreInfo = true;
	include(T('_Common/ImageShow'));
	?>
</div>
<?php include(T('_Common/Footer'))?>