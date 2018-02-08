<?php
	session_start();
	$id = $_SESSION['id'];
	include ('assets/scripts/global_func.php'); no_login();
	include ('assets/scripts/fusioncharts.php');
	
    $hostdb = "localhost";  // MySQl host
    $userdb = "alexpafs_ucp";  // MySQL username
    $passdb = "Deakonlight123";  // MySQL password
    $namedb = "alexpafs_ucp";  // MySQL database name
    // Establish a connection to the database
    $dbhandle = new mysqli($hostdb, $userdb, $passdb, $namedb);
    /*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
    if ($dbhandle->connect_error) {
	exit("Ошибка подключения: ".$dbhandle->connect_error);
   }
?>
<!doctype html>
<html lang="en">
<head>
	<title>Главная | <?php print_companyname(); ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/icon-sets.css">
	<link rel="stylesheet" href="assets/css/main.min.css">
	<link rel="stylesheet" href="assets/css/style-modal.css">
	<!-- GOOGLE FONTS -->
	<!-- Кириллический шрифт :: <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300" rel="stylesheet"> :: -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	
	<script type="text/javascript" src="assets/js/fusioncharts/fusioncharts.js"></script>
	<script type="text/javascript" src="assets/js/fusioncharts/fusioncharts.charts.js"></script>
	<script type="text/javascript" src="assets/js/fusioncharts/fusioncharts.theme.zune.js"></script>
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
						<li><a href="index.php" class="active"><i class="lnr lnr-home"></i> <span>Главная</span></a></li>
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
						<div class="col-md-3">
							<div class="metric">
								<span class="icon widget-icon-red widget-icon"><i class="fa fa-area-chart"></i></span>
								<p class="index-widget">
									<span class="number">$<?php year_profit(); ?></span>
									<span class="title">Годовой доход</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon widget-icon-green widget-icon"><i class="fa fa-shopping-bag"></i></span>
								<p class="index-widget">
									<span class="number">$<?php last_profit(); ?></span>
									<span class="title">Месячный доход</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon widget-icon-purple widget-icon"><i class="fa fa-envelope"></i></span>
								<p class="index-widget">
									<span class="number"><?php last_mailing_prof(); ?>%</span>
									<span class="title">Успешность рассылки</span>
								</p>
							</div>
						</div>
						<div class="col-md-3">
							<div class="metric">
								<span class="icon widget-icon-blue widget-icon"><i class="fa fa-eye"></i></span>
								<p class="index-widget">
									<span class="number"><?php year_visits(); ?></span>
									<span class="title">Посещений за год</span>
								</p>
							</div>
						</div>
						<!-- CHART_1 -->
						<div class="col-md-9">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Статистика рассылки и доходов</h3>
								</div>
								<div class="panel-body">
									<?php
									
									  $strQueryCategories = "SELECT DISTINCT DATE_FORMAT(date,'%m.%y') AS date FROM stat";
									
									  $resultCategories = $dbhandle->query( $strQueryCategories) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

									  $strQueryData = "SELECT DISTINCT statName, date, statInfo
													FROM stat
													WHERE statName = 'profit' OR statName = 'visits'
													ORDER BY statName ASC LIMIT 24
													";
													
									  $resultData = $dbhandle->query($strQueryData) or exit("Error code ({$dbhandle->errno}): {$dbhandle->error}");

									 if ($resultData) {
										
										/* `$arrData` is the associative array that is initialized to store the chart attributes. */
										$arrData = array(
											"paletteColors" => "#028ff8, #F89B03",
											"showValues" => "0",
											"theme" => "zune",
											"showPrintMenuItem" => "1",
											"showLegend" => "0",
										   );

										$xmlData = "<chart";

										// Iterate over each chart attribute and convert it into an attribute string
										foreach ($arrData as $key => $value) {
											$xmlData .= " $key= \"$value\" "; 
										}
										$xmlData .= ">";
										if($resultCategories)
										{
										  $xmlData.= "<categories>";
											while($row = mysqli_fetch_array($resultCategories))
											{
												$xmlData .= "<category label=\"".$row["date"]."\" />";
											}
												$xmlData .= "</categories>";
										}				
												
										if ($resultData)
										{
											$controlBreakValue ="";	
												while($row = mysqli_fetch_array($resultData)) 
												{
													if( $controlBreakValue != $row["statName"] ) 
													{
														if($controlBreakValue !="")
														{
															 $xmlData .= "</dataset>";	 
														}
														$controlBreakValue =  $row["statName"];
														$xmlData .= "<dataset seriesName=\" $controlBreakValue \">";	
														$controlBreakValue =="";
													}
													$xmlData .= "<set value=\"" .$row["statInfo"]. "\" />";				   
												 }
												$xmlData .= "</dataset>";
										}					
										$xmlData .= "</chart>";
										$columnChart = new FusionCharts("msline", "myFirstChart" , "100%", 300, "chart-1", "xml", "$xmlData");
										// Render the chart
										$columnChart->render();
										// Close the database connection
										$dbhandle->close();
									 }

									?>
									<div class="layout-table">
										<div class="cell">
											<div class="chart-metric">
												<span class="title">
													<span class="data-legend custom-bg-blue3"></span>Доход</span>
												<span class="value">$<?php last_profit(); ?></span>
												<?php last_profit_per(); ?>
											</div>
										</div>
										<div class="cell">
											<div class="chart-metric">
												<span class="title">
													<span class="data-legend custom-bg-orange2"></span>Посещений</span>
												<span class="value"><?php last_visits(); ?></span>
												<?php last_visits_per(); ?>
											</div>
										</div>
										<div class="cell valign-bottom text-right">
											<div class="btn-group">
												<button disabled type="button" class="btn btn-default btn-sm">6 месяцев</button>
												<button type="button" class="btn btn-default btn-sm active">12 месяцев</button>
												<button disabled type="button" class="btn btn-default btn-sm">24 месяца</button>
											</div>
										</div>
									</div>
									<div id="chart-1"></div>
								</div>
							</div>
						</div>
						<!-- END CHART_1 -->
						<!-- WIDGET_1 -->
						<div class="col-md-3">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Результаты последней массовой рассылки</h3>
								</div>
								<div class="panel-body no-padding">
									<ul class="list-unstyled list-widget-vertical" id="last-campaign-metric">
										<li>
											<div class="widget-metric_2">
												<i class="fa fa-envelope-o icon"></i>
												<div class="right">
													<span class="title">Всего отправлено</span>
													<span class="value"><?php last_mailing1(); ?></span>
												</div>
											</div>
										</li>
										<li>
											<div class="widget-metric_2">
												<i class="fa fa-hand-pointer-o icon"></i>
												<div class="right">
													<span class="title">Переходов</span>
													<span class="value"><?php last_mailing2(); ?></span>
												</div>
											</div>
										</li>
										<li>
											<div class="widget-metric_2">
												<i class="fa fa-minus-square-o icon"></i>
												<div class="right">
													<span class="title">Отказались</span>
													<span class="value"><?php last_mailing3(); ?></span>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- END WIDGET_1 -->
						<!-- RECENT PURCHASES -->
						<div class="col-md-7">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Последние заказы</h3>
									<div class="right">
										<span class="link"><i class="fa fa-shopping-bag"></i> <a href="orders.php">Просмотреть все заказы</a></span>
									</div>
								</div>
								<div class="panel-body no-padding">
									<div class="table-responsive">
										<table class="table table-minimal table-fullwidth table-striped">
											<thead>
												<tr>
													<th>oID</th>
													<th>Покупатель</th>
													<th>Сумма</th>
													<th>Дата и время</th>
													<th>Статус</th>
												</tr>
											</thead>
											<tbody>
												<?php index_orders(); ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- END RECENT PURCHASES -->
						<!-- TOP PRODUCTS -->
						<div class="col-md-5">
							<div class="panel">
								<div class="panel-heading">
									<h4 class="panel-title">ТОП-10 товаров</h4>
									<div class="right">
										<span class="link"><i class="fa fa-archive"></i> <a href="products.php">Просмотреть все товары</a></span>
									</div>
								</div>
								<div class="panel-body no-padding">
									<div class="table-responsive">
										<table class="table table-minimal table-striped table-fullwidth table-icons-stat">
											<thead >
												<tr>
													<th>Наименование</th>
													<th>Просмотров</th>
													<th>Продаж</th>
													<th>Доход</th>
													<th>Детали</th>
												</tr>
											</thead>
											<tbody>
												<?php index_top10(); ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- END TOP PRODUCTS -->
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
