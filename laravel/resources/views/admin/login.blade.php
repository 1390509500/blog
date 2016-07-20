<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('resources/views/admin/style/css/ch-ui.admin.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">
			@if(session('msg'))
			<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				<ul>
					<li>
					<input type="text" name="name" class="text"/>
						{{csrf_field()}}
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="pwd" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="captcha"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url(captcha_src())}}" alt="请输入验证码" style="cursor: pointer;" onclick="this.src='{{url(captcha_src())}}?'+Math.random();">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="#">返回首页</a> &copy; 2016 Powered by <a href="http://www.houdunwang.com" target="_blank">http://www.houdunwang.com</a></p>
		</div>
	</div>
</body>
</html>