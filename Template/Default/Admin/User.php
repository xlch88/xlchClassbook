<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>用户管理</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2>用户列表
						<small>您可以对同学们进行一些常用的管理操作，但是您不能随意修改Ta的个人信息。</small>
					</h2>
					<a class="btn btn-primary add_user">添加账户</a>
				</div>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>用户名</th>
								<th>注册时间</th>
								<th>注册IP</th>
								<th>注册地点</th>
								<th>上次登录时间</th>
								<th>上次登录IP</th>
								<th>用户组</th>
								<th>发表留言数</th>
								<th>发表图片数</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($I['UserList'] as $row){ ?>
							<tr edit-status="<?=$row['Status']?>" userid="<?=$row['ID']?>" group="<?=$row['Group']?>">
								<td class="edit_id"><?=$row['ID']?></td>
								<td class="edit_username"><a href="<?=U('Page','Index',$row['ID'])?>"><?=$row['Username']?></a></td>
								<td><?=$row['RegDate']?></td>
								<td><a href="http://ip138.com/ips138.asp?ip=<?=$row['RegIP']?>" target="_blank"><?=$row['RegIP']?></a></td>
								<td><?=$row['RegCity']?></td>
								<td><?=$row['LoginDate']?></td>
								<td><a href="http://ip138.com/ips138.asp?ip=<?=$row['LoginIP']?>" target="_blank"><?=$row['LoginIP']?></a></td>
								<td class="userGroup"><?=$row['Group']?> <font color="<?=$GroupInfo[$row['Group']]['Color']; ?>">[<?=$GroupInfo[$row['Group']]['Name']; ?>]</font></td>
								<td><?=$row['CommentNumber']?></td>
								<td><?=$row['ImageNumber']?></td>
								<td><a class="btn btn-primary edit_user">编辑账户</a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="card-body card-padding">
					<ul class="pagination mg-top-0 mg-btm-0">
						<li <?=($PageNum<2 ? 'class="disabled"' : '');?>>
							<a href="<?=($PageNum>1 ? U($mod,$mod2,'Page',$PageNum-1) : '') ?>">«</a>
						</li>
						<?php
						$PageNumInt=10;
						$PageNumInt=-($PageNumInt-($PageNumInt/2));
						for($c=1;$c<10;$c++){
							$id=($PageNum+$c+$PageNumInt);
							if($id>=1 && $id<=$PageNumber){
							?>
							<li <?php if($PageNum==$id){echo 'class="active"';} ?>>
								<a href="<?=U($mod,$mod2,'Page',$id)?>"><?php echo $id ?></a>
							</li>
							<?php
							}
						}
						?>
						<li <?=($PageNum==$PageNumber ? 'class="disabled"' : '')?>>
							<a href="<?=($PageNum<$PageNumber ? U($mod,$mod2,'Page',$PageNum+1) : '')?>">»</a>
						</li>
					</ul>
				</div>
				<div class="modal fade" id="editUser" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">账户操作</h4>
							</div>
							<div class="modal-body">
								<div role="tabpanel">
									<ul class="tab-nav" role="tablist">
										<li class="active"><a href="#ResetPassword" aria-controls="ResetPassword" role="tab" data-toggle="tab" aria-expanded="true">重置密码</a></li>
										<li><a href="#Edit" aria-controls="Edit" role="tab" data-toggle="tab" aria-expanded="false">修改用户</a></li>
										<li><a href="#Ban" aria-controls="Ban" role="tab" data-toggle="tab" aria-expanded="false">封禁账户</a></li>
										<li><a href="#Del" aria-controls="Del" role="tab" data-toggle="tab" aria-expanded="false">删除账户</a></li>
									</ul>

									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="ResetPassword">
											<p>使用此功能将会重置用户的密码为：123456</p>
											<p>确认要重置吗？</p>
											<br>
											<p><a class="btn btn-danger" id="edit_resetpassword">确认重置</a></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="Edit">
											<div class="form-group fg-line">
												<label>姓名</label>
												<input type="text" class="form-control input-sm" id="editUsername">
											</div>
											<div class="form-group fg-line">
												<label>用户组</label>
												<select class="form-control" id="editGroup">
													<?php foreach($GroupInfo as $i=>$row){ if($i!=='Guest'){ ?>
													<option value="<?=$i; ?>"><?=$i; ?> (<?=$row['Name']?>)</option>
													<?php }} ?>
												</select>
											</div>
											<p><a class="btn btn-danger" id="edit_save">保存设置</a></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="Ban">
											<div class="form-group">
													<div class="checkbox">
														<label>
															<input type="checkbox" id="IsOn">
															<i class="input-helper"></i>
															启用账户（取消勾选则为封禁状态）
														</label>
													</div>
											</div>
											<div class="form-group fg-line">
												<label>封禁理由</label>
												<input type="text" class="form-control input-sm" id="BanText" placeholder="登录后将会显示此信息">
											</div>
											<p><a class="btn btn-danger" id="edit_banuser">设置封禁状态</a></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="Del">
											<p>使用此功能将会删除用户的账户资料以及上传的图片、发布的留言等全部信息。</p>
											<p>确认要删除吗？</p>
											<br>
											<p><a class="btn btn-danger" id="edit_deluser">确认删除</a></p>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="addUser" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">添加账户</h4>
							</div>
							<div class="modal-body">
								<div class="form-group fg-line">
									<label>姓名</label>
									<input type="text" class="form-control input-sm" id="addUsername">
								</div>
								<div class="form-group fg-line">
									<label>密码</label>
									<input type="password" class="form-control input-sm" id="addPassword">
								</div>
								<div class="form-group fg-line">
									<label>QQ</label>
									<input type="number" class="form-control input-sm" id="addQQ">
								</div>
								<div class="form-group fg-line">
									<label>用户组</label>
									<select class="form-control" id="addGroup">
										<?php foreach($GroupInfo as $i=>$row){ if($i!=='Guest'){ ?>
										<option value="<?=$i; ?>"><?=$i; ?> (<?=$row['Name']?>)</option>
										<?php }} ?>
									</select>
								</div>
								<p><a class="btn btn-danger" id="add_user">确认添加</a></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
							</div>
						</div>
					</div>
				</div>
				<script>
				var username=userid=status=null;
				$('.edit_user').click(function(){
					var tr=$(this).parent().parent();
					username=$('.edit_username a',tr).html();
					userid=$('.edit_id',tr).html();
					status=tr.attr('edit-status');
					if(status=='On'){
						$('#IsOn').get(0).checked=true;
						$('#BanText').attr('disabled','disabled').val('');
					}else{
						$('#IsOn').get(0).checked=false;
						$('#BanText').removeAttr('disabled').val(status);
					}
					$('#editUsername').val(username);
					$('#editGroup').val(tr.attr('group'));
					$('#editUser .modal-title').html('编辑用户 - '+username+' (UID:'+userid+')');
					$('#editUser').modal('show');
				});
				$('.add_user').click(function(){
					$('#addUser').modal('show');
				});
				$('#IsOn').change(function(){
					if($(this).is(':checked')){
						$('#BanText').attr('disabled','disabled');
					}else{
						$('#BanText').removeAttr('disabled');
					}
				});
				$('#edit_resetpassword').click(function(){
					$.ajax({
						url:'<?=U('func','Admin','ResetPassword')?>',
						dataType:'json',
						cache:false,
						data:{
							UserId:userid
						},
						success:function(data){
							notify(data.Message,(data.Code >= 1 ? 'success' : 'danger'));
						},
						error:function(){
							notify('网络连接失败，请重试！','danger');
						},
						complete:function(){
							$('#editUser').modal('hide');
						}
					});
				});
				$('#edit_deluser').click(function(){
					$.ajax({
						url:'<?=U('func','Admin','DelUser')?>',
						dataType:'json',
						cache:false,
						data:{
							UserId:userid
						},
						success:function(data){
							notify(data.Message,(data.Code >= 1 ? 'success' : 'danger'));
							if(data.Code >= 1)$('tr[userid="'+userid+'"]').remove();
						},
						error:function(){
							notify('网络连接失败，请重试！','danger');
						},
						complete:function(){
							$('#editUser').modal('hide');
						}
					});
				});
				$('#edit_banuser').click(function(){
					$.ajax({
						url:'<?=U('func','Admin','BanUser')?>',
						dataType:'json',
						cache:false,
						data:{
							UserId:userid,
							BanText:($('#IsOn').is(':checked') ? 'On' : $('#BanText').val())
						},
						success:function(data){
							notify(data.Message,(data.Code >= 1 ? 'success' : 'danger'));
							if(data.Code >= 1)$('tr[userid="'+userid+'"]').attr('edit-status',($('#IsOn').is(':checked') ? 'On' : $('#BanText').val()));
						},
						error:function(){
							notify('网络连接失败，请重试！','danger');
						},
						complete:function(){
							$('#editUser').modal('hide');
						}
					});
				});
				$('#edit_save').click(function(){
					$.ajax({
						url:'<?=U('func','Admin','EditUser')?>',
						dataType:'json',
						cache:false,
						data:{
							UserId:userid,
							Username:$('#editUsername').val(),
							Group:$('#editGroup').val()
						},
						success:function(data){
							notify(data.Message,(data.Code >= 1 ? 'success' : 'danger'));
							if(data.Code >= 1){
								$('tr[userid="'+userid+'"]').attr('group',$('#editGroup').val());
								$('tr[userid="'+userid+'"] .userGroup').html($('#editGroup').val());
								$('tr[userid="'+userid+'"] .edit_username a').html($('#editUsername').val());
							}
						},
						error:function(){
							notify('网络连接失败，请重试！','danger');
						},
						complete:function(){
							$('#editUser').modal('hide');
						}
					});
				});
				$('#add_user').click(function(){
					$.ajax({
						url:"<?=U('func','User','Register','Admin')?>",
						dataType:'json',
						cache:false,
						data:{
							Username:$('#addUsername').val(),
							Password:$('#addPassword').val(),
							QQ:$('#addQQ').val(),
							Group:$('#addGroup').val()
						},
						success:function(data){
							notify(data.Message,(data.Code >= 1 ? 'success' : 'danger'));
						},
						error:function(){
							notify('网络连接失败，请重试！','danger');
						},
						complete:function(){
							$('#addUser').modal('hide');
						}
					});
				});
				</script>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>