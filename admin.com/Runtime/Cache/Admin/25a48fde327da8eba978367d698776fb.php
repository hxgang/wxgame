<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>NB后台管理系统</title>
  <meta name="description" content="">
  <meta name="keywords" content="index">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="/Public/Admin/assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/amazeui.min.css" />
  <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/admin.css">
  <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/app.css">
</head>

<body data-type="login">

  <div class="am-g myapp-login">
	<div class="myapp-login-logo-block  tpl-login-max">
		<div class="myapp-login-logo-text">
			<div class="myapp-login-logo-text">
				<i>NB云后台管理系统</i>
			</div>
		</div>

		<div class="login-font">
			<i>Log In </i> or <span> Sign Up</span>
		</div>
		<div class="am-u-sm-10 login-am-center">
			<form class="am-form" method="post" action="<?php echo U();?>">
				<fieldset>
					<div class="am-form-group">
						<input type="text" name="username" class="" id="doc-ipt-email-1" placeholder="输入电子邮件">
					</div>
					<div class="am-form-group">
						<input type="password"  name="password" class="" id="doc-ipt-pwd-1" placeholder="设置个密码吧">
					</div>
					<!--<div class="am-form-group">
						<input  type="text" name="captcha" class="capital" placeholder="验证码"  />
						<img  src="<?php echo U('Verify/index');?>" style=" height: 50px; cursor: pointer" onclick="this.src = '<?php echo U('Verify/index');?>?hhhhhh='+Math.random()"/>
					</div>
					<div class="am-form-group">
						<input type="checkbox" value="1" name="remember" id="remember" />
						<label for="remember">请保存我这次的登录信息。</label>
					</div>-->
					<p><button type="submit" class="am-btn am-btn-default">登录</button></p>
				</fieldset>
				<input type="hidden" name="act" value="signin" />
			</form>
		</div>
	</div>
</div>

  <script src="http://game.cn/Public/Admin/assets/js/jquery.min.js"></script>
  <script src="http://game.cn/Public/Admin/assets/js/amazeui.min.js"></script>
  <script src="http://game.cn/Public/Admin/assets/js/app.js"></script>
</body>

</html>