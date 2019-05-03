<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<!-- Your XlchPlayerKey -->
<script>XlchKey="<?=$WebConfig['Music']['BadApplePlayer']['Key']?>";</script>
<!-- BadApplePlayer -->
<script src="http://static.badapple.top/BadApplePlayer/Player.js"></script>
<style>
.blur{
	z-index:-1;
}
.mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
background: rgba(0,0,0,0);
}
.mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar {
background: rgba(0,0,0,0);
}
.mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar,.mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar {
background: rgba(0,0,0,0);
}
</style>