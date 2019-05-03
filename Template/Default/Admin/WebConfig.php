<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>站点配置</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>站点功能配置
						<small>您能够在这里修改站点名称、SEO、班级密码等信息。</small>
					</h2>
				</div>
				<div class="card-body card-padding">
					<div role="tabpanel" class="tab">
						<ul class="tab-nav" role="tablist">
							<li class="active"><a href="#WebInfo" aria-controls="WebInfo" role="tab" data-toggle="tab" aria-expanded="true">站点信息</a></li>
							<li role="presentation" class=""><a href="#Option" aria-controls="Option" role="tab" data-toggle="tab" aria-expanded="false">功能设置</a></li>
							<li role="presentation" class=""><a href="#ContactInfo" aria-controls="ContactInfo" role="tab" data-toggle="tab" aria-expanded="false">联系信息</a></li>
							<li role="presentation" class=""><a href="#MusicInfo" aria-controls="MusicInfo" role="tab" data-toggle="tab" aria-expanded="false">音乐设置</a></li>
							<li role="presentation" class=""><a href="#FuckRobot" aria-controls="FuckRobot" role="tab" data-toggle="tab" aria-expanded="false">频率限制/防灌水</a></li>
						</ul>
						<form class="form-horizontal" method="post" action="<?=U('Admin','WebConfig','Save')?>">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane animated fadeInRight active" id="WebInfo">
									<div class="form-group">
										<label for="Info_WebName" class="col-sm-2 control-label">站点名称</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" name="Info_WebName" id="Info_WebName" placeholder="" value="<?=$WebConfig['Info']['WebName']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="SEO_Title" class="col-sm-2 control-label">SEO_站点标题</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" name="SEO_Title" id="SEO_Title" placeholder="" value="<?=$WebConfig['SEO']['Title']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="SEO_Description" class="col-sm-2 control-label">SEO_站点描述</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" name="SEO_Description" id="SEO_Description" placeholder="" value="<?=$WebConfig['SEO']['Description']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="SEO_Keywords" class="col-sm-2 control-label">SEO_站点关键字</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" name="SEO_Keywords" id="SEO_Keywords" placeholder="" value="<?=$WebConfig['SEO']['Keywords']?>">
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane animated fadeInRight" id="Option">
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" value="Checked" name="Option_Register" <?=($WebConfig['Option']['Register'] ? 'checked' : '')?>>
													<i class="input-helper"></i>
													启用注册功能（关闭后只能由管理员在后台手动注册）
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="Option_RegisterPassword" class="col-sm-2 control-label">班级密码</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" name="Option_RegisterPassword" id="Option_RegisterPassword" placeholder="注册时需要填写" value="<?=$WebConfig['Option']['RegisterPassword']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" value="Checked" name="Option_ImageDirOnlyAdmin" <?=($WebConfig['Option']['ImageDirOnlyAdmin'] ? 'checked' : '')?>>
													<i class="input-helper"></i>
													只有管理员才能创建相册
												</label>
											</div>
										</div>
									</div>
									<hr></hr>
									<div class="form-group">
										<label for="Option_Color" class="col-sm-2 control-label">标题栏配色</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<div class="select">
													<select class="form-control" id="Option_Color" name="Option_Color">
														<option <?=($WebConfig['Option']['Color'] == 'blue' ? 'selected' : '')?> value="blue">清新蓝</option>
														<option <?=($WebConfig['Option']['Color'] == 'lightblue' ? 'selected' : '')?> value="lightblue">亮蓝色</option>
														<option <?=($WebConfig['Option']['Color'] == 'bluegray' ? 'selected' : '')?> value="bluegray">蓝灰色</option>
														<option <?=($WebConfig['Option']['Color'] == 'teal' ? 'selected' : '')?> value="teal">水鸭蓝</option>
														<option <?=($WebConfig['Option']['Color'] == 'green' ? 'selected' : '')?> value="green">帽子绿</option>
														<option <?=($WebConfig['Option']['Color'] == 'purple' ? 'selected' : '')?> value="purple">基佬紫</option>
														<option <?=($WebConfig['Option']['Color'] == 'orange' ? 'selected' : '')?> value="orange">亮橙色</option>
														<option <?=($WebConfig['Option']['Color'] == 'pink' ? 'selected' : '')?> value="pink">品红色</option>
														<option <?=($WebConfig['Option']['Color'] == 'cyan' ? 'selected' : '')?> value="cyan">青色</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<hr></hr>
									<div class="form-group">
										<label for="Option_ImageUpload" class="col-sm-2 control-label">上传照片到</label>
										<div class="col-sm-10">
											<div class="radio">
												<label class="radio">
													<input type="radio" <?=($WebConfig['Option']['ImageUpload'] == 0 ? 'checked' : '')?> name="Option_ImageUpload" value="0">
													<i class="input-helper"></i>本地服务器
												</label>
											</div>
											<div class="radio">
												<label class="radio">
													<input type="radio" <?=($WebConfig['Option']['ImageUpload'] == 1 ? 'checked' : '')?> name="Option_ImageUpload" value="1">
													<i class="input-helper"></i>搜狐畅言图床(pic.bakayun.cn)
												</label>
											</div>
											<div class="radio">
												<label class="radio">
													<input type="radio" <?=($WebConfig['Option']['ImageUpload'] == 2 ? 'checked' : '')?> name="Option_ImageUpload" value="2">
													<i class="input-helper"></i>sm.ms(sm.ms)
												</label>
											</div>
											<div class="radio">
												<label class="radio">
													<input type="radio" <?=($WebConfig['Option']['ImageUpload'] == 3 ? 'checked' : '')?> name="Option_ImageUpload" value="3">
													<i class="input-helper"></i>七牛云存储
												</label>
											</div>
											<p>温馨提示：为了数据安全起见，我们<b>非常不建议</b>将您与同学的照片存放在公共图床。</p>
											<p>在服务器资源充足的情况下，请将图片存放到本地服务器。</p>
											<p>使用公用图床可能会导致：您的照片丢失、被公开传播、无法删除。</p>
											<p>SM.MS图床有上传限制，上传频率过高会上传失败。</p>
										</div>
									</div>
									<hr></hr>
									<div id="Option_ImageUpload_3" style="display:<?=($WebConfig['Option']['ImageUpload'] == 3 ? 'show' : 'none'); ?>">
										<div class="form-group">
											<label for="Option_Qiniu_accessKey" class="col-sm-2 control-label">accessKey</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<input type="text" class="form-control input-sm" name="Option_Qiniu_accessKey" id="Option_Qiniu_accessKey" placeholder="" value="<?=$WebConfig['Option']['Qiniu']['accessKey']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="Option_Qiniu_secretKey" class="col-sm-2 control-label">secretKey</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<input type="text" class="form-control input-sm" name="Option_Qiniu_secretKey" id="Option_Qiniu_secretKey" placeholder="" value="<?=$WebConfig['Option']['Qiniu']['secretKey']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="Option_Qiniu_bucket" class="col-sm-2 control-label">bucket</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<input type="text" class="form-control input-sm" name="Option_Qiniu_bucket" id="Option_Qiniu_bucket" placeholder="" value="<?=$WebConfig['Option']['Qiniu']['bucket']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="Option_Qiniu_domain" class="col-sm-2 control-label">domain</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<input type="text" class="form-control input-sm" name="Option_Qiniu_domain" id="Option_Qiniu_domain" placeholder="" value="<?=$WebConfig['Option']['Qiniu']['domain']?>">
												</div>
											</div>
										</div>
									</div>
									<script>
									$(function(){
										$('input[name="Option_ImageUpload"][value=0],input[name="Option_ImageUpload"][value=1],input[name="Option_ImageUpload"][value=2]').click(function(){$('#Option_ImageUpload_3').hide();});
										$('input[name="Option_ImageUpload"][value=3]').click(function(){$('#Option_ImageUpload_3').show();});
									});
									</script>
								</div>
								<div role="tabpanel" class="tab-pane animated fadeInRight" id="ContactInfo">
									<div class="form-group">
										<label for="AdminInfo_QQ" class="col-sm-2 control-label">管理员QQ</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" id="AdminInfo_QQ" name="AdminInfo_QQ" placeholder="" value="<?=$WebConfig['AdminInfo']['QQ']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="AdminInfo_WeChat" class="col-sm-2 control-label">管理员微信</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" id="AdminInfo_WeChat" name="AdminInfo_WeChat" placeholder="" value="<?=$WebConfig['AdminInfo']['WeChat']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="AdminInfo_Email" class="col-sm-2 control-label">管理员邮箱</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" id="AdminInfo_Email" name="AdminInfo_Email" placeholder="" value="<?=$WebConfig['AdminInfo']['Email']?>">
											</div>
										</div>
									</div>
									
									<hr />
									
									<div class="form-group">
										<label for="Group_QQ" class="col-sm-2 control-label">班级QQ群号</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" id="Group_QQ" name="Group_QQ" placeholder="" value="<?=$WebConfig['Group']['QQ']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="Group_QQUrl" class="col-sm-2 control-label">班级QQ群加群地址</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="text" class="form-control input-sm" id="Group_QQUrl" name="Group_QQUrl" placeholder="" value="<?=$WebConfig['Group']['QQUrl']?>">
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane animated fadeInRight" id="MusicInfo">
									<div class="form-group">
										<label for="Music_Player" class="col-sm-2 control-label">音乐播放器</label>
										<div class="col-sm-10">
											<div class="radio">
												<label class="radio">
													<input type="radio" <?=($WebConfig['Music']['Player'] == 0 ? 'checked' : '')?> name="Music_Player" value="0">
													<i class="input-helper"></i>关闭音乐播放功能
												</label>
											</div>
											<div class="radio">
												<label class="radio">
													<input type="radio" <?=($WebConfig['Music']['Player'] == 1 ? 'checked' : '')?> name="Music_Player" value="1">
													<i class="input-helper"></i>绚丽彩虹播放器 (www.badapple.top)
												</label>
											</div>
											<div class="radio">
												<label>
													<input type="radio" <?=($WebConfig['Music']['Player'] == 2 ? 'checked' : '')?> name="Music_Player" value="2">
													<i class="input-helper"></i>网易云音乐官方播放器 (几乎失效)
												</label>
											</div>
										</div>
									</div>
									<hr></hr>
									<div id="Music_Player_1" style="display:<?=($WebConfig['Music']['Player'] == 1 ? 'show' : 'none'); ?>">
										<div class="form-group">
											<label for="Music_BadApplePlayer_Key" class="col-sm-2 control-label">绚丽彩虹播放器Key</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<input type="text" class="form-control input-sm" name="Music_BadApplePlayer_Key" id="Music_BadApplePlayer_Key" placeholder="" value="<?=$WebConfig['Music']['BadApplePlayer']['Key']?>">
												</div>
											</div>
										</div>
									</div>
									<div id="Music_Player_2" style="display:<?=($WebConfig['Music']['Player'] == 2 ? 'show' : 'none'); ?>">
										<div class="form-group">
											<label for="Music_Type" class="col-sm-2 control-label">网易ID类型</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<div class="select">
														<select class="form-control" id="Music_Type" name="Music_Type">
															<option <?=($WebConfig['Music']['Type'] == 1 ? 'selected' : '')?> value="1">网易云音乐单曲</option>
															<option <?=($WebConfig['Music']['Type'] == 2 ? 'selected' : '')?> value="2">网易云音乐歌单</option>
															<option <?=($WebConfig['Music']['Type'] == 3 ? 'selected' : '')?> value="3">网易云音乐电台</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="Music_Id" class="col-sm-2 control-label">网易ID值</label>
											<div class="col-sm-10">
												<div class="fg-line">
													<input type="text" class="form-control input-sm" name="Music_Id" id="Music_Id" placeholder="" value="<?=$WebConfig['Music']['Id']?>">
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-2 col-sm-10">
												<div class="checkbox">
													<label>
														<input type="checkbox" name="Music_Auto" value="Checked" <?=($WebConfig['Music']['Auto'] ? 'checked' : '')?>>
														<i class="input-helper"></i>
														自动播放
													</label>
												</div>
											</div>
										</div>
									</div>
									<script>
									$(function(){
										$('input[name="Music_Player"][value=0]').click(function(){$('#Music_Player_1,#Music_Player_2').hide();});
										$('input[name="Music_Player"][value=1]').click(function(){$('#Music_Player_2').hide();$('#Music_Player_1').show();});
										$('input[name="Music_Player"][value=2]').click(function(){$('#Music_Player_1').hide();$('#Music_Player_2').show();});
									});
									</script>
								</div>
								<div role="tabpanel" class="tab-pane animated fadeInRight" id="FuckRobot">
									<div class="form-group">
										<label class="col-sm-offset-2 col-sm-10">以下设置仅对Default(学生组)生效，管理组忽略此设定。</label>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="FuckRobot_Comment_Open" value="Checked" <?=($WebConfig['FuckRobot']['Comment']['Open'] ? 'checked' : '')?>>
													<i class="input-helper"></i>
													开启留言频率限制
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="FuckRobot_Comment_Send" class="col-sm-2 control-label">每1小时内最多发送留言数</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="number" class="form-control input-sm" name="FuckRobot_Comment_Send" id="FuckRobot_Comment_Send" placeholder="" value="<?=$WebConfig['FuckRobot']['Comment']['Send']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="FuckRobot_Comment_Reply" class="col-sm-2 control-label">每1小时内最多回复留言数</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="number" class="form-control input-sm" name="FuckRobot_Comment_Reply" id="FuckRobot_Comment_Reply" placeholder="" value="<?=$WebConfig['FuckRobot']['Comment']['Reply']?>">
											</div>
										</div>
									</div>
									
									<hr />
									
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="FuckRobot_Image_Open" value="Checked" <?=($WebConfig['FuckRobot']['Image']['Open'] ? 'checked' : '')?>>
													<i class="input-helper"></i>
													开启图片频率限制
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="FuckRobot_Comment_Send" class="col-sm-2 control-label">每1天最多可创建相册数</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="number" class="form-control input-sm" name="FuckRobot_Image_Dir" id="FuckRobot_Image_Dir" placeholder="" value="<?=$WebConfig['FuckRobot']['Image']['Dir']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="FuckRobot_Comment_Reply" class="col-sm-2 control-label">每1小时最多上传照片数</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="number" class="form-control input-sm" name="FuckRobot_Image_Pic" id="FuckRobot_Image_Pic" placeholder="" value="<?=$WebConfig['FuckRobot']['Image']['Pic']?>">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for="FuckRobot_Comment_Reply" class="col-sm-2 control-label">照片最大上传大小(单位KB,1024KB = 1MB)</label>
										<div class="col-sm-10">
											<div class="fg-line">
												<input type="number" class="form-control input-sm" name="FuckRobot_Image_Size" id="FuckRobot_Image_Size" placeholder="" value="<?=$WebConfig['FuckRobot']['Image']['Size']?>">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="fg-line">
										<button class="btn btn-lg bgm-blue btn-block">保存</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>