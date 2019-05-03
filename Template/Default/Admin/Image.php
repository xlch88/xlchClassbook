<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>相册管理</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2>相册列表
						<small>您能够修改、删除同学们上传的相册。</small>
					</h2>
				</div>
				<?php if($I['ImageDirList']){ ?>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>相册名称</th>
								<th>相册介绍</th>
								<th>创建者</th>
								<th>上传权限</th>
								<th>创建日期</th>
								<th>图片数量</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($I['ImageDirList'] as $row){ ?>
							<tr>
								<td><?=$row['ID']?></td>
								<td><?=$row['Name']?></td>
								<td><?=$row['Bewrite']?></td>
								<td><a href="<?=U('Page','Index',$row['ID'])?>"><?=$row['Username']?> (UID:<?=$row['CreaterId']?>)</a></td>
								<td><?=($row['AnybodyUpload'] ? '任何人' : '仅创建者')?></td>
								<td><?=$row['AddDate']?></td>
								<td><?=$row['ImageNumber']?></td>
								<td><a href="<?=U('Image','Edit','Edit',$row['ID'],'Admin=True');?>" class="btn btn-primary">管理相册</a></td>
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