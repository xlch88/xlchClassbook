<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'))?>
<link rel="stylesheet" type="text/css" href="/assets/css/webuploader.css" />
<link rel="stylesheet" type="text/css" href="/assets/css/uploadstyle.css" />
<div class="container">
	<?php include(T('Image/Header'))?>
	<div class="card">
		<div class="card-body card-padding">
			<div role="tabpanel" class="tab">
				<ul class="tab-nav" role="tablist">
					<?php if($Type != 'Create'){ ?>
						<li class="active"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">上传新图片</a></li>
						<?php if($I['Image']['Dir']['CreaterId']==$UserInfo['ID'] or ($UserGroup['Type'] == 'Admin' && getArgs('Admin') == 'True')){ ?>
							<li role="presentation"><a href="#manager" aria-controls="manager" role="tab" data-toggle="tab">管理图片</a></li>
						<?php } ?>
					<?php } ?>
					<?php if(($I['Image']['Dir']['CreaterId']==$UserInfo['ID'] or ($UserGroup['Type'] == 'Admin' && getArgs('Admin') == 'True')) or $Type=='Create'){ ?>
						<li role="presentation" class="<?=($Type=='Create' ? 'active' : '');?>"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab"><?=($Type=='Create' ? '填写相册信息' : '修改信息');?></a></li>
					<?php } ?>
				</ul>
				<div class="tab-content">
					<?php if($Type != 'Create'){?>
					<div role="tabpanel" class="tab-pane active in" id="upload">
						<div id="wrapper">
							<div id="container">
								<div id="uploader">
									<div class="queueList">
										<div id="dndArea" class="placeholder">
											<div id="filePicker"></div>
											<p>或将文件拖到这里，<font color=red>每个文件最大为<?=$WebConfig['FuckRobot']['Image']['Size']?>KB</font>。<br /></p>
										</div>
									</div>
									<div class="statusBar" style="display:none;">
										<div class="progress">
											<span class="text">0%</span>
											<span class="percentage"></span>
										</div><div class="info"></div>
										<div class="btns">
											<div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php if($I['Image']['Dir']['CreaterId']==$UserInfo['ID'] or ($UserGroup['Type'] == 'Admin' && getArgs('Admin') == 'True')){ ?>
					<div role="tabpanel" class="tab-pane" id="manager">
						<div class="table-responsive">
							红色的URL表示该图片信息存在于数据库但是图片不在本地存储或已被删除。
							<table class="table table-hover">
								<thead>
									<tr>
										<th># ID</th>
										<th>图片名称</th>
										<th>文件地址</th>
										<th>上传者</th>
										<th>操作</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($I['Image']['Dir']['Pics'] as $row){ ?>
									<tr imgid="<?=$row['ID']?>">
										<td><?=$row['ID']?></td>
										<td><?=$row['Name']?></td>
										<td><a target="_blank" href="<?=$row['Url']?>"><?=(!is_file(RootDir.$row['Url']) ? "<font color=red>$row[Url]</font>" : $row['Url'])?></a></td>
										<td><?=$row['Username']?> (UID:<?=$row['UploadId']?>)</td>
										<td><a class="btn bgm-red deleteimage">删</a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<script>
							$('.deleteimage').click(function(){
								var ThisLine=$(this).parent().parent();
								var id=$(this).parent().parent().attr('imgid');
								$.ajax({
									url:'<?=U('func','Image','Delete')?>',
									cache:false,
									data:{
										ImgId:id
									},
									method:'post',
									dataType:'json',
									success:function(data){
										notify(data.Message,(data.Code == 1 ? 'success' : 'danger'));
										if(data.Code == 1){
											ThisLine.remove();
										}
									},
									error:function(){
										notify('网络连接错误！','danger');
									}
								});
							});
							</script>
						</div>
					</div>
					<?php } ?>
					<?php } ?>
					<?php if(($I['Image']['Dir']['CreaterId']==$UserInfo['ID'] or ($UserGroup['Type'] == 'Admin' && getArgs('Admin') == 'True')) or $Type=='Create'){ ?>
					<div role="tabpanel" class="tab-pane <?=($Type=='Create' ? 'active' : '');?> row" id="edit">
						<div class="col-md-6">
						<h3>相册信息</h3>
						<hr></hr>
						<form role="form" method="post" action="<?=U($mod,$mod2,($Type == 'Create' ? 'SaveCreate' : 'SaveEdit'),$val)?>">
							<div class="form-group fg-line">
								<label for="Name">相册名称</label>
								<input name="Name" type="text" class="form-control input-sm" id="Name" value="<?=$I['Image']['Dir']['Name']?>" placeholder="输入相册名称" size=25>
							</div>
							<div class="form-group fg-line">
								<label for="Name">一句话介绍</label>
								<input name="Bewrite" type="text" class="form-control input-sm" id="Name" value="<?=$I['Image']['Dir']['Bewrite']?>" placeholder="输入相册名称" size=25>
							</div>
							<div class="checkbox">
								<label>
									<input name="AnybodyUpload" type="checkbox" value="Yes" <?=($I['Image']['Dir']['AnybodyUpload'] ? 'checked' : '')?>>
									<i class="input-helper"></i> 任何人都可以上传照片到这个相册
								</label>
							</div>
							<button type="submit" class="btn btn-primary btn-sm m-t-10">保存</button>
						</form>
						</div>
						<div class="col-md-6">
						<?php if($Type != 'Create'){ ?>
							<hr></hr>
							<h3>删除相册</h3>
							<hr></hr>
							<p>如果您确定删除该相册，那么相册内的图片将会失去很长一段时间（真的很长！）。</p>
							<p>真的确定以及肯定这么做么？</p>
							
							<form role="form" method="post" action="<?=U($mod,$mod2,'Delete',$val)?>">
								<button type="submit" class="btn btn-danger btn-sm m-t-10">删除</button>
							</form>
						<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if($Type=='Edit'){ ?>
<script>
uploadType=<?=$WebConfig['Option']['ImageUpload'];?>;
Upload_Dir="<?=$I['Image']['Dir']['ID']?>";
Save_Url="<?=U('func','Image','Upload',$UploadType[$WebConfig['Option']['ImageUpload']])?>";
$(document).ready(function () {
	$.ajax({url:'/assets/js/upload.js',cache:true,dataType:'script'});
});
</script>
<?php } ?>
<?php include(T('_Common/Footer'))?>