<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('Page/Header'));?>
<div class="pmb-block">
	<form action="<?=U('Page','Option',$Type,'Save')?>" method="post" id="OptionFrom" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">BGM</label>
			<div class="col-sm-10">
				<div class="fg-line">
					当前音乐：<font id="NowMusic" class="c-blue"><?php if($UInfo['UserData']['Public']['Music']){ echo 'Loading...'; } else { echo '未设置'; }?></font>
					<input type="text" onkeydown="if(event.keyCode==13)return false;" class="form-control input-sm" id="MusicSearch" placeholder="输入歌名并回车进行搜索">
					<p id="MusicSearch_tip" style="display:none">请在下方选择音乐：</p>
					<select name="Music" id="MusicSearch_List" style="display:none" class="form-control input-sm">
					</select>
				</div>
				<script>
				$(function(){
					<?php if($UInfo['UserData']['Public']['Music']){ ?>
					$.ajax({
						type: "get",
						url: "http://api.badapple.top/new/music.php?do=parse&type=wy&id=<?=$UInfo['UserData']['Public']['Music']?>",
						async: true,
						dataType: "jsonp",
						json: "",
						success: function(data) {
							$('#NowMusic').html(data["artist_name"]+' - '+data["song_name"]);
						},
						error: function(error) {
							alert('创建连接失败');
						}
					});
					<?php } ?>
					$("#MusicSearch").keyup(function(e){
						if(e.keyCode==13||e.which==13){
							url=$("#MusicSearch").val();
							$('#MusicSearch_List').html('<option>Loading...</option>').show();
							html="";
							$.ajax({
								type: "get",
								url: "http://api.badapple.top/new/WebAPI.php?Type=Search&s="+url,
								async: true,
								dataType: "json",
								json: "",
								success: function(data) {
									for(x in data["result"]["songs"]){
										html+='<option value="'+data["result"]["songs"][x]["id"]+'">'+data["result"]["songs"][x]["artists"][0]["name"]+' - '+data["result"]["songs"][x]["name"]+'</option>';
									}
									$('#MusicSearch_List').html(html).show();
									$('#MusicSearch_tip').show();
								},
								error: function(error) {
									alert('创建连接失败');
								}
							});
						}
					});
				});
				</script>
			</div>
		</div>
		<!-- 暂时弃用 <div class="form-group">
			<label class="col-sm-2 control-label">主页特效</label>
			<div class="col-sm-10">
				<?php foreach(['关闭','流星','樱花','下雪','下雨'] as $x=>$row){ ?>
				<label class="radio radio-inline m-r-20">
					<input type="radio" name="PageJS" <?=($UInfo['UserData']['Public']['PageJs'] == $x ? 'checked' : '')?> value="<?=$x?>">
					<i class="input-helper"></i>
					<?=$row?>
				</label>
				<?php } ?>
			</div>
		</div>-->
		<div class="form-group">
			<label class="col-sm-2 control-label">资料卡背景</label>
			<div class="col-sm-10">
				<?php foreach($UserCardBg as $x=>$row){ ?>
				<div class="radio m-b-15">
					<label>
						<input type="radio" <?=($UInfo['UserData']['Public']['CardBg'] == $x ? 'checked' : '')?> name="CardBg" value="<?=$x?>">
						<i class="input-helper"></i>
						<img src="<?=$row?>" class="img-responsive">
					</label>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary btn-lg btn-block waves-effect">保存</button>
			</div>
		</div>
	</form>
</div>
<?php include(T('Page/Footer'));?>