<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('Page/Header'));?>
<?php if($I['CommentList']){ ?>
	<div class="pmb-block">
	<?php $CommentList=$I['CommentList']; $OnlyComment=true; $IsHr=true; include(T('_Common/Comment'));?>
	</div>
<?php }else{ ?>
	<div class="pmb-block tip_none">
		<p class="tip_tq">_(:з」∠)_</p>
		<p class="tip_t">空空如也...</p>
	</div>
<?php } ?>
<?php include(T('Page/Footer'));?>