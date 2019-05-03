<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('Page/Header'));?>
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="fa fa-book m-r-10"></i> 个人介绍</h2>
									<?php if($UInfo['ID'] == $UserInfo['ID']){ ?>
                                    <ul class="actions">
                                           <a href="" data-ma-action="profile-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                    </ul>
									<?php } ?>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
                                        <?=nl2br($UInfo['UserData']['Public']['Sign']);?>
                                    </div>

                                    <div class="pmbb-edit">
										
										<form action="" method="post" id="SubmitSign">
                                        <div class="fg-line">
                                            <textarea class="form-control" rows="5"  placeholder="写点什么吧..." id="EditSign"><?=$UInfo['UserData']['Public']['Sign']?></textarea>
                                        </div>
                                        <div class="m-t-10">
											<button type="submit" class="btn btn-primary btn-sm">保存</button>
											<button data-ma-action="profile-edit-cancel" class="btn btn-link btn-sm">取消</button>
                                        </div>
										</form>
										<script>
												$('#SubmitSign').submit(function(){
													var This=$(this);
													$('button[type=submit]',This).attr('disabled','disabled');
													$.ajax({
														url:'<?=U('func','SaveInfo','SaveSign')?>',
														dataType:'json',
														method:'post',
														data:{
															Sign:$('#EditSign').val()
														},
														success:function(data){
															notify(data.Message,(data.Code == 1 ? 'success' : 'danger'));
															if(data.Code == 1){
																$('button[data-ma-action="profile-edit-cancel"]',This).click();
																$('.pmbb-view',This.parent().parent().parent()).html($('#EditSign').val().replace(/[\n\r]/g,"</br>"));
															}
															$('button[type=submit]',This).removeAttr('disabled');
														},
														error:function(){
															notify('网络错误！请重试！','danger');
															$('button[type=submit]',This).removeAttr('disabled');
														}
													});
													return false;
												});
										</script>
                                    </div>
                                </div>
                            </div>
							<!-- 信息 -->
							<?php foreach($UserInfoList as $GroupI=>$Group){ ?>
                            <div class="pmb-block">
                                <div class="pmbb-header">
                                    <h2><i class="fa fa-<?=$Group['Icon']?> m-r-10"></i> <?=$Group['GroupName']?></h2>
									<?php if($UInfo['ID'] == $UserInfo['ID']){ ?>
                                    <ul class="actions">
                                           <a href="" data-ma-action="profile-edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                    </ul>
									<?php } ?>
                                </div>
                                <div class="pmbb-body p-l-30">
                                    <div class="pmbb-view">
										<?php foreach($Group['Key'] as $Key){ ?>
                                        <dl class="dl-horizontal">
                                            <dt><i class="fa fa-fw fa-<?=$Key['Icon'];?>"></i> <?=$Key['Name']?></dt>
                                            <dd id="Show_<?=$Group['GroupId']?>_<?=$Key['Id'];?>" class="Show_<?=$Group['GroupId']?>">
											<?=($Key['Header'] ? $Key['Header'] : '')?>
											<?php
											$Value=$UInfo['UserData'][$Group['GroupId']][$Key['Id']];
											switch ($Key['Type']){
												case 'Select':
													$Output=$Key['Option'][$Value];
													break;
												case 'Radio':
													$Output=$Key['Option'][$Value];
													break;
												case 'Date':
													$Output=date('Y年n月d日',strtotime($UInfo['UserData'][$Group['GroupId']][$Key['Id']]));
													break;
												case 'Check':
													foreach($Value as $i=>$rw){
														$Value[$i]=$Key['Option'][$rw];
													}
													$Output=implode(' ',$Value);
													break;
												default:
													$Output=$UInfo['UserData'][$Group['GroupId']][$Key['Id']];
											}
											echo ($Output ? ($Output . ($Key['Footer'] ? $Key['Footer'] : '')) : '未填写');
											?>
											</dd>
                                        </dl>
										<?php } ?>
                                    </div>

									<?php if($UInfo['ID'] == $UserInfo['ID']){ ?>
                                    <div class="pmbb-edit">
										<form action="" method="post" id="Group_<?=$Group['GroupId']?>">
											<?php foreach($Group['Key'] as $Key){ ?>
											<dl class="dl-horizontal">
												<dt class="p-t-10"><?=$Key['Name']?></dt>
												<dd><?php
													switch ($Key['Type']){
														case 'Select': 
													?>
													<div class="form-group">
														<?=($Key['Header'] ? $Key['Header'] : '')?>
														<div class="fg-line">
															<select id="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" name="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" class="form-control">
																<?php foreach($Key['Option'] as $i=>$Option){ ?>
																<option <?=($UInfo['UserData'][$Group['GroupId']][$Key['Id']]==$i ? 'selected' : '')?> value="<?=$i?>"><?=$Option?></option>
																<?php } ?>
															</select>
														</div>
														<?=($Key['Footer'] ? $Key['Footer'] : '')?>
													</div>
													<?php
														break;
														case 'Date':
													?>
													<div class="form-group">
														<div class="dtp-container dropdown fg-line">
															<?=($Key['Header'] ? $Key['Header'] : '')?>
															<input id="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" name="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" value="<?=$UInfo['UserData'][$Group['GroupId']][$Key['Id']]?>" type='text' readonly="readonly" class="form-control date-picker" data-toggle="dropdown" placeholder="点击选择...">
															<?=($Key['Footer'] ? $Key['Footer'] : '')?>
														</div>
													</div>
													<?php
														break;
														case 'Check':
													?>
													<div class="form-group">
														<div class="dtp-container dropdown fg-line">
															<?=($Key['Header'] ? $Key['Header'] : '')?>
															<?php foreach($Key['Option'] as $i=>$Option){ ?>
															<label>
																<input <?=(in_array($i,$UInfo['UserData'][$Group['GroupId']][$Key['Id']]) ? 'checked' : '')?> id="<?=$Group['GroupId'];?>_<?=$Key['Id']?>_<?=$i?>" name="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" type="checkbox" value="<?=$i?>">
																<i class="input-helper"></i>
																<?=$Option?>
															</label>
															<?php } ?>
															<?=($Key['Footer'] ? $Key['Footer'] : '')?>
														</div>
													</div>
													<?php
														break;
														case 'Radio':
													?>
													<div class="form-group">
														<div class="dtp-container dropdown fg-line">
															<?=($Key['Header'] ? $Key['Header'] : '')?>
															<?php foreach($Key['Option'] as $i=>$Option){ ?>
															<label class="radio radio-inline m-r-20">
																<input type="radio" <?=($UInfo['UserData'][$Group['GroupId']][$Key['Id']]==$i ? 'checked' : '')?> id="<?=$Group['GroupId'];?>_<?=$Key['Id']?>_<?=$i?>" name="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" value="<?=$i?>">
																<i class="input-helper"></i>
																<?=$Option?>
															</label>
															<?php } ?>
															<?=($Key['Footer'] ? $Key['Footer'] : '')?>
														</div>
													</div>
													<?php 
														break;
														default:
													?>
													<div class="form-group">
														<div class="fg-line">
															<?=($Key['Header'] ? $Key['Header'] : '')?>
															<input id="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" name="<?=$Group['GroupId'];?>_<?=$Key['Id']?>" value="<?=$UInfo['UserData'][$Group['GroupId']][$Key['Id']]?>" type="<?=$Key['Type']?>" class="form-control" placeholder="<?=$Key['Name']?>">
															<?=($Key['Footer'] ? $Key['Footer'] : '')?>
														</div>
													</div>
													<?php } ?>
												</dd>
											</dl>
											<?php } ?>
											<div class="m-t-30">
												<button type="submit" class="btn btn-primary btn-sm" disabled>保存</button>
												<button data-ma-action="profile-edit-cancel" class="btn btn-link btn-sm">取消</button>
											</div>
											<script>
											$(function(){
												$('#Group_<?=$Group['GroupId']?>').bootstrapValidator({
													feedbackIcons: {/*input状态样式图片*/
														valid: 'fa fa-ok',
														invalid: 'fa fa-remove',
														validating: 'fa fa-refresh'
													},
													fields: {
														<?php foreach($Group['Key'] as $Key){if(!in_array($Key['Type'],['Radio','Select','Check'])){ ?>
														 '<?=$Group['GroupId'];?>_<?=$Key['Id']?>': {//验证input项：验证规则
															validators: {
																<?php if($Key['MaxLength'] or $Key['MinLength']){ ?>
																stringLength: {
																	<?php if($Key['MinLength']){ ?>min: <?=$Key['MinLength']?>,<?php } ?>
																	<?php if($Key['MaxLength']){ ?>max: <?=$Key['MaxLength']?>,<?php } ?>
																},
																<?php } ?>
																<?php if($Key['Preg']){ ?>
																	<?php if(in_array($Key['Preg'],['base64','between','callback','choice','color','creditCard','cusip','cvv','date','different','digits','ean','emailAddress','file','greaterThan','grid','hex','hexColor','iban','id','identical','imei','imo','integer','ip','isbn','isin','ismn','issn','lessThan','mac','meid','notEmpty','numeric','phone','regexp','remote','rtn','sedol','siren','siret','step','stringCase','stringLength','uri','uuid','vat','vin','zipCode'])){ ?>
																	<?=$Key['Preg']?>:{country:'CN'},
																	<?php }else{ ?>
																	regexp: {
																		regexp: <?=$Key['Preg']?>,
																		message:'<?=$Key['Name']?>格式错误。'
																	},
																	<?php } ?>
																<?php } ?>
																
															}
														},
														<?php }else{ ?>
															'<?=$Group['GroupId'];?>_<?=$Key['Id']?>': {},
														<?php }} ?>
													}
												});
												IsLoad_Group_<?=$Group['GroupId']?>=false;
												$('#Group_<?=$Group['GroupId']?>').submit(function(){
													if(IsLoad_Group_<?=$Group['GroupId']?>)return false;
													IsLoad_Group_<?=$Group['GroupId']?>=true;
													
													var This=$(this);
													var w=$("input[data-bv-submit-hidden!=''],select",This);
													var save=new Object();
													
													$(".Show_<?=$Group['GroupId']?>").html('');
													
													for(var x=0;x<w.length;x++){
														if($(w[x]).attr("type")=='checkbox'){
															if(w[x].checked){
																if(!save[$(w[x]).attr("name")])save[$(w[x]).attr("name")]=new Array();
																save[$(w[x]).attr("name")].push($(w[x]).val());
																$('#Show_'+$(w[x]).attr("name")).append($(w[x]).parent().text());
															}
														}else if($(w[x]).attr("type")=='radio'){
															if(w[x].checked){
																save[$(w[x]).attr("name")]=$(w[x]).val();
																$('#Show_'+$(w[x]).attr("name")).html($(w[x]).parent().text());
															}
														}else{
															save[$(w[x]).attr("name")]=$(w[x]).val();
															if(w[x].tagName=='SELECT'){
																$('#Show_'+$(w[x]).attr("name")).html($('option:selected',$(w[x])).html());
															}else{
																$('#Show_'+$(w[x]).attr("name")).html(save[$(w[x]).attr("name")]);
															}
														}
													}
													save=JSON.stringify(save);
													$.ajax({
														url:'<?=U('func','SaveInfo','SaveInfo',"$GroupI")?>',
														dataType:'json',
														method:'post',
														data:{
															Json:save
														},
														success:function(data){
															IsLoad_Group_<?=$Group['GroupId']?>=false;
															notify(data.Message,(data.Code == 1 ? 'success' : 'danger'));
															if(data.Code == 1){
																$('button[data-ma-action="profile-edit-cancel"]',This).click();
																$('button[type=submit]',This).attr('disabled','disabled');
															}else{
																$('button[type=submit]',This).removeAttr('disabled');
															}
														},
														error:function(){
															IsLoad_Group_<?=$Group['GroupId']?>=false;
															notify('网络错误！请重试！','danger');
															$('button[type=submit]',This).removeAttr('disabled');
														}
													});
													return false;
												});
											});
											</script>
										</form>
                                    </div>
									<?php } ?>
                                </div>
                            </div>
							<?php } ?>
<?php include(T('Page/Footer'));?>