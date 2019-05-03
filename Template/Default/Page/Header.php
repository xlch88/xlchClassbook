<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'));?>
<?php if($UInfo['UserData']['Public']['Music']){ ?>
<script>
if(typeof(nowPlayId) == "undefined") var nowPlayId = 0;
$(function(){
	var newId = '<?=$UInfo['UserData']['Public']['Music']?>';
	if(nowPlayId != newId){
		notify('正在播放我的主页音乐！','info');
		nowPlayId = newId;
		
		<?php if($WebConfig['Music']['Player'] == 1){ ?>
		$.ajax({
			url:'http://api.badapple.top/new/music.php?do=parse&type=wy&id=',
			method:'get',
			data:{
				id:nowPlayId
			},
			dataType:'jsonp',
			success:function(data){
				console.log(data);
				data['song_id'] = '_'+data['song_id'];
				BadApplePlayer.Play(data);
			}
		});
		<?php }else{ ?>
		$('#MusicPlayer').attr('src',"//music.163.com/outchain/player?type=2&id="+nowPlayId+"&auto=1&height=32");
		<?php } ?>
	}
});
</script>
<?php } ?>
<div class="container container-alt">
	<div class="block-header">
		<h2>
			<?=$UInfo['Username']?>的主页
			<small><?=$UInfo['UserData']['Public']['Sign']?></small>
		</h2>
	</div>
	<div class="card <?=($mod2 == 'Image' ? 'c-timeline' : '')?>" id="profile-main">
		<div class="pm-overview c-overflow">

			<div class="pmo-pic">
				<div class="p-relative">
					<img class="img-responsive" src="<?=UserHead($UInfo['UserData']['Public']['Photo'])?>" alt="">

					<div class="dropdown pmop-message">
						<a data-toggle="dropdown" href="#" class="btn bgm-blue btn-float z-depth-1">
							<i class="fa fa-comment"></i>
						</a>

						<div class="dropdown-menu">
							<textarea placeholder="对Ta留言..."></textarea>
							<label>
								<input type="checkbox" />
								私密
							</label>
							<button class="btn bgm-green btn-float SendThisComment"><i class="fa fa-envelope"></i>
							</button>
							<script>
							$(function(){
								$('.SendThisComment').click(function(){
									var texbox=$('textarea',$(this).parent()),
										tex=texbox.val();
										texbox.val(''),
										isPrivate=$('input[type=checkbox]',$(this).parent()).is(":checked");
									$(texbox).attr('disabled','disabled').attr('placeholder','发送中...');
									$.ajax({
										url:'<?=U('func','Comment','Send')?>',
										dataType:'json',
										method:'post',
										data:{
											Text:tex,
											CommentType:2,
											IsPrivate:isPrivate,
											CommentId:'<?=$UInfo['ID']?>'
										},
										success:function(data){
											if(data.Code == 1){
												$(texbox).attr('placeholder','已发送.').removeAttr('disabled').val('');
												notify('发送成功！','success');
											}else{
												$(texbox).attr('placeholder','发送失败,请重试.').removeAttr('disabled').val(tex);
												notify(data.Message,'danger');
											}
										},
										error:function(){
											$(texbox).attr('placeholder','发送失败,请重试.').removeAttr('disabled').val(tex);
											notify('网络错误！','danger');
										}
									});
								});
							});
							</script>
						</div>
					</div>

					<a href="<?=U('Page','Photo',$Type)?>" class="pmop-edit">
						<i class="fa fa-camera"></i> <span
							class="hidden-xs">上传自拍</span>
					</a>
				</div>


				<div class="pmo-stat bgm-green">
					<h2 class="m-0 c-white"><?=$UInfo['Username'];?> </h2>
					<?=Gender($UInfo['UserData']['MyInfo']['Gender'])?>  <?=GetAge($UInfo['UserData']['MyInfo']['Birthday']);?>
				</div>
			</div>

			<div class="pmo-block pmo-contact hidden-xs">
				<h2>联系方式</h2>

				<ul>
					<li><i class="fa fa-fw fa-qq"></i> <?=($UInfo['UserData']['SocialAccount']['QQ'] ? $UInfo['UserData']['SocialAccount']['QQ'] : '未填写');?></li>
					<li><i class="fa fa-fw fa-envelope"></i> <?=($UInfo['UserData']['ContactMe']['Email'] ? $UInfo['UserData']['ContactMe']['Email'] : '未填写');?></li>
					<li><i class="fa fa-fw fa-phone"></i> <?=($UInfo['UserData']['ContactMe']['Phone'] ? $UInfo['UserData']['ContactMe']['Phone'] : '未填写');?></li>
					<li>
						<i class="fa fa-fw fa-home"></i>
						<address class="m-b-0 ng-binding">
							<?=($UInfo['UserData']['Location']['NowLive'] ? $UInfo['UserData']['Location']['NowLive'] : '未填写');?>
						</address>
					</li>
				</ul>
			</div>

			<div class="pmo-block pmo-items hidden-xs">
				<h2>随机推荐</h2>
				<div class="pmob-body">
					<div class="row">
						<?php foreach($I['Rand'] as $row){ ?>
						<a href="<?=U('Page','Index',$row['ID'])?>" class="col-xs-2">
							<img class="img-circle" src="<?=UserHead($row['HeadUrl'])?>" alt="">
						</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<div class="pm-body clearfix">
			<ul class="tab-nav tn-justified">
				<li class="<?=($mod2 == 'Index' ? 'active' : '');?>"><a href="<?=U('Page','Index',$Type);?>">关于TA</a></li>
				<li class="<?=($mod2 == 'CommentMe' ? 'active' : '');?>"><a href="<?=U('Page','CommentMe',$Type);?>">对Ta留言</a></li>
				<li class="<?=($mod2 == 'Comment' ? 'active' : '');?>"><a href="<?=U('Page','Comment',$Type);?>">TA的留言</a></li>
				<li class="<?=($mod2 == 'Image' ? 'active' : '');?>"><a href="<?=U('Page','Image',$Type);?>">TA的图片</a></li>
				<?php if($UInfo['ID'] == $UserInfo['ID']){ ?><li class="<?=(in_array($mod2,['Option','Photo','Head','User']) ? 'active' : '');?>"><a href="<?=U('Page','Option',$UInfo['ID']);?>">设置</a></li><?php } ?>
			</ul>
			<?php if($UInfo['ID'] == $UserInfo['ID'] && in_array($mod2,['Option','Photo','Head','User'])){ ?>
			<ul class="tab-nav tn-justified">
				<li class="<?=($mod2 == 'Option' ? 'active' : '');?>"><a href="<?=U('Page','Option',$Type);?>">主页选项</a></li>
				<li class="<?=($mod2 == 'Head' ? 'active' : '');?>"><a href="<?=U('Page','Head',$Type);?>">上传头像</a></li>
				<li class="<?=($mod2 == 'Photo' ? 'active' : '');?>"><a href="<?=U('Page','Photo',$Type);?>">上传自拍</a></li>
				<li class="<?=($mod2 == 'User' ? 'active' : '');?>"><a href="<?=U('Page','User',$Type);?>">用户设置</a></li>
			</ul>
			<?php } ?>