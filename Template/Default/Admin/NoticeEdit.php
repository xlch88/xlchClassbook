<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>信息配置</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>编辑 <?=$I['Info']['Name']?>
						<small><?=$I['Info']['Bewrite']?></small>
					</h2>
				</div>
				<div class="card-body card-padding">
					<div role="tabpanel" class="tab">
						<form class="form-horizontal" method="post" action="<?=U('Admin','NoticeEdit',$Type,'Save')?>">
							<div class="form-group">
								<div class="col-sm-12">
									<textarea name="Text" id="Text" class="form-control" style="height:300px"><?=$I['Info']['Text']; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="fg-line">
										<button class="btn btn-lg bgm-blue btn-block">保存</button>
									</div>
								</div>
							</div>
							<script>
							$(function(){
								var editor = KindEditor.create('#Text',{
									resizeType : 2,
									minWidth:100,
									allowImageUpload : false,
									items : [
										'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
										'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
										'insertunorderedlist', '|', 'emoticons', 'image', 'link']

								});
							});
							</script>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>