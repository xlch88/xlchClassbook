<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php if($ImageList){ ?>
<div id="fh5co-main">
	<div class="row">
		<div id="fh5co-board" class="lightbox" data-columns>
			<?php foreach($ImageList as $row2){ ?>
			<div class="item">
				<div class="animate-box" data-src="<?=$row2['Url']?>">
					<a class="image-popup fh5co-board-img lightbox-item" data-src="<?=$row2['Url']?>"><img src="<?=$row2['Url']?>" alt="<?=$row2['Name']?> - <?=$row2['Username']?> 于 <?=timeago($row2['AddDate'])?> 上传至 《<?=$row2['DirName']?>》"></a>
				</div>
				<div class="fh5co-desc">
					<p><?=$row2['Name']?></p>
					<?php if($MoreInfo){ ?><p><?=$row2['Username']?> 于 <?=timeago($row2['AddDate'])?> 上传至 <a href="<?=U('Image','Show',$row2['DirId'])?>">《<?=$row2['DirName']?>》</a></p><?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php }else{ ?>
	<div class="pmb-block tip_none">
		<p class="tip_tq">_(:з」∠)_</p>
		<p class="tip_t">空空如也...</p>
		<p class="tip_t"><a href="<?=U('Image','List')?>">上传</a>一些图片吧！</p>
	</div>
<?php } ?>