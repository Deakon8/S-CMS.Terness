<?php
	session_start();
	$id = $_SESSION['id'];
	include ('assets/scripts/global_func.php'); no_login();
?>
<!doctype html>
<html lang="en">
<head>
	<title>Тикеты | <?php print_companyname(); ?></title>
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
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
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
									<li><a href="employee.php" class="">Сотрудники</a></li>
									<li><a href="products.php" class="">Товары</a></li>
									<li><a href="tikets.php" class="active">Тикеты</a></li>
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
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Общий отчет по тикетам</h3>
							<p class="panel-subtitle">За весь период работы магазина.</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon widget-icon-blue2 widget-icon"><i class="fa fa-ellipsis-h "></i></span>
										<p>
											<span class="number"><?php print_tiketall(); ?></span>
											<span class="title">Всего тикетов</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon widget-icon-green widget-icon"><i class="fa fa-envelope-open"></i></span>
										<p>
											<span class="number"><?php print_tiketopen(); ?></span>
											<span class="title">Открытых</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon widget-icon-red widget-icon"><i class="fa fa-envelope"></i></span>
										<p>
											<span class="number"><?php print_tiketclosed(); ?></span>
											<span class="title">Закрытых</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon widget-icon-blue widget-icon"><i class="fa fa-trash"></i></span>
										<p>
											<span class="number"><?php print_tiketdel(); ?></span>
											<span class="title">Удаленных</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
					<div class="row">
						<div class="col-md-12">
						<!-- RECENT PURCHASES -->
						<div class="panel panel-default">
							<div class="panel-heading">Архив тикетов
								<div class="right">
									<a href="#" class="btn-panel-refresh"><span class="label label-success refresh-btn">Обновить</span></a>
								</div>
							</div>
							<div class="panel-body">
								<div class="overlay-refresh">
									<div class="vertical-align-wrap">
										<div class="vertical-align-middle">
											<i class="fa fa-refresh fa-spin"></i>
											<span>Обновление информации ...</span>
										</div>
									</div>
								</div>
								<table id="mg" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>mID</th>
											<th>Имя</th>
											<th>Электронная почта</th>
											<th>Сообщение</th>
											<th>Дата и время</th>
											<th>IP</th>
											<th>Статус</th>
										</tr>
									</thead>
									<tbody>
										<?php print_tikets(); ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- END RECENT PURCHASES -->
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
	<script src="assets/js/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/js/datatables/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready( function () {
			$('#mg').DataTable();
		} );
	</script>
	<script>
	$(function() {
		$(".btn-panel-refresh").length>0&&$(".btn-panel-refresh").on("click",function(){$(".overlay-refresh").fadeIn(300),setTimeout(function(){$(".overlay-refresh").fadeOut(300)},1500)});
		$('.btn-panel-refresh').click(function(){  
			setTimeout(function(){
			$("#zctb").load("tikets.php #zctb");
			}, 1000);  
		}); 
	});
	</script>
</body>
</html>
