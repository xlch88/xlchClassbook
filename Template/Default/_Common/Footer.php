<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
					</section>
			</section>
			<footer id="footer">
				<!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
				绚丽彩虹同学录 版权 请勿修改、删除 !否则视为违反使用协议!
				■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
				Copyright &copy; <?=date('Y')?> 绚丽彩虹工作室 Flandre-Studio.cn
				<ul class="f-menu">	
					<!-- 绚丽彩虹同学录 友情链接 建议您不要去除  -->
					<li><a target="_blank" href="http://flandre-studio.cn/">绚丽彩虹工作室</a></li>
					<li><a target="_blank" href="http://xlch.me/">绚丽博客</a></li>
				</ul>
				
				<!-- 绚丽彩虹同学录 用户使用情况统计 建议您不要去除 -->
				<script>
				var _hmt = _hmt || [];
				(function() {
					var hm = document.createElement("script");
					hm.src = "https://hm.baidu.com/hm.js?8cb438bb06fb18480fa6abe66b34eafe";
					var s = document.getElementsByTagName("script")[0]; 
					s.parentNode.insertBefore(hm, s);
				})();
				</script>
			</footer>
		</section>
		<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//lib.baomitu.com/moment.js/2.18.1/moment.min.js"></script>	
		<script src="/assets/js/waves.min.js?v=<?=$Version_?>"></script>	
		<script src="/assets/js/bootstrap-growl.min.js?v=<?=$Version_?>"></script>	
		<script src="//lib.baomitu.com/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
		<script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>	
		<script src="//lib.baomitu.com/lightgallery/1.3.9/js/lightgallery.js"></script>	
		<script src="/assets/js/bootstrap-datetimepicker.zh-CN.js?v=<?=$Version_?>"></script>	
		<script src="//lib.baomitu.com/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>	
		<script src="//lib.baomitu.com/bootstrap-validator/0.5.3/js/bootstrapValidator.js"></script>
		<script src="//lib.baomitu.com/cropper/3.0.0-rc.1/cropper.min.js"></script>	
		<script src="/assets/js/webuploader.js?v=<?=$Version_?>"></script>			
		<script src="/assets/kindeditor/kindeditor-min.js?v=<?=$Version_?>"></script>	
		<script src="/assets/kindeditor/zh_CN.js?v=<?=$Version_?>"></script>	
		<script src="//lib.baomitu.com/salvattore/1.0.9/salvattore.min.js"></script>	
		<script src="/assets/js/topinyin.js?v=<?=$Version_?>"></script>
		<script src="/assets/js/jquery.emoji.min.js?v=<?=$Version_?>"></script>
		<script src="/assets/js/app.min.js?v=<?=$Version_?>"></script>
			
		<!-- Placeholder for IE9 -->	
		<!--[if IE 9 ]>			
		<script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>	
		<![endif]-->	
		<!-- Pjax -->	

		
		<script src="//lib.baomitu.com/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>		
		<script>
		function regpjax() {
			$(document).pjax('a[target!="_blank"][pjax!="no"][href!="#"]', '#main', {
				fragment: '#main',
				timeout: 6000
			});
			
			$(document).on('submit', 'form[pjax!="no"][target!="_blank"]',function(event) {
				$.pjax.submit(event, '#main', {
					fragment: '#main',
					timeout: 6000
				});
			});
			
			$(document).on('pjax:send',function() {
				$(".xlch_pjax_loading_frame, .xlch_pjax_loading").show();
				$(document).off();
				$('body').off();
				regpjax();
				$('#page').addClass('blur');
				$('#loading,#loading1').show();
			});
			
			$(document).on('pjax:complete',function() {
				$(".xlch_pjax_loading_frame, .xlch_pjax_loading").hide();
				ReloadJs();
				$('#page').removeClass('blur');
				$('#loading,#loading1').hide();
				
				//如果去除百度统计代码，这个也一块去掉
				_hmt.push(['_trackPageview', window.location.href]);
			});
		}
		function ReloadJs() {
			$.ajax({
				url: '/assets/js/app.min.js?v=<?=$Version_?>',
				cache: true,
				dataType: 'script'
			});
			$.ajax({
				url: '//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js',
				cache: true,
				dataType: 'script'
			});
			$.ajax({
				url: '//lib.baomitu.com/salvattore/1.0.9/salvattore.min.js',
				cache: true,
				dataType: 'script'
			});
		}
		regpjax();
		</script>
		<!-- /Pjax -->
		
		<?php if($WebConfig['Music']['Player'] == 1) include(T('_Common/BadApplePlayer')); ?>
	</body>
</html>