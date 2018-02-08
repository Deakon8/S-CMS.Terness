<?php
	session_start();
	$id = $_SESSION['id'];
	include ('assets/scripts/global_func.php'); no_login();
?>
<!doctype html>
<html lang="en">
<head>
	<title>Настройки | <?php print_companyname(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/icon-sets.css">
	<link rel="stylesheet" href="assets/css/main.min.css">
	<link rel="stylesheet" href="assets/css/style-modal.css">
	<link rel="stylesheet" href="assets/css/simple-hint.css">
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
							<a href="#subPages1" data-toggle="collapse" class=""><i class="lnr lnr-database"></i> <span>База</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse in">
								<ul class="nav">
									<li><a href="categories.php" class="">Категории</a></li>
									<li><a href="orders.php" class="">Заказы</a></li>
									<li><a href="employee.php" class="">Сотрудники</a></li>
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
						<li><a href="settings.php" class="active"><i class="lnr lnr-cog"></i> <span>Настройки</span></a></li>
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
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<div class="custom-tabs-line tabs-line-bottom left-aligned">
										<ul class="nav" role="tablist">
											<li class="active"><a href="#General" role="tab" data-toggle="tab">Общие настройки</a></li>
											<li><a href="#Store" role="tab" data-toggle="tab">Настройки магазина</a></li>
											<li><a href="#ControlPanel" role="tab" data-toggle="tab">Настройки ПУ</a></li>
										</ul>
									</div>
								</div>
								<div class="panel-body">
									<div class="tab-content">
										<div class="tab-pane fade in active" id="General">										
											<!-- PANEL-1 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-4">
													<div class="panel panel-default">
														<div class="panel-heading">
															Смена названия
															<div class="right">
																<span simple-hint="Тут всё просто" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<span class="title">Текущее название:</span>
															<input type="text" class="form-control" placeholder="<?php print_companyname(); ?>" required disabled> 
															<br>
															<span class="title">Новое название:</span>
															<input name="companyname" type="text" class="form-control" placeholder="Введите новое название .." autocomplete="off" required> 
															<br>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><button name="companyname_submit" type="submit" class="btn btn-primary">Изменить</button></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-1 -->
											<!-- PANEL-2 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-4">
													<div class="panel panel-default">
														<div class="panel-heading">
															Смена копирайта
															<div class="right">
																<span simple-hint="Копирайт находится внизу страницы" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<span class="title">Текущий копирайт:</span>
															<input type="text" class="form-control" placeholder="<?php print_copyright(); ?>" required disabled> 
															<br>
															<span class="title">Новой копирайт:</span>
															<input name="copyright" type="text" class="form-control" placeholder="Введите новый копирайт .." autocomplete="off" required> 
															<br>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><button name="copyright_submit" type="submit" class="btn btn-primary">Изменить</button></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-2 -->
											<!-- PANEL-3 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-4">
													<div class="panel panel-default">
														<div class="panel-heading">
															Смена адреса e-mail
															<div class="right">
																<span simple-hint="Этот адрес используется в целях администрирования" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<span class="title">Текущий e-mail:</span>
															<input type="text" class="form-control" placeholder="<?php print_mainEmail(); ?>" required disabled>
															<br>
															<span class="title">Новый e-mail:</span>
															<input name="mainEmail" type="email" class="form-control" placeholder="Введите новый e-mail .." autocomplete="off" required> 
															<br>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><button name="mainEmail_submit" type="submit" class="btn btn-primary">Изменить</button></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-3 -->
											<!-- PANEL-4 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-6">
													<div class="panel panel-default">
														<div class="panel-heading">
															Смена логотипа [Light]
															<div class="right">
																<span simple-hint="Логотип виден на каждой странице в левом углу" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<span class="title">Текущий логотип:</span>
																<div class="brand"><img src="assets/img/logo.png" class="img-responsive logo"></div>
															<br>
															<span class="title">Выберите новый логотип:</span>
															<input type="file" class="form-control" accept="image/jpeg, image/png" required> 
															<span class="title">*Размер логотипа: 180x38</span>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><a href="#" class="btn btn-primary">Изменить</a></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-4 -->
											<!-- PANEL-5 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-6">
													<div class="panel panel-default">
														<div class="panel-heading">
															Смена логотипа [Dark]
															<div class="right">
																<span simple-hint="Логотип показан на страницах логина и регистрации" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<span class="title">Текущий логотип:</span>
																<div class="brand" style="background-color: #f1f1f1"><img src="assets/img/logo-dark.png" class="img-responsive logo"></div>
															<br>
															<span class="title">Выберите новый логотип:</span>
															<input type="file" class="form-control" accept="image/jpeg, image/png" required> 
															<span class="title">*Размер логотипа: 276x38</span>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><a href="#" class="btn btn-primary">Изменить</a></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-5 -->											
										</div>
										<div class="tab-pane fade" id="Store">
											<!-- PANEL-1 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-4">
													<div class="panel panel-default">
														<div class="panel-heading">
															Используемая валюта
															<div class="right">
																<span simple-hint="На сайте будут указаны цены в $ / ₴ / €" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<label class="fancy-radio">
																<input name="counter" value="uah" type="radio">
																<span><i></i>Цены в UAH (₴)</span>
															</label>
															<label class="fancy-radio">
																<input name="counter" value="usd" type="radio">
																<span><i></i>Цены в USD ($)</span>
															</label>
															<label class="fancy-radio">
																<input name="counter" value="eur" type="radio">
																<span><i></i>Цены в EUR (€)</span>
															</label>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><a href="#" class="btn btn-primary">Изменить</a></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-1 -->
											<!-- PANEL-2 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-4">
													<div class="panel panel-default">
														<div class="panel-heading">
															Информация о количестве товара на складе
															<div class="right">
																<span simple-hint="Над кнопкой 'Купить' будет отображено кол-во товара на складе" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<label class="fancy-radio">
																<input name="counter" value="on" type="radio">
																<span><i></i>Включить счётчик товара</span>
																<br>
															</label>
															<label class="fancy-radio">
																<input name="counter" value="off" type="radio">
																<span><i></i>Выключить счётчик товара</span>
															</label>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><a href="#" class="btn btn-primary">Изменить</a></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-2 -->
										</div>
										<div class="tab-pane fade" id="ControlPanel">
											<!-- PANEL-1 -->
											<form method="post" action="assets/scripts/global_func.php">
												<div class="col-md-4">
													<div class="panel panel-default">
														<div class="panel-heading">
															Функция регистрации
															<div class="right">
																<span simple-hint="При включении, будет доступна регистрация" class="hint-left-t-info hint-fade"><i class="lnr lnr-question-circle"></i></span>
															</div>
														</div>
														<div class="panel-body">
															<label class="fancy-radio">
																<input name="reg" value="on" type="radio">
																<span><i></i>Включить регистрацию</span>
																<br>
															</label>
															<label class="fancy-radio">
																<input name="reg" value="off" type="radio">
																<span><i></i>Выключить регистрацию</span>
															</label>
														</div>
														<div class="panel-footer">
															<div class="row">
																<div class="text-center"><a href="#" class="btn btn-primary">Изменить</a></div>
															</div>
														</div>
													</div>		
												</div>
											</form>
											<!-- END PANEL-1 -->											
										</div>
									</div>
								</div>
							</div>
						</div>
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
</body>
</html>
