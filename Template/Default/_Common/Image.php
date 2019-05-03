<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php if($I['ImageListGroup']){ ?>
	<div class="timeline">
		<?php foreach($I['ImageListGroup'] as $row){ ?>
		<div class="t-view" data-tv-type="image">
			<div class="tv-header media">
				<a href="<?=U('Page','Index',$row[0]['UploadId'])?>" class="tvh-user pull-left">
					<img class="img-responsive" src="<?=UserHead($row[0]['HeadUrl'])?>" alt="">
				</a>
				<div class="media-body p-t-5">
					<strong class="d-block"><a href="<?=U('Page','Index',$row[0]['UploadId'])?>"><?=$row[0]['Username']?></a></strong>
					<small class="d-block"><?=timeago($row[0]['AddDate'])?> 上传 <?=count($row)?> 张图片到相册<a href="<?=U('Image','Show',$row[0]['DirId'])?>">《<?=$row[0]['DirName']?>》</a></small>
				</div>
			</div>
			<div class="tv-body">
				<?php
				$ImageList = $row;
				include(T('_Common/ImageShow'));
				?>
			</div>
		</div>
		<?php } ?>
	</div>
<?php }else{ ?>
	<div class="pmb-block tip_none">
		<p class="tip_tq">_(:з」∠)_</p>
		<p class="tip_t">空空如也...</p>
		<p class="tip_t"><a href="<?=U('Image','List')?>">上传</a>一些图片吧！</p>
	</div>
<?php } ?>