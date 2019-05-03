<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('Page/Header'));?>
<div class="pmb-block">
	<?php $CommentList=$I['CommentList']; $commentMeId=$UInfo['ID']; $isCommentMe=true; $IsHr=true; $OnlyComment=false; include(T('_Common/Comment'));?>
</div>
<?php include(T('Page/Footer'));?>