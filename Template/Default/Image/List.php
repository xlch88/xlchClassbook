<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'))?>
<div class="container container-alt">
	<?php include(T('Image/Header'))?>
	<?php if($I['Image']['Dir']){ ?>
		<?php foreach($I['Image']['Dir'] as $row){ ?>
		<div class="card">
			<div class="action-header clearfix">
				<div class="c-blue ah-label"><?=$row['Name']?></div>
				<div class="c-green ah-label"><br><?=$row['Bewrite']?></div>
			</div>

			<div class="card-body card-padding">
				<?php
				$ImageList = $row['Pics'];
				include(T('_Common/ImageShow'));
				?>

				<div class="clearfix"></div>

				<div class="text-center m-t-30">
					<?php if($row['AnybodyUpload'] or $row['CreaterId'] == $UserInfo['ID']){?><a class="btn btn-primary btn-lg" href="<?=U('Image','Edit','Edit',$row['ID']);?>"><?=($row['CreaterId'] == $UserInfo['ID'] ? '<i class="fa fa-edit"></i> 编辑/上传' : '<i class="fa fa-image"></i> 上传图片')?></a><?php } ?>
					<a class="btn btn-success btn-lg" href="<?=U('Image','Show',$row['ID']);?>"><i class="fa fa-eye"></i> 查看全部</a>
				</div>
			</div>
		</div>
		<?php } ?>
	<?php }else{ ?>
	<div class="pmb-block tip_none">
		<p class="tip_tq">_(:з」∠)_</p>
		<p class="tip_t">空空如也... <a href="<?=U('Image','Edit','Create')?>">创建</a>一个相册吧！</p>
	</div>
	<?php } ?>
</div>
<?php include(T('_Common/Footer'))?>