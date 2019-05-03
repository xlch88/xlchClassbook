<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('Page/Header'));?>
<link href="/assets/css/headupload.css" rel="stylesheet">
<div class="pmb-block row">
	<div class="col-md-6" id="crop-avatar" style="border-right: 2px dashed #B9B9B9;">
		<div class="pmbb-header">
			<h2><i class="fa fa-cloud"></i> 上传头像</h2>
			<small>从您的文件内选择一个图片作为头像。</small>
		</div>
		<div class="avatar-view img-circle img-thumbnail" title="上传头像">
			<img src="<?=UserHead($UInfo['HeadUrl'])?>" alt="Avatar">
		</div>
		<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form class="avatar-form" action="<?=U('func','Image','Crop')?>" enctype="multipart/form-data" method="post">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="avatar-modal-label">上传头像</h4>
						</div>
						<div class="modal-body">
							<div class="avatar-body">

								<!-- Upload image and data -->
								<div class="avatar-upload">
									<input type="hidden" class="avatar-src" name="avatar_src">
									<input type="hidden" class="avatar-data" name="avatar_data">
									<label for="avatarInput">选择头像</label>
									<input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
								</div>

								<!-- Crop and preview -->
								<div class="row">
									<div class="col-md-9">
										<div class="avatar-wrapper"></div>
									</div>
									<div class="col-md-3">
										<div class="avatar-preview preview-lg"></div>
										<div class="avatar-preview preview-md"></div>
										<div class="avatar-preview preview-sm"></div>
									</div>
								</div>

								<div class="row avatar-btns">
									<div class="col-md-9">
										<div class="btn-group">
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">向左旋转</button>
										</div>
										<div class="btn-group">
											<button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">向右旋转</button>
										</div>
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-primary btn-block avatar-save">保存</button>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div> -->
					</form>
				</div>
			</div>
		</div><!-- /.modal -->

		<!-- Loading state -->
		<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	</div>
	<div class="col-md-6" id="crop-avatar">
		<div class="pmbb-header">
			<h2><i class="fa fa-qq"></i> 从QQ获取</h2>
			<small>直接使用您的QQ头像作为同学录的头像。</small>
		</div>
		<form action="<?=U('Page','Head',$Type,'Save')?>" method="post" id="OptionFrom" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">QQ号</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="text" class="form-control input-sm" name="QQ" placeholder="输入您的QQ号">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary btn-sm waves-effect">保存</button>
			</div>
		</div>
	</form>
	</div>
</div>
<script>G_aspectRatio=1;</script>
<script>$.ajax({url:'/assets/js/headupload.js',cache:true,dataType:'script'})</script>
<?php include(T('Page/Footer'));?>