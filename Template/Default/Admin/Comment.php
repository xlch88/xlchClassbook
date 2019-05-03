<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>留言管理</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2>留言列表
						<small>您能够删除同学们发布的不当留言。</small>
					</h2>
				</div>
				<?php if($I['CommentList']){ ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>发布者</th>
								<th>留言操作</th>
								<th>留言内容</th>
								<th>留言时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($I['CommentList'] as $row){ ?>
							<tr>
								<td class="edit_id"><?=$row['ID']?></td>
								<td><a href="<?=U('Page','Index',$row['ID'])?>"><?=$row['Username']?> (UID:<?=$row['UserId']?>)</a></td>
								<td>
								<?php if($row['Type'] != '0'){ ?>
									<?php if($row['Type'] == '1'){ ?>
									<font class="c-green">回复留言</font> <font class="c-red">(ID:<?=$row['To']?>)</font>
									<?php }else if($row['Type'] == '2'){ ?>
									<font class="c-green">对用户</font> <a href="<?=U('Page','Index',$row['To'])?>" class="c-purple"><?=$row['ToName']?></a> <font class="c-red">(ID:<?=$row['To']?>)</font> <font class="c-green">发表留言</font>
									<?php }else if($row['Type'] == '3'){ ?>
									<font class="c-green">对相册</font> <a href="<?=U('Image','Show',$row['To'])?>" class="c-purple"><?=$row['ToName']?></a> <font class="c-red">(ID:<?=$row['To']?>)</font> <font class="c-green">发表留言</font>
									<?php } ?>
								<?php }else{ ?>
									留言板留言
								<?php } ?>
								<?php if($row['Private'] == '1'){ ?>
								<b class="c-red">[私密留言]</b>
								<?php } ?>
								</td>
								<td><?=$row['Text']?></td>
								<td><?=$row['AddDate']?></td>
								<td><a class="btn btn-primary edit_user">管理留言</a></td>
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
								<h4 class="modal-title">留言操作</h4>
							</div>
							<div class="modal-body">
								<div role="tabpanel">
									<ul class="tab-nav" role="tablist">
										<li class="active"><a href="#Del" aria-controls="Del" role="tab" data-toggle="tab" aria-expanded="false">删除评论</a></li>
									</ul>

									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="Del">
											<p>使用此功能将会删除该评论，且不可恢复。</p>
											<p>如果您无故删除其他同学的正常评论，可能会引起公愤。</p>
											<p>确认要删除吗？</p>
											<br>
											<p><a class="btn btn-danger" id="edit_delcomment">确认删除</a></p>
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
				<script>
				var cid=null;
				var tr=null;
				$('.edit_user').click(function(){
					tr=$(this).parent().parent();
					cid=$('.edit_id',tr).html();
					$('#editUser .modal-title').html('编辑留言 (ID:'+cid+')');
					$('#editUser').modal('show');
				});
				$('#edit_delcomment').click(function(){
					$.ajax({
						url:'<?=U('func','Admin','DelComment')?>',
						dataType:'json',
						cache:false,
						data:{
							CommentId:cid
						},
						success:function(data){
							notify(data.Message,(data.Code >= 1 ? 'success' : 'danger'));
							if(data.Code >= 1)$(tr).remove();
						},
						error:function(){
							notify('网络连接失败，请重试！','danger');
						},
						complete:function(){
							$('#editUser').modal('hide');
						}
					});
				});
				</script>
				<?php }else{ ?>
				<div class="pmb-block tip_none">
					<p class="tip_tq">_(:з」∠)_</p>
					<p class="tip_t">空空如也...</p>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>