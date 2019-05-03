<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'));?>
<div class="container container-alt">
	<div class="block-header">
		<h2>
			同学录
			<small>您可以在这里查阅同学信息，可使用拼音首字母快速查找。</small>
		</h2>
		
	</div>
	<div class="row">
		<div class="col-md-12 pinyinlist">
			拼音：
		</div>
		<?php foreach($I['UserList'] as $Info){ ?>		
		<div username="<?=mb_substr($Info['Username'],0,1,'UTF-8');?>" class="col-md-4 col-sm-6 col-xs-12">
			<?php include(T('_Common/UserCard')); ?>
		</div>
		<?php } ?>
	</div>
	<script>
	$(function(){
		var g=$('div[username]').get();
		var m=new Array();
		for (v in g){
			m.push($(g[v]).attr('username'));
			var k=PinYin.makePy($(g[v]).attr('username'));
			if(k[0]) $(g[v]).attr('pinyin1',k[0],true);
			if(k[1]) $(g[v]).attr('pinyin2',k[1],true);
			if(k[2]) $(g[v]).attr('pinyin3',k[2],true);
		}
		for(var i = 0; i < m.length; i++) {
			if(typeof(m[i]) != 'string' || m[i].length == 0) m.splice(i,1);
		}
		m=unique4(PinYin.makePy(unique4(m)));
		for(var i in m){
			if(m[i].length != 0)$('.pinyinlist').append('<button class="btn btn-default btn-icon waves-effect waves-circle waves-float pinyin" pinyin="'+m[i]+'">'+m[i]+'</button> ');
		}
		$('button.pinyin').click(function(){
			$('div[username]').hide();
			$('div[pinyin1='+$(this).attr('pinyin')+'],div[pinyin2='+$(this).attr('pinyin')+'],div[pinyin3='+$(this).attr('pinyin')+']').show();
			$('button.pinyin').removeClass('bgm-blue');
			$(this).addClass('bgm-blue');
		});
	});
	</script>
</div>
<?php include(T('_Common/Footer'));?>