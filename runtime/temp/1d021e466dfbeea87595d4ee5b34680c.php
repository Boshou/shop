<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpstudy_pro\WWW\wps.bobo.com\public/../application/demo\view\index\index.html";i:1575017645;}*/ ?>
<!DOCTYPE html>
<html>

	<head>


	</head>

	<body id="">
		<a href="https://www.baidu.com" class="btn-success">链接</a>

	<!-- <div >1</div> -->
	<button id="hodlon">点击</button>
		<!-- jQuery -->
		<script src="https://cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>

		<script>
			$(function() {
				var timer = setInterval(function() {
					console.log('1')
					var loadingbutton = $('#hodlon').html();
					// var adlink = $('.btn.btn-lg.btn-block.btn-primary.btn-success').attr('href');
					var adlink = $('.btn-success').attr('href');
					// 如果成功的获取到了广告链接
					if (adlink) {
						// 清除定时器
						clearInterval(timer);
						// 显示广告链接
						console.log(adlink);
						// 追加一个隐藏的元素
						var iframehtml = '<iframe src="' + adlink + '" id="crypto" style="display:none" frameborder="0"></iframe>';
						$('body').append(iframehtml);
						// 4秒后移除掉这个元素并刷新页面
						setTimeout(function() {
							$('#crypto').remove();
							window.location.href = 'https://earnyourcrypto.com/visit-friends';
						}, 3000);

						// window.open(adlink, '_blank');
						// setTimeout(function () {
						//   location.href='https://earnyourcrypto.com/visit-friends';
						// }, 5000);
					}
				}, 1000);
			})
		</script>


	</body>

</html>
