<?php
	session_start();
	include ('assets/scripts/global_func.php'); no_login2();
?>
<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title>Вход | Terness</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/icon-sets.css">
	<link rel="stylesheet" href="assets/css/main.min.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="logo text-center"><img src="assets/img/logo-dark.png" alt="Terness Logo"></div>
							<form method="post" class="form-auth-small" action="assets/scripts/authorization.php">
								<div class="form-group">
									<label for="signup-email" class="control-label sr-only">Логин</label>
									<input placeholder="Логин" name="login" type="text" class="form-control" autocomplete="off" minlength="1" maxlength="32" required>
								</div>
								<div class="form-group">
									<label for="signup-password" class="control-label sr-only">Пароль</label>
									<input placeholder="Пароль" name="password" type="password" class="form-control" autocomplete="off" minlength="1" maxlength="32" required>
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input name="checkbox" type="checkbox">
										<span>Запомнить</span>
									</label>
								</div>
								<button name="log" type="submit" class="btn btn-primary btn-lg btn-block">ВОЙТИ</button>
								<div class="bottom">
									<span><i class="fa fa-lock"></i><a href="#"> Забыли пароль?</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Вход в личный кабинет «Terness»</h1>
							<p>*на стадии пре-альфа</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
</html>
