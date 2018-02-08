<?php
	session_start();
	$id = $_SESSION['id'];
	include ('assets/scripts/global_func.php'); no_login();
?>
<!doctype html>
<html lang="en">
<head>
	<title>Редактирование аккаунта | <?php print_companyname(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/icon-sets.css">
	<link rel="stylesheet" href="assets/css/main.min.css">
	<link rel="stylesheet" href="assets/css/style-modal.css">
	<!-- TABLE -->
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<div class="sidebar">
			<div class="brand">
				<a href="index.php"><img src="assets/img/logo.png" alt="Terness Logo" class="img-responsive logo"></a>
			</div>
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class=""><i class="lnr lnr-home"></i> <span>Главная</span></a></li>
						<li>
							<a href="#subPages1" data-toggle="collapse" class="active"><i class="lnr lnr-database"></i> <span>База</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse in">
								<ul class="nav">
									<li><a href="categories.php" class="">Категории</a></li>
									<li><a href="orders.php" class="">Заказы</a></li>
									<li><a href="employee.php" class="active">Сотрудники</a></li>
									<li><a href="products.php" class="">Товары</a></li>
									<li><a href="tikets.php" class="">Тикеты</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subPages2" data-toggle="collapse" class=""><i class="lnr lnr-history"></i> <span>История</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse">
								<ul class="nav">
									<li><a href="supply.php" class="">История поставок</a></li>
									<li><a href="activity.php" class="">История активности</a></li>
									<li><a href="logging.php" class="">История входов</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subPages3" data-toggle="collapse" class=""><i class="lnr lnr-chart-bars"></i> <span>Маркетинг</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages3" class="collapse">
								<ul class="nav">
									<li><a href="sale.php" class="">Акции</a></li>
									<li><a href="coupons.php" class="">Купоны</a></li>
									<li><a href="contact.php" class="">Рассылка</a></li>
								</ul>
							</div>
						</li>
						<li><a href="settings.php" class=""><i class="lnr lnr-cog"></i> <span>Настройки</span></a></li>
						<li><a href="stat.php" class=""><i class="lnr lnr-pie-chart"></i> <span>Статистика</span></a></li>
						<li><a href="settings.php" class=""><i class="lnr lnr-exit"></i> <span>В магазин</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- NAVBAR -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-btn">
						<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
					</div>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
							<span class="sr-only">Навигация</span>
							<i class="fa fa-bars icon-nav"></i>
						</button>
					</div>
					<div id="navbar-menu" class="navbar-collapse collapse">
						<form class="navbar-form navbar-left hidden-xs">
							<div class="input-group">
								<input type="text" value="" class="form-control" placeholder="Что будем искать?">
								<span class="input-group-btn"><button type="button" class="btn btn-primary">Поиск</button></span>
							</div>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
									<i class="lnr lnr-alarm"></i>
									<?php notification(); ?>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="lnr lnr-question-circle"></i> <span>Помощь</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="#">Основные функции</a></li>
									<li><a href="#">Работа с заказами</a></li>
									<li><a href="#">Работа с комментариями</a></li>
									<li><a href="#">Работа с архивом</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="assets/img/user.png" class="img-dropdown" alt="Avatar"> <span><?php print_login(); ?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="assets/scripts/global_func.php?logout=1"><i class="lnr lnr-exit"></i> <span>Выход</span></a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<!-- END NAVBAR -->
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<!-- FORM -->
						<form method="post" action="assets/scripts/global_func.php" enctype="multipart/form-data">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Редактирование аккаунта</div>
									<div class="panel-body">
										<!-- FIRST COL -->
										<div class="col-md-6">
											<div class="col-md-12">
												<div class="col-md-6 center">
													<span class="title">Текущее фото:</span>
													<a href='assets/img/emp/<?php edit_empid(); ?>.jpg' target='_blank'><img src='assets/img/emp/<?php edit_empid(); ?>.jpg' class='img-editprofile' alt='NO_IMAGE'></a>
												</div>
												<div class="col-md-6 center">
													<span class="title">Новое фото:</span>
													<span id="output"></span>
													<div class="file_upload">
														<button type="button">Выбрать</button>
														<input type="file" id="file" name="uploademp" class="form-control" accept="image/jpeg">
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<input type='hidden' name='id_emp' value='<?php edit_empid(); ?>'>
												<hr>
											</div>
											<div class="col-md-6">
												<span class="title">Дата трудоустройства:</span>
												<input name="reg_date_emp" type="text" class="form-control" placeholder="<?php edit_empregdate(); ?>" disabled> 
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Регистрационный IP:</span>
												<input name="reg_ip_emp" type="text" class="form-control" placeholder="<?php edit_empip(); ?>" disabled> 
												<br>
											</div>
										</div>
										<!-- END FIRST COL -->
										<!-- SECOND COL -->
										<div class="col-md-6">
											<div class="col-md-6">
												<span class="title">Логин:</span>
												<input name="log_emp" type="text" class="form-control" value="<?php edit_emplog(); ?>" minlength="6" maxlength="24">
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Пароль:</span>
												<input name="pass_emp" type="password" class="form-control" value="<?php edit_emppass(); ?>" minlength="6" maxlength="24">
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">ФИО:</span>
												<input name="fullName_emp" type="text" class="form-control" value="<?php edit_empfn(); ?>">
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Дата рождения:</span>
												<input name="birthDate_emp" type="date" class="form-control" value="<?php edit_empbdate(); ?>"> 
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Мобильный номер:</span>
												<input name="number_emp" type="tel" class="form-control" value="<?php edit_empnum(); ?>"> 
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Эл.почта:</span>
												<input name="mail_emp" type="email" class="form-control" value="<?php edit_empmail(); ?>"> 
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Должность:</span>
												<select name="post_emp" class="form-control">
													<option value="Администратор">Администратор</option>
													<option value="Менеджер">Менеджер</option>
													<option value="Оператор">Оператор</option>
												</select>
												<br>
											</div>
											<div class="col-md-6">
												<span class="title">Ставка ($):</span>
												<input name="salary_emp" type="text" class="form-control" value="<?php edit_empsal(); ?>"> 
												<br>
											</div>
										</div>
										<!-- END SECOND COL -->
									</div>
									<div class="panel-footer">
										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-2">
												<button name="edit_emp" type="submit" class="btn btn-primary btn-block">Редактировать</button>
											</div>
											<div class="col-md-2">
												<a href="employee.php"><button type="button" class="btn btn-danger btn-block">Отменить</button></a>
											</div>
											<div class="col-md-4"></div>
										</div>
									</div>
								</div>		
							</div>
						</form>
						<!-- FORM -->
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<footer>
				<div class="container-fluid">
					<p class="copyright"><?php print_copyright(); ?></a></p>
				</div>
			</footer>
		</div>
		<!-- END MAIN -->
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="assets/js/jquery-2.1.0.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.slimscroll.min.js"></script>
	<script src="assets/js/klorofil.js"></script>
	<script>
	function handleFileSelect(evt) {
		var file = evt.target.files; // FileList object
		var f = file[0];
		// Only process image files.
		if (!f.type.match('image.*')) {
			alert("Image only please....");
		}
		var reader = new FileReader();
		// Closure to capture the file information.
		reader.onload = (function(theFile) {
			return function(e) {
				// Render thumbnail.
				var span = document.createElement('span');
				span.innerHTML = ['<img class="img-editprofile" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
				document.getElementById('output').insertBefore(span, null);
			};
		})(f);
		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
	}
	document.getElementById('file').addEventListener('change', handleFileSelect, false);
	</script>
</body>
</html>
