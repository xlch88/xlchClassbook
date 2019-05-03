<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
    <div class="block-header">
		<?php if($mod2 != 'Edit'){ ?>
        <h2>
			相册
            <small>您可以在这里查阅、分享照片。</small>
        </h2>
		<?php }else{ ?>
        <h2><?=($Type=='Create' ? '创建相册' : '编辑相册');?>
            <small><?=$I['Image']['Dir']['Name']?></small>
        </h2>
		<?php } ?>
		<ul class="actions button hidden-xs hidden-sm">
			<a class="btn btn-success btn-lg" href="<?=U('Image','Index')?>">最新上传</a>
			<a class="btn btn-primary btn-lg" href="<?=U('Image','List')?>">相册列表</a>
			<a class="btn btn-warning btn-lg" href="<?=U('Image','Edit','Create')?>">创建相册</a>
		</ul>
    </div>
	<div class="well text-center hidden-md hidden-lg">
		<ul class="actions button">
			<a class="btn btn-success btn-lg" href="<?=U('Image','Index')?>">最新上传</a>
			<a class="btn btn-primary btn-lg" href="<?=U('Image','List')?>">相册列表</a>
			<a class="btn btn-warning btn-lg" href="<?=U('Image','Edit','Create')?>">创建相册</a>
		</ul>
	</div>