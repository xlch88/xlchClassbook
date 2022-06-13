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
					<!-- <li><a target="_blank" href="http://flandre-studio.cn/">绚丽彩虹工作室</a></li> -->
					<!-- <li><a target="_blank" href="http://xlch.me/">绚丽博客</a></li> -->
					<li><a target="_blank" href="https://github.com/xlch88/xlchClassbook"><i class="fa fa-github"></i> Github</a></li>
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
		
		<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="/assets/vendor/moment/moment.min.js"></script>	
		<script src="/assets/js/waves.min.js?v=<?=$Version_?>"></script>	
		<script src="/assets/js/bootstrap-growl.min.js?v=<?=$Version_?>"></script>	
		<script src="/assets/vendor/sweetalert2/sweetalert2.min.js"></script>
		<script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>	
		<script src="/assets/vendor/lightgallery/js/lightgallery.js"></script>	
		<script src="/assets/js/bootstrap-datetimepicker.zh-CN.js?v=<?=$Version_?>"></script>	
		<script src="/assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>	
		<script src="/assets/vendor/bootstrap-validator/js/bootstrapValidator.js"></script>
		<script src="/assets/vendor/cropper/cropper.min.js"></script>	
		<script src="/assets/js/webuploader.js?v=<?=$Version_?>"></script>			
		<script src="/assets/kindeditor/kindeditor-min.js?v=<?=$Version_?>"></script>	
		<script src="/assets/kindeditor/zh_CN.js?v=<?=$Version_?>"></script>	
		<script src="/assets/vendor/salvattore/salvattore.min.js"></script>	
		<script src="/assets/js/topinyin.js?v=<?=$Version_?>"></script>
		<script src="/assets/js/jquery.emoji.min.js?v=<?=$Version_?>"></script>
		<script src="/assets/js/app.min.js?v=<?=$Version_?>"></script>
		
		<!-- Pjax -->
		<script src="/assets/vendor/jquery-pjax/jquery.pjax.min.js"></script>		
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
				url: '/assets/vendor/bootstrap/js/bootstrap.min.js',
				cache: true,
				dataType: 'script'
			});
			$.ajax({
				url: '/assets/vendor/salvattore/salvattore.min.js',
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