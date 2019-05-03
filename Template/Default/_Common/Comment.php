<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php if(!$OnlyComment){?>
<div class="card">
	<div class="card-body">
		<div class="wp-text auto-size" id="editor" contenteditable="true">写下你的留言...</div>
		<div class="wp-actions clearfix">
			<button class="btn btn-warning btn-sm" id="emojiButton"> :) </button>
			<label class="btn btn-info btn-sm">
				<input type="checkbox" />
				私密
			</label>
			
			<button class="btn btn-primary btn-sm pull-right SendComment" comment-type="<?=($IsImg ? '3' : ($isCommentMe ? '2' : '0'))?>" comment-to="<?=($IsImg ? $ImgDirId : ($isCommentMe ? $commentMeId : ''))?>">发送</button>
		</div>
	</div>
</div>
<?php } ?>
<!-- 留言列表 -->
<?php foreach($CommentList as $row){ ?>
<div class="card">
	<div class="card-header">
		<div class="media">
			<a href="<?=U('Page','Index',$row['UserId'])?>" class="pull-left">
				<img class="avatar-img" src="<?=UserHead($row['HeadUrl'])?>" alt="">
			</a>

			<div class="media-body">
				<h2><?=$row['Username']?>
					<small class="c-blue">
					<?php if($row['Type'] != '0'){ ?>
						在 <?=timeago($row['AddDate']);?> 对<a class="c-green">
						<?php if($row['Type'] == '2'){ ?>
						<a href="<?=U('Page','Index',$row['To'])?>" class="c-purple"><?=$row['ToName']?></a>
						<?php }else if($row['Type'] == '3'){ ?>
						<a href="<?=U('Image','Show',$row['To'])?>" class="c-green">相册：<?=$row['ToName']?></a>
						<?php } ?>
						</a>发表留言
					<?php }else{ ?>
						在 <?=timeago($row['AddDate']);?> 发表留言
					<?php } ?>
					<?php if($row['Private'] == '1'){ ?>
					<b class="c-red">[私密留言]</b>
					<?php } ?>
					</small>
				</h2>
			</div>
		</div>
	</div>

	<div class="card-body card-padding" id="#Comment_<?=$row['ID']?>">
		<p><?=$row['Text']?></p>
		<br>
		<div class="wi-stats clearfix">
			<div class="wis-numbers">
				<span class="bgm-lightblue c-white"><i class="fa fa-comments"></i> <?=count($row['Comments'])?></span>
			</div>

			<div class="wis-commentors">
				<?php for($x=0;$x<4 && $x<count($row['Comments']);$x++){ ?>
				<a href=""><img src="<?=UserHead($row['Comments'][$x]['HeadUrl'])?>" alt=""></a>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="wi-comments">
		<!-- Comment Listing -->
		<div class="list-group">
			<?php foreach($row['Comments'] as $row2){ ?>
			<div class="list-group-item media" id="#Comment_<?=$row['ID']?>">
				<a href="<?=U('Page','Index',$row2['UserId'])?>" class="pull-left">
					<img src="<?=UserHead($row2['HeadUrl'])?>" alt="" class="lgi-img">
				</a>
				<div class="media-body">
					<a href="" class="lgi-heading"><?=$row2['Username']?> <small class="c-gray m-l-10"><?=timeago($row2['AddDate'])?></small></a>
					<small class="lgi-text"><?=$row2['Text']?></small>
				</div>
			</div>
			<?php } ?>
		</div>

		<!-- Comment form -->
		<div class="wic-form">
			<textarea placeholder="写点什么吧..." data-ma-action="wall-comment-open"></textarea>

			<div class="wicf-actions text-right">
				<button class="btn btn-sm btn-link" data-ma-action="wall-comment-close">取消</button>
				<button class="btn btn-sm btn-primary SendComment" comment-type=1 comment-to="<?=$row['ID']?>" data-ma-action="wall-comment-close">发送</button>
			</div>
		</div>
	</div>
</div>
<?=($IsHr?'<hr></hr>':'')?>
<?php } ?>