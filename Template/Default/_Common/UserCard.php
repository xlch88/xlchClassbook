<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<div class="card profile-view usercard">
	<div class="pv-header" style="background-image: url(<?=GetUserCardBg($Info)?>);">
		<a href="<?=U('Page','Index',$Info['ID'])?>"><img src="<?=UserHead($Info['HeadUrl'])?>" class="pv-main" alt=""></a>
	</div>
	<div class="pv-body">
		<a href="<?=U('Page','Index',$Info['ID'])?>"><h2><?=$Info['Username']?> <small><font color="<?=$GroupInfo[$Info['Group']]['Color']?>">[<?=$GroupInfo[$Info['Group']]['Name']?>]</font></small></h2></a>
		<small>
			<?=$Info['UserData']['Public']['Sign'];?>
		</small>
		<ul class="pv-contact">
			<li><?=Gender($Info['UserData']['MyInfo']['Gender'])?></li>
			<li><?=GetAge($Info['UserData']['MyInfo']['Birthday'])?></li>
			<li><?php $f=$UserInfoList[0]['Key'][3]['Option'][$Info['UserData']['MyInfo']['Constellation']]; echo ($f ? $f : '未填写星座')?></li>
		</ul>
		<a href="<?=U('Page','Index',$Info['ID'])?>" class="btn btn-success"><i class="fa fa-home"></i> 主页</a>
		<a href="<?=U('Page','Comment',$Info['ID'])?>" class="btn bgm-cyan"><i class="fa fa-comment"></i> 留言</a>
		<a href="<?=U('Page','Image',$Info['ID'])?>" class="btn bgm-blue"><i class="fa fa-image"></i> 相册</a>
	</div>
	<ul class="list-group">
		<li class="list-group-item"><i class="fa fa-phone fa-fw"></i> 手机号：<?=($Info['UserData']['ContactMe']['Phone'] ? $Info['UserData']['ContactMe']['Phone'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-birthday-cake fa-fw"></i> 生　日：<?=($Info['UserData']['MyInfo']['Birthday'] ? $Info['UserData']['MyInfo']['Birthday'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-globe fa-fw"></i> 年　龄：<?=($Info['UserData']['MyInfo']['Birthday'] ? GetAge($Info['UserData']['MyInfo']['Birthday']) : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-leaf fa-fw"></i> 座右铭：<?=($Info['UserData']['MyInfo']['Motto'] ? $Info['UserData']['MyInfo']['Motto'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-qq fa-fw"></i> Ｑ　Ｑ：<?=($Info['UserData']['SocialAccount']['QQ'] ? $Info['UserData']['SocialAccount']['QQ'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-wechat fa-fw"></i> 微　信：<?=($Info['UserData']['SocialAccount']['WeChat'] ? $Info['UserData']['SocialAccount']['WeChat'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-heart-o fa-fw"></i> 擅长做：<?=($Info['UserData']['LikeAndDislike']['BeGoodAt'] ? $Info['UserData']['LikeAndDislike']['BeGoodAt'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-home fa-fw"></i> 故　乡：<?=($Info['UserData']['Location']['Hometown'] ? $Info['UserData']['Location']['Hometown'] : '未填写')?></li>
		<li class="list-group-item"><i class="fa fa-hotel fa-fw"></i> 居住在：<?=($Info['UserData']['Location']['NowLive'] ? $Info['UserData']['Location']['NowLive'] : '未填写')?></li>
	</ul>
</div>