<?php 
/* Для вывода ошибок - УДАЛИТЬ КОММЕНТИРОВАНИЕ! 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); */
include ('connect.php'); // Подключаемся к БД.
session_start();
	
// Функция выхода из аккаунта.
if(isset($_GET['logout'])) {
	session_destroy();
	exit("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../login.php'>");
}
// Функция вывода логина.
function print_login() {
	$id = $_SESSION['id'];
	$query = mysql_query("SELECT login FROM users WHERE eID='$id'");
    $array = mysql_fetch_array($query);
	echo " ".$array['login']." ";
}
// Проверка на авторизацию пользователя. (На страницах ЛК)
function no_login() {
	$id = $_SESSION['id'];
	if (empty($_SESSION['id'])) 
	{ 
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../login.php'>"); // Если пусто значение сессии - перенаправляем на логин.
		exit();
	} 
	else 
	{ 
		echo("");
	}
}
// Проверка на авторизацию пользователя. (На страницах авторизации и регистрации)
function no_login2() {
	if (empty($_SESSION['id'])) 
	{ 
		echo("");
	} 
	else 
	{ 
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../index.php'>"); // Если сессия существует - на главную.
		exit();
	}
}
// Функция вывода названия сайта.
function print_companyname() {
	$query = mysql_query("SELECT companyName FROM settings WHERE global_settings='1'");
    $array = mysql_fetch_array($query);
	echo " ".$array['companyName']." ";
}
// Функция вывода копирайта.
function print_copyright() {
	$query = mysql_query("SELECT copyright FROM settings WHERE global_settings='1'");
    $array = mysql_fetch_array($query);
	echo " ".$array['copyright']." ";
}
// Функция вывода почты сайта.
function print_mainEmail() {
	$query = mysql_query("SELECT mainEmail FROM settings WHERE global_settings='1'");
    $array = mysql_fetch_array($query);
	echo " ".$array['mainEmail']." ";
}
/* ------------------------------------------------------------------------------------------ settings.php ------------------------------------------------------------------------------------------ */
// НАСТРОЙКИ - смена названия сайта.
if (isset($_POST['companyname_submit'])) 
{
	$companyname = $_POST['companyname'];
	$companyname_func = mysql_query("UPDATE settings SET companyname = '$companyname' WHERE global_settings='1'");
	if ($companyname_func == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Сменил название сайта', '-')");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../settings.php'>"; // В случае если смена названия успешна. (Данные дошли до базы.)
	}
	else 
	{
		echo "Ошибка! Что-то пошло не так.";
	}
}
// НАСТРОЙКИ - смена копирайта.
if (isset($_POST['copyright_submit']))
{
	$copyright = $_POST['copyright'];
	$copyright_func = mysql_query("UPDATE settings SET copyright = '$copyright' WHERE global_settings='1'");
	if ($copyright_func == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Сменил копирайт сайта', '-')");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../settings.php'>"; // В случае если смена копирайта успешна. (Данные дошли до базы.)
	}
	else 
	{
		echo "Ошибка! Что-то пошло не так.";
	}
}
// НАСТРОЙКИ - смена почты сайта.
if (isset($_POST['mainEmail_submit']))
{
	$mainEmail = $_POST['mainEmail'];
	$mainEmail_func = mysql_query("UPDATE settings SET mainEmail = '$mainEmail' WHERE global_settings='1'");
	if ($mainEmail_func == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Сменил почту администратора сайта', '-')");
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../settings.php'>"; // В случае если смена копирайта успешна. (Данные дошли до базы.)
	}
	else 
	{
		echo "Ошибка! Что-то пошло не так.";
	}
}
/* ------------------------------------------------------------------------------------------ logging.php ------------------------------------------------------------------------------------------ */
// Функция вывода ИСТОРИИ ВХОДОВ.
function print_loggingHistory() {
	$query = mysql_query("SELECT * FROM loggingHistory");
    $array = mysql_fetch_array($query);
	do
	{
		$date = $array['loginDate'];
		$formatdate = date("d.m.y", strtotime($date));
		$formattime = date("H:i:s", strtotime($date));
		echo "<tr><td><a href='../../employee.php#".$array['eID']."'>#".$array['eID']."</a></td><td>".$array['login']."</td><td>".$array['eFullName']."</td><td>".$array['post']."</td><td>".$formatdate." &nbsp;&nbsp;<span class='text-muted'>".$formattime."</td><td>".$array['ip']."</td></tr>";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ activity.php ------------------------------------------------------------------------------------------ */
// Функция вывода ИСТОРИИ АКТИВНОСТИ.
function print_activityHistory() {
	$query = mysql_query("SELECT * FROM activityHistory");
    $array = mysql_fetch_array($query);
	do
	{
		$date = $array['actionDate'];
		$formatdate = date("d.m.y", strtotime($date));
		$formattime = date("H:i:s", strtotime($date));
		echo "<tr><td><a href='../../employee.php#".$array['eID']."'>#".$array['eID']."</a></td><td>".$array['action']."</td><td>".$formatdate." &nbsp;&nbsp;<span class='text-muted'>".$formattime."</td></tr>";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ supply.php ------------------------------------------------------------------------------------------ */
// Функция вывода ИСТОРИИ ПОСТАВОК.
function print_supplyHistory() {
	$query = mysql_query("SELECT * FROM supplyHistory");
    $array = mysql_fetch_array($query);
	do
	{
		$formatdate1 = date("d.m.Y", strtotime($array['arrivalDate']));
		$formatdate2 = date("d.m.Y", strtotime($array['orderDate']));
		$totalCost = $array['oneCost'] * $array['supplyAmount'];
		echo "<tr><td><a href='../../products.php#".$array['pID']."'>#".$array['pID']."</a></td><td>".$array['nameProduct']."</td><td>".$array['supplyAmount']." шт.</td><td>$".$totalCost." ($".$array['oneCost'].")</td><td>".$formatdate1."</td><td>".$formatdate2."</td><td><a target='_blank' href='https://aliexpress.com/store/805191'><span class='label label-info' href='aliexpress.com'>".$array['supplierCompany']." <i class='fa fa-external-link'></i></span></a></td></tr>";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ tikets.php ------------------------------------------------------------------------------------------ */
// Функция вывода инфы для ТИКЕТОВ. (ОБЩЕЕ)
function print_tiketall() {
	$query = mysql_query("SELECT * FROM tikets");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ТИКЕТОВ. (ОТКРЫТЫХ)
function print_tiketopen() {
	$query = mysql_query("SELECT * FROM tikets WHERE status='<span class=label-warning>В ОЖИДАНИИ</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ТИКЕТОВ. (ЗАКРЫТЫХ)
function print_tiketclosed() {
	$query = mysql_query("SELECT * FROM tikets WHERE status='<span class=label-success>ОТВЕТ ДАН</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ТИКЕТОВ. (НЕ ПО ТЕМЕ)
function print_tiketdel() {
	$query = mysql_query("SELECT * FROM tikets WHERE status='<span class=label-danger>УДАЛЕН</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода ТИКЕТОВ.
function print_tikets() {
	$query = mysql_query("SELECT * FROM tikets");
    $array = mysql_fetch_array($query);
	
	do
	{
		$date = $array['writeDate'];
		$formatdate = date("d.m.y", strtotime($date));
		$formattime = date("H:i", strtotime($date));
		// Функция вывода первых 20 символов.
		$ebaka = $array['message'];
		$ebaka = substr($ebaka, 0, 20); // Выбираем первых 20* символов.
		$ebaka = rtrim($ebaka, "!,.-"); // Удаляем указанные символы, если они вконце.
		echo "
		<tr>
			<td>
				<!-- Вызов модального окна -->
				<a href='#".$array['tID']."'>#".$array['tID']."</a>
				<!-- Модальное окно -->
				<a href='#' class='overlay' id='".$array['tID']."'></a>
				<div class='col-md-12 popup'>
					<div class='panel panel-default'>
						<div class='panel-heading'>
							<h3 class='panel-title'>Сообщение #".$array['tID']."</h3>
							<h3 class='panel-title box-message-title'>От: ".$array['senderFullName']." | ".$array['senderMail']."</h3>
						</div>
						<div class='panel-body'>
							<p class='box-message-atime'>".$array['writeDate']."</p>
							<div class='box-message-answer'>".$array['message']."</div>
							<p class='box-message-rtime'>".$array['replyDate']." - <a href='../../employee.php#".$array['eID']."' target='_blank'>#".$array['eID']."</a></p>
							<div class='box-message-reply'>".$array['reply']."</div>
							<textarea class='box-message-textarea form-control' placeholder='Пожалуйста, введите своё сообщение здесь ..' rows='2' required></textarea>
							<button  type='button' class='box-message-btn btn btn-info'>></button>
						</div>
						<div class='panel-footer'>
							<a href='#close'><button  type='button' class='btn btn-danger'>Закрыть</button></a>
						</div>
					</div>
				</div>
				<!-- Конец модальное окно -->
			</td>
			<td>".$array['senderFullName']."</td>
			<td>".$array['senderMail']."</td>
			<td>".$ebaka." ..</td>
			<td>".$formatdate." &nbsp;&nbsp;
				<span class='text-muted'>".$formattime."</span>
			</td>
			<td>".$array['senderIp']."</td>
			<td>".$array['status']."</td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ products.php ------------------------------------------------------------------------------------------ */
// Функция вывода инфы для ТОВАРОВ. (ОБЩЕЕ)
function print_productall() {
	$query = mysql_query("SELECT * FROM products");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ТОВАРОВ. (В НАЛИЧИИ)
function print_productyes() {
	$query = mysql_query("SELECT * FROM products WHERE status='<span class=label-success>В НАЛИЧИИ</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ТОВАРОВ. (ОЖИДАЕТСЯ)
function print_productexpect() {
	$query = mysql_query("SELECT * FROM products WHERE status='<span class=label-warning>ОЖИДАЕТСЯ</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ТОВАРОВ. (НЕТ НА СКЛАДЕ)
function print_productno() {
	$query = mysql_query("SELECT * FROM products WHERE status='<span class=label-danger>НЕТ НА СКЛАДЕ</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода ТОВАРОВ.
function print_products() {
	$query = mysql_query("SELECT * FROM products");
    $array = mysql_fetch_array($query);
	do
	{
		$sum = mysql_query("SELECT sum(supplyAmount) AS summ FROM supplyHistory WHERE pID='".$array['pID']."'");
		$r = mysql_fetch_row($sum);
		$formatdate1 = date("d.m.Y", strtotime($array['product_reg']));
		$formatdate2 = date("d.m.Y", strtotime($array['last_arrival']));
		echo "
		<tr>
			<td>
				<!-- Вызов модального окна --> 
				<a href='#".$array['pID']."'>#".$array['pID']."</a> 
				<!-- Модальное окно 1 --> 
				<a class='overlay' href='#' id='".$array['pID']."'></a>
				<div class='col-md-12 popup'>
					<!-- TABLE NO PADDING -->
					<div class='panel panel-default'>
						<div class='panel-heading'>
							<h3 class='panel-title'>Информация по товару #".$array['pID']."</h3>
						</div>
						<div class='panel-body'>
							<div class='clearfix'>
							<!-- LEFT COLUMN -->
							<div>
								<!-- PRODUCT HEADER -->
								<div class='profile-header'>
									<div class='overlay'></div>
									<div class='profile-main'>
										<a href='assets/img/prod/".$array['pID']."-1.png' target='_blank'><img src='assets/img/prod/".$array['pID']."-1.png' class='many_img' alt='NO_IMAGE'></a>
										<a href='assets/img/prod/".$array['pID']."-2.png' target='_blank'><img src='assets/img/prod/".$array['pID']."-2.png' class='many_img' alt='NO_IMAGE'></a>
										<a href='assets/img/prod/".$array['pID']."-3.png' target='_blank'><img src='assets/img/prod/".$array['pID']."-3.png' class='many_img' alt='NO_IMAGE'></a>
									</div>
								</div>
								<!-- END PRODUCT HEADER -->
								<!-- PRODUCT DETAIL -->
								<div>
									<div class='profile-info'>
										<h4 class='heading'>Информация</h4>
										<ul class='list-unstyled list-justify'>
											<li>Наименование <span>".$array['nameProduct']."</span></li>
											<li>Категория <span>".$array['category']."</span></li>
											<li>Количество на складе <span>".$array['amount']." шт.</span></li>
											<li>Стоимость <span>$".$array['cost']."</span></li>
										</ul>
										<h4 class='heading'>Поставки</h4>
										<ul class='list-unstyled list-justify'>
											<li>Регистрация продукта <span>".$formatdate1."</span></li>
											<li>Дата последней поставки <span>".$formatdate2."</span></li>
											<li>История поставок <span><a href='supply.php' target='_blank'>Просмотреть</a></span></li>
											<li>&nbsp<span><a href='new_sup.php?p=".$array['pID']."' target='_blank'>Оформить поставку</a></span></li>
										</ul>
										<h4 class='heading'>Статистика</h4>
										<ul class='list-unstyled list-justify'>
											<li>Просмотров товара <span>".$array['views']."</span></li>
											<li>Всего поставлено <span>".$r[0]." шт.</span></li>
											<li>Продано <span>".$array['sales']." шт.</span></li>
										</ul>
									</div>
								</div>
								<!-- END PRODUCT DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							</div>
						</div>
						<div class='panel-footer'>
							<div class='row'>
								<div class='col-md-6 text-left'>
									<a href='../../edit_prod.php?p=".$array['pID']."'><button class='btn btn-primary btn-block' type='button'>Редактировать</button></a>
								</div>
								<div class='col-md-6 text-right'>
									<a href='#close'><button class='btn btn-danger btn-block' type='button'>Закрыть</button></a>
								</div>
							</div>
						</div>
					</div>
					<!-- END TABLE NO PADDING -->
				</div>
				<!-- Конец модальное окно 1 -->
			</td>
			<td><a href='#' class='nameProduct' data-type='text' data-pk='".$array['pID']."'>".$array['nameProduct']."</a></td>
			<td>".$array['category']."</td>
			<td>".$array['amount']." шт.</td>
			<td>$".$array['cost']."</td>
			<td>".$array['sales']." шт.</td>
			<td><a href='#' class='status' data-value='".$array['status']."' data-type='select' data-pk='".$array['pID']."'>".$array['status']."</a></td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ employee.php ------------------------------------------------------------------------------------------ */
// Функция вывода инфы для СОТРУДНИКИ. (ОБЩЕЕ)
function print_usersall() {
	$query = mysql_query("SELECT * FROM users");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для СОТРУДНИКИ. (АДМИИНИСТРАТОРОВ)
function print_usersadm() {
	$query = mysql_query("SELECT * FROM users WHERE post='Администратор'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для СОТРУДНИКИ. (МЕНЕДЖЕРОВ)
function print_usersmanager() {
	$query = mysql_query("SELECT * FROM users WHERE post='Менеджер'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для СОТРУДНИКИ. (ОПЕРАТОРОВ)
function print_usersoperator() {
	$query = mysql_query("SELECT * FROM users WHERE post='Оператор'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода СОТРУДНИКОВ.
function print_users() {
	$query = mysql_query("SELECT * FROM users");
    $array = mysql_fetch_array($query);
	do
	{
		$bdate = date("d.m.Y", strtotime($array['birthDate']));
		$rdate = date("d.m.Y", strtotime($array['reg_date']));
		echo "
		<tr>
			<td>
				<!-- Вызов модального окна --> 
				<a href='#".$array['eID']."'>#".$array['eID']."</a> 
				<!-- Модальное окно 1 --> 
				<a class='overlay' href='#' id='".$array['eID']."'></a>
				<div class='col-md-12 popup'>
					<!-- TABLE NO PADDING -->
					<div class='panel panel-default'>
						<div class='panel-heading'>
							<h3 class='panel-title'>Сотрудник #".$array['eID']."</h3>
						</div>
						<div class='panel-body'>
							<div class='clearfix'>
							<!-- LEFT COLUMN -->
							<div>
								<!-- PROFILE HEADER -->
								<div class='profile-header'>
									<div class='overlay'></div>
									<div class='profile-main'>
										<a href='assets/img/emp/".$array['eID'].".jpg' target='_blank'><img src='assets/img/emp/".$array['eID'].".jpg' class='img-circle' alt='NO_IMAGE'></a>
										<h3 class='name'>".$array['fullName']."</h3>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div>
									<div class='profile-info'>
										<h4 class='heading'>Информация</h4>
										<ul class='list-unstyled list-justify'>
											<li>Дата рождения <span>".$bdate."</span></li>
											<li>Мобильный номер <span>".$array['number']."</span></li>
											<li>Электронная почта <span>".$array['mail']."</span></li>
											<li>Дата трудоустройства <span>".$rdate."</span></li>
											<li>Должность <span>".$array['post']." ($".$array['salary'].")</span></li>
										</ul>
									</div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							</div>
						</div>
						<div class='panel-footer'>
							<div class='row'>
								<div class='col-md-6 text-left'>
									<a href='../../edit_emp.php?e=".$array['eID']."'><button class='btn btn-primary btn-block' type='button'>Редактировать</button></a>
								</div>
								<div class='col-md-6 text-right'>
									<a href='#close'><button class='btn btn-danger btn-block' type='button'>Закрыть</button></a>
								</div>
							</div>
						</div>
					</div>
					<!-- END TABLE NO PADDING -->
				</div>
				<!-- Конец модальное окно 1 -->
			</td>
			<td>".$array['fullName']."</td>
			<td>".$array['number']."</td>
			<td>".$array['post']."</td>
			<td>".$rdate."</td>
			<td>$".$array['salary']."</td>
			<td>".$rdate."</td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ new_emp.php ------------------------------------------------------------------------------------------ */
// Функция СОЗДАНИЯ АККАУНТА
if (isset($_POST['reg_emp'])) // Если была нажата кнопка регистрации, проверим данные на корректность и, если данные введены и введены правильно, добавим запись с новым пользователем в БД.
{
	// Каталог, в который мы будем принимать файл:
	$uploaddir = '../img/emp/';
	$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

	// Копируем файл из каталога для временного хранения файлов:
	copy($_FILES['uploadfile']['tmp_name'], $uploadfile);

	$login = $_POST['log_emp'];
	$password = $_POST['pass_emp'];
	$fullname = $_POST['fullName_emp'];
	$birthDate = $_POST['birthDate_emp'];
	$number = $_POST['number_emp'];
	$mail = $_POST['mail_emp'];
	$post = $_POST['post_emp'];
	$salary = $_POST['salary_emp'];
	setlocale(LC_ALL, 'ru_RU.UTF-8'); // Переводим дату в формат СНГ.
	$reg_date = strftime('%F', time()); // Переменная, записывающая дату регистрации.
	$reg_ip = $_SERVER['REMOTE_ADDR']; // Записываем текущий IP
	// Обработка переменной. Мало ли что ввели.
		$login = stripslashes($login); 
		$login = htmlspecialchars($login); 
		$fullname = stripslashes($fullname); 
		$fullname = htmlspecialchars($fullname); 
	// Удаляем пробелы.
		$login = trim($login); 
		$password = trim($password);
		$fullname = trim($fullname); 
		$number = trim($number); 
		$salary = trim($salary); 
	// Дополнительная информация.
		$salt = mt_rand(100, 999); // Соль, для защиты пароля.
		$password = md5(md5($password).$salt); // Хэширование пароля.
	// Проверка на существование пользователя с таким же логином.
		$result = mysql_query("SELECT eID FROM users WHERE login='$login'");
		$myrow = mysql_fetch_array($result);
		if (!empty($myrow['eID'])) 
		{
			exit ("Данный логин уже занят!"); // Если пользователь с таким логином уже существует, перенаправляем на повторную регистрацию.
		}
	// Проверка на существование пользователя с такой же почтой.
		$result = mysql_query("SELECT eID FROM users WHERE mail='$mail'");
		$myrow = mysql_fetch_array($result);
		if (!empty($myrow['eID'])) 
		{
			exit ("Пользователь с таким email уже существует!"); // Если пользователь с такой почтой уже существует, перенаправляем на повторную регистрацию.
		}
	// Если все проверки пройдены успешно, сохраняем данные.
		$result2 = mysql_query ("INSERT INTO users (login,password,salt,fullName,birthDate,number,reg_date,reg_ip,mail,post,salary,status) VALUES ('$login','$password','$salt','$fullname','$birthDate','$number','$reg_date','$reg_ip','$mail','$post','$salary','$reg_date')");
	// Проверяем, есть ли ошибки.
		if ($result2=='TRUE')
		{
			$eID = $_SESSION['id'];
			$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Создал новый аккаунт', '-')");
			echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../employee.php'>"); // В случае если регистрация успешна. (Данные дошли до базы.)
			exit();
		}
		else 
		{
			echo "Ошибка!";
		}
}
/* ------------------------------------------------------------------------------------------ orders.php ------------------------------------------------------------------------------------------ */
// Функция вывода инфы для ЗАКАЗЫ. (ОБЩЕЕ)
function print_ordersall() {
	$query = mysql_query("SELECT * FROM orders");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ЗАКАЗЫ. (ЗАВЕРШЁННЫХ)
function print_ordersclosed() {
	$query = mysql_query("SELECT * FROM orders WHERE status='<span class=label-success>[6] ВЫПОЛНЕН</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ЗАКАЗЫ. (ОТМЕНЁННЫХ)
function print_orderscancel() {
	$query = mysql_query("SELECT * FROM orders WHERE status='<span class=label-danger>[5] ОТМЕНЕН</span>'");
	$rows = mysql_num_rows($query);
	echo " ".$rows." ";
}
// Функция вывода инфы для ЗАКАЗЫ. (СТОИМОСТЬ)
function print_orderssum() {
	$query = mysql_query("SELECT sum(cost) AS summ FROM ordersProd");
	$r = mysql_fetch_row($query);
	echo "$r[0]";
}
// Функция вывода ЗАКАЗОВ.
function print_orders() {
	$query = mysql_query("SELECT * FROM orders"); // Читаем таблицу orders
    $array = mysql_fetch_array($query);
	do
	{
		$query2 = mysql_query("SELECT * FROM ordersProd WHERE oID='".$array['oID']."'"); // Читаем таблицу ordersProd, по oID
		$array2 = mysql_fetch_array($query2);
		
		$sum = mysql_query("SELECT sum(cost) AS summ FROM ordersProd WHERE oID='".$array['oID']."'"); // Считаем сумму.
		$r = mysql_fetch_row($sum);
		
		$query3 = mysql_query("SELECT fullName FROM users WHERE eID='".$array['eID']."'"); // Читаем таблицу employee, для показа ФИО продавана
		$array3 = mysql_fetch_array($query3);
		
		$formatdate = date("d.m.y", strtotime($array['regDate']));
		$formattime = date("H:i", strtotime($array['regDate']));
		$deliverydate = date("d.m.y", strtotime($array['deliveryDate']));
		echo "
		<tr>
			<td>
				<!-- Вызов модального окна --> 
				<a href='#".$array['oID']."'>#".$array['oID']."</a> 
				<!-- Модальное окно 1 --> 
				<a class='overlay' href='#' id='".$array['oID']."'></a>
				<div class='col-md-12 popup'>
					<!-- TABLE NO PADDING -->
					<div class='panel panel-default'>
						<div class='panel-heading'>
							<h3 class='panel-title'>Информация по заказу #".$array['oID']."</h3>
						</div>
						<div class='panel-body'>
							<div class='clearfix'>
							<!-- LEFT COLUMN -->
							<div>
								<!-- PRODUCT HEADER -->
								<div class='profile-header'>
									<div class='overlay'></div>
									<div class='profile-main'>
										<a href='assets/img/prod/".$array2['oID']."-1.jpg' target='_blank'><img src='assets/img/prod/".$array2['oID']."-1.jpg' class='many_img' alt='NO_IMAGE' style='opacity: 0;'></a>
									</div>
								</div>
								<!-- END PRODUCT HEADER -->
								<!-- PRODUCT DETAIL -->
								<div>
									<div class='profile-info'>
										<h4 class='heading'>Товар</h4>
										<ul class='list-unstyled list-justify'>
											";
											// Циклим вывод всех товаров в заказе. Иначе никак.
											$query2 = mysql_query("SELECT * FROM ordersProd WHERE oID='".$array['oID']."'"); // Читаем таблицу orders
											$array2 = mysql_fetch_array($query2);
											do
											{
												echo " 
													<li><a href='../../products.php#".$array2['pID']."' target='_blank'>".$array2['nameProduct']."</a> <span>".$array2['amount']." шт. [$".$array2['cost']."]</span></li>
												";
											}
											while ($array2 = mysql_fetch_array($query2));
											// Цикл вывода всех товаров в заказе закончен.
											echo "
											<li class='box-products-sum'>Итого к оплате: <span>$".$r[0]."</span></li>
										</ul>
										<h4 class='heading'>Доставка</h4>
										<ul class='list-unstyled list-justify'>
											<li>Заказ оформлен <span><a href='../../employee.php#".$array['eID']."' target='_blank'>".$array3['fullName']."</a></span></li>
											<li>Способ доставки <span>".$array['deliveryMethod']."</span></li>
											<li>Адрес для доставки <span>".$array['deliveryAdress']."</span></li>
											<li>Дата оформления <span>".$formatdate." | ".$formattime."</span></li>
											<li>Дата доставки <span>".$deliverydate."</span></li>
										</ul>
										<h4 class='heading'>Покупатель</h4>
										<ul class='list-unstyled list-justify'>
											<li>ФИО <span>".$array['cFullName']."</span></li>
											<li>Контакт. Номер <span>".$array['cNumber']."</span></li>
										</ul>
									</div>
								</div>
								<!-- END PRODUCT DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							</div>
						</div>
						<div class='panel-footer'>
							<div class='row'>
								<div class='col-md-6 text-left'>
									<a href='../../edit_order.php?o=".$array['oID']."'><button class='btn btn-primary btn-block' type='button'>Редактировать</button></a>
								</div>
								<div class='col-md-6 text-right'>
									<a href='#close'><button class='btn btn-danger btn-block' type='button'>Закрыть</button></a>
								</div>
							</div>
						</div>
					</div>
					<!-- END TABLE NO PADDING -->
				</div>
				<!-- Конец модальное окно 1 -->
			</td>
			<td><a href='../../employee.php#".$array['eID']."' target='_blank'>".$array3['fullName']."</a></td>
			<td>".$array['cFullName']."</td>
			<td>$".$r[0]."</td>
			<td>".$formatdate."&nbsp;&nbsp;
				<span class='text-muted'>".$formattime."</span>
			</td>
			<td>".$array['status']."</td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
/* ------------------------------------------------------------------------------------------ sales.php ------------------------------------------------------------------------------------------ */
// Функция вывода АКЦИЙ.
function print_sale() {
	$query = mysql_query("SELECT * FROM sales");
    $array = mysql_fetch_array($query);
	do
	{
		echo "
		<tr>
			<td>".$array['sID']."</a></td>
			<td>".$array['heading']."</td>
			<td>".$array['details']."</td>
			<td>".$array['createDate']."</td>
			<td>".$array['expirationDate']."</td>
			<td>
				<form method='post' action='assets/scripts/global_func.php'>
					<input type='hidden' name='sID' value='".$array['sID']."'>
					<button name='delsale' type='submit' class='btn btn-danger btn-xxs'>Удалить</button>
				</form>
			</td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
// Удаление АКЦИИ.
if (isset($_POST['delsale'])) 
{
	$sID = $_POST['sID'];
	$result = mysql_query("DELETE FROM sales WHERE sID = '$sID'");
	if ($result == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Удалил акцию', '-')");
		exit ("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../sale.php'>"); // УСПЕХ
	}
	else 
	{
		echo "Ошибка!"; // ОШИБКА
	}
}
/* ------------------------------------------------------------------------------------------ categories.php ------------------------------------------------------------------------------------------ */
// Функция вывода КАТЕГОРИЙ.
function print_categories() {
	// 1
	$query = mysql_query("SELECT * FROM subCategories");
    $array = mysql_fetch_array($query);
	do
	{
		$query2 = mysql_query("SELECT * FROM products WHERE subCatID='".$array['subCatID']."'"); // Читаем таблицу products, для поиска всех товаров в СабКатегории.		
		$rows = mysql_num_rows($query2);
		$formatdate = date("d.m.Y", strtotime($array['createDate']));
		
		echo "
		<tr>
			<td>".$array['category']."</td>
			<td>".$array['subCategory']."</td>
			<td>".$rows."</td>
			<td>".$formatdate."</td>
			<td><a href='../../new_prod.php?c=".$array['subCatID']."'><button  class='btn btn-success btn-xxs' type='button'>Добавить товар</button></a></td>
			<td><a href='../../edit_subcat.php?c=".$array['subCatID']."'><button  class='btn btn-primary btn-xxs' type='button'>Редактировать</button></a></td>
			<td>
				<form method='post' action='assets/scripts/global_func.php'>
					<input type='hidden' name='subCatID' value='".$array['subCatID']."'>
					<button name='delcategory' type='submit' class='btn btn-danger btn-xxs'>Удалить</button>
				</form>
			</td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
// Удаление КАТЕГОРИИ.
if (isset($_POST['delcategory'])) 
{
	mysql_query('SET foreign_key_checks = 0');
	$subCatID = $_POST['subCatID'];
	$result = mysql_query("DELETE FROM subCategories WHERE subCatID = '$subCatID'");
	if ($result == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Удалил подкатегорию', '-')");
		exit ("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../categories.php'>"); // УСПЕХ
	}
	else 
	{
		echo "Ошибка!"; // ОШИБКА
	}
	mysql_query('SET foreign_key_checks = 1');
}
/* ------------------------------------------------------------------------------------------ new_cat.php ------------------------------------------------------------------------------------------ */
// Функция СОЗДАНИЯ КАТЕГОРИИ
if (isset($_POST['create_cat'])) // Если была нажата кнопка создания, записываем в БД после проверки.
{
	$name = $_POST['create_cat_name'];
	$desc = $_POST['create_cat_desc'];
	setlocale(LC_ALL, 'ru_RU.UTF-8'); // Переводим дату в формат СНГ.
	$date = strftime('%F', time()); // Переменная, записывающая дату регистрации.
	$read = mysql_query("SELECT eID FROM users WHERE login='$login'"); //
	// Проверка на существование похожего названия.
	if (!empty($myrow['eID'])) 
	{
		exit ("Категория с таким именем уже существует!"); // Если пользователь с таким логином уже существует, перенаправляем на повторную регистрацию.
	}
	// Записываем данные в базу.
	$result = mysql_query ("INSERT INTO categories (category, description, createDate) VALUES ('$name', '$desc', '$date')");
	if ($result == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Создал новую категорию', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../categories.php'>"); // Если данные записались - перенаправляем к списку категорий.
	}
}
/* ------------------------------------------------------------------------------------------ new_prod.php ------------------------------------------------------------------------------------------ */
// Функция СОЗДАНИЯ ТОВАРА. (ЧАСТЬ 1)
function print_subCatInfo() {
	$subCatID = $_GET['c']; // Вытягиваем ID категории из URL. Нужно для подбора инфо.полей.
	$query = mysql_query("SELECT info FROM subCategories WHERE subCatID='$subCatID'");
    $array = mysql_fetch_array($query);
	echo " <input type='hidden' name='subCatID' value='$subCatID'> ";
	$info = explode("|", $array['info']); // Преобразуем строку в массив и заносим в переменную.
	$arr_length = count($info); // Считаем количество переменных, на которые был разделен массив.
	
	/* ----- ИНФО.ПОЛЯ ----- */
	// Циклим вывод всех всех инф.полей в категории.
	for($i=0;$i<$arr_length;$i++) 
	{ 
		echo " 
			<div class='col-md-6'>
				<span class='title'>".$info[$i].":</span>
				<input name='info[]' type='text' class='form-control' autocomplete='off' required> 
				<br>
			</div>
		";
	}
	// Цикл вывода всех инф.полей закончен.
}
// Функция СОЗДАНИЯ ТОВАРА. (ЧАСТЬ 2)
if (isset($_POST['create_prod'])) // Если была нажата кнопка создания, записываем в БД после проверки.
{
	// Каталог, в который мы будем принимать файл:
	$uploaddir = '../img/prod/';
	$uploadprod = $uploaddir.basename($_FILES['uploadprod']['name']);
	// Копируем файл из каталога для временного хранения файлов:
	copy($_FILES['uploadprod']['tmp_name'], $uploadprod);
	
	$subCatID = $_POST['subCatID']; // Вытягиваем ID категории из URL. Нужно для подбора инфо.полей.
	$query = mysql_query("SELECT * FROM subCategories WHERE subCatID='$subCatID'");
    $array = mysql_fetch_array($query);
	setlocale(LC_ALL, 'ru_RU.UTF-8'); // Переводим дату в формат СНГ.
	
	/* ----- ПЕРЕМЕННЫЕ ----- */
	$date = strftime('%F', time()); // Переменная, записывающая дату.
	$info = implode("|", $_POST['info']); // Преобразуем массив в строку и заносим в переменную.
	$subCategory = $array['subCategory'];
	$subCatID = $array['subCatID'];
	$nameProduct = $_POST['nameProduct'];
	$cost = $_POST['cost'];
	$pCondition = $_POST['pCondition'];
	$size = $_POST['size'];
	$warranty = $_POST['warranty'];
	/* ----- ПЕРЕМЕННЫЕ ----- */
	
	// Записываем данные в базу.
	$result = mysql_query ("INSERT INTO products (nameProduct, category, subCatID, amount, cost, sales, product_reg, last_arrival, status, info, pCondition, size, warranty) VALUES ('$nameProduct','$subCategory','$subCatID','0','$cost','0','$date','$date','<span class=label-warning>ОЖИДАЕТСЯ</span>','$info','$pCondition','$size','$warranty')");
	if ($result == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Создал новый товар', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../products.php'>"); // Если данные записались - перенаправляем к списку категорий.
	}
}
/* ------------------------------------------------------------------------------------------ new_subcat.php ------------------------------------------------------------------------------------------ */
// Функция вывода доступных КАТЕГОРИЙ.
function print_availablecat() {
	$query = mysql_query("SELECT * FROM categories");
    $array = mysql_fetch_array($query);
	do
	{
		echo " <option value='".$array['category']."'>".$array['category']."</option> ";
	}
	while ($array = mysql_fetch_array($query));
}	
// Функция СОЗДАНИЯ ПОДКАТЕГОРИИ.
if (isset($_POST['create_subcat'])) // Если была нажата кнопка создания, записываем в БД после проверки.
{	
	setlocale(LC_ALL, 'ru_RU.UTF-8'); // Переводим дату в формат СНГ.
	/* ----- ПЕРЕМЕННЫЕ ----- */
	$date = strftime('%F', time()); // Переменная, записывающая дату.
	$category = $_POST['category']; // Вытягиваем категорию из select'a.
	$subCategory = $_POST['subCategory']; // Вытягиваем название БУДУЩЕЙ подкатегории.
	$description = $_POST['description']; // Вытягиваем описание БУДУЩЕЙ подкатегории.
	$info = implode("|", $_POST['subinfo']); // Преобразуем массив в строку и заносим в переменную.
	/* ----- ПЕРЕМЕННЫЕ ----- */
	
	// Записываем данные в базу.
	$result = mysql_query ("INSERT INTO subCategories (category, subCategory, description, info, createDate) VALUES ('$category','$subCategory','$description', '$info','$date')");
	if ($result == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Создал новую подкатегорию', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../categories.php'>"); // Если данные записались - перенаправляем к списку категорий.
	}
}
/* ------------------------------------------------------------------------------------------ edit_subcat.php ------------------------------------------------------------------------------------------ */
// Функция вывода доступных КАТЕГОРИЙ.
function edit_subcat_category() {
	$subCatID = $_GET['c']; // Вытягиеваем ID подкатегории
	$query = mysql_query("SELECT category FROM subCategories WHERE subCatID='$subCatID'");
    $array = mysql_fetch_array($query);
	$category = $array['category'];
	// Выводим option с атрибутом selected. Выводит выбранную категорию на данный момент.
	$query2 = mysql_query("SELECT * FROM categories WHERE category='$category'");
    $array2 = mysql_fetch_array($query2);
	echo " <option value='".$array2['category']."' selected>".$array2['category']."</option> ";
	// Вывод всех остальных доступных категорий. Без selecteda на option.
	$query3 = mysql_query("SELECT * FROM categories WHERE category<>'$category'");
    $array3 = mysql_fetch_array($query3);
	do
	{
		echo " <option value='".$array3['category']."'>".$array3['category']."</option> ";
	}
	while ($array3 = mysql_fetch_array($query3));
}
// Функция вывода НАЗВАНИЯ РЕДАКТИРУЕМОЙ КАТЕГОРИИ.
function edit_subcat_subCategory() {
	$subCatID = $_GET['c']; // Вытягиеваем ID подкатегории
	$query = mysql_query("SELECT subCategory FROM subCategories WHERE subCatID='$subCatID'");
    $array = mysql_fetch_array($query);
	echo "".$array['subCategory']."";
}
// Функция вывода ОПИСАНИЯ РЕДАКТИРУЕМОЙ КАТЕГОРИИ.
function edit_subcat_description() {
	$subCatID = $_GET['c']; // Вытягиеваем ID подкатегории
	$query = mysql_query("SELECT description FROM subCategories WHERE subCatID='$subCatID'");
    $array = mysql_fetch_array($query);
	echo "".$array['description']."";
}
// Функция вывода ИНФОПОЛЕЙ РЕДАКТИРУЕМОЙ КАТЕГОРИИ.
function edit_subcat_info() {
	$subCatID = $_GET['c']; // Вытягиеваем ID подкатегории
	$query = mysql_query("SELECT info FROM subCategories WHERE subCatID='$subCatID'");
    $array = mysql_fetch_array($query);
	echo "<input type='hidden' name='subCatID' value='$subCatID'>";
	$info = explode("|", $array['info']); // Преобразуем строку в массив и заносим в переменную.
	$arr_length = count($info); // Считаем количество переменных, на которые был разделен массив.
	
	/* ----- ИНФО.ПОЛЯ ----- */
	// Циклим вывод всех всех инф.полей в категории.
	for($i=0;$i<$arr_length;$i++) 
	{ 
		echo " 
		<div class='col-md-6'>
			<span class='title'>Поле:</span>
			<input name='subinfo[]' type='text' class='form-control' value='".$info[$i]."'>
			<br>
		</div>
		";
	}
	// Цикл вывода всех инф.полей закончен.
}
// Функция РЕДАКТИРОВАНИЯ ПОДКАТЕГОРИИ.
if (isset($_POST['edit_subcat'])) // Если была нажата кнопка создания, обновляем запись в БД после проверки.
{	
	/* ----- ПЕРЕМЕННЫЕ ----- */
	$subCatID = $_POST['subCatID']; // Вытягиеваем ID подкатегории
	$category = $_POST['category']; // Вытягиваем новую категорию из select'a.
	$subCategory = $_POST['subCategory']; // Вытягиваем новое название подкатегории.
	$description = $_POST['description']; // Вытягиваем новое описание подкатегории.
	$info = implode("|", $_POST['subinfo']); // Преобразуем массив в строку и заносим в переменную.
	/* ----- ПЕРЕМЕННЫЕ ----- */
	
	// Записываем данные в базу.
	$result = mysql_query ("UPDATE subCategories SET category='$category', subCategory='$subCategory', description='$description', info='$info' WHERE subCatID='$subCatID'");
	// В случае успеха, перенаправляем.
	if ($result == 'TRUE') 
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Отредактировал подкатегорию', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../categories.php'>"); // Если данные записались - перенаправляем к списку категорий.
	}
}
/* ------------------------------------------------------------------------------------------ edit_emp.php ------------------------------------------------------------------------------------------ */
// Функция вывода ЛОГИНА РЕДАКТИРУЕМОГО АККАУНТА.
function edit_emplog() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT login FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['login']."";
}
// Функция вывода ФИО РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empfn() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT fullName FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['fullName']."";
}
// Функция вывода МОБ.НОМЕРА РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empnum() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT number FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['number']."";
}
// Функция вывода ПОЧТЫ РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empmail() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT mail FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['mail']."";
}
// Функция вывода СТАВКИ РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empsal() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT salary FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['salary']."";
}
// Функция вывода РЕГИСТРАЦИИ РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empregdate() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT reg_date FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['reg_date']."";
}
// Функция вывода regIP РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empip() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT reg_ip FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['reg_ip']."";
}
// Функция вывода birthDAte РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empbdate() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT birthDate FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['birthDate']."";
}
// Функция вывода pass РЕДАКТИРУЕМОГО АККАУНТА.
function edit_emppass() {
	$eID = $_GET['e']; // Вытягиеваем ID аккаунта
	$query = mysql_query("SELECT password FROM users WHERE eID='$eID'");
    $array = mysql_fetch_array($query);
	echo "".$array['password']."";
}
// Функция вывода ID РЕДАКТИРУЕМОГО АККАУНТА.
function edit_empid() {
	echo $_GET['e'];
}
// Функция РЕДАКТИРОВАНИЯ АККАУНТА.
if (isset($_POST['edit_emp'])) // Если была нажата кнопка создания, обновляем запись в БД после проверки.
{	
	// Каталог, в который мы будем принимать файл:
	$uploaddir = '../img/emp/';
	$uploademp = $uploaddir.basename($_FILES['uploademp']['name']);
	// Копируем файл из каталога для временного хранения файлов:
	copy($_FILES['uploademp']['tmp_name'], $uploademp);

	/* ----- ПЕРЕМЕННЫЕ ----- */
	$id_emp = $_POST['id_emp']; 
	$log_emp = $_POST['log_emp']; 
	$pass_emp = $_POST['pass_emp']; 
	$fullName_emp = $_POST['fullName_emp']; 
	$birthDate_emp = $_POST['birthDate_emp']; 
	$number_emp = $_POST['number_emp']; 
	$mail_emp = $_POST['mail_emp']; 
	$post_emp = $_POST['post_emp']; 
	$salary_emp = $_POST['salary_emp']; 
	/* ----- ПЕРЕМЕННЫЕ ----- */
	
	// Записываем данные в базу.
	$result = mysql_query ("UPDATE users SET login='$log_emp', password='$pass_emp', fullName='$fullName_emp', birthDate='$birthDate_emp', number='$number_emp', mail='$mail_emp', post='$post_emp', salary='$salary_emp' WHERE eID='$id_emp'");
	if ($result == 'TRUE') 
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Отредактировал аккаунт', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../employee.php'>"); // Если данные записались - перенаправляем к списку сотрудников.
	}
}
/* ------------------------------------------------------------------------------------------ edit_order.php ------------------------------------------------------------------------------------------ */
// Функция вывода товаров РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_orderProd() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT * FROM ordersProd WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	do
	{
		echo "
		<div class='col-md-6 center'>
			<span class='title'>".$array['nameProduct']."</span>
			<a href='assets/img/prod/".$array['pID']."-1.png' target='_blank'><img src='assets/img/prod/".$array['pID']."-1.png' class='img-editorder' alt='NO_IMAGE'></a>
		</div>
		";
	}
	while ($array = mysql_fetch_array($query));
}
// Функция вывода ФИО покупателя РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_ordercfn() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT cFullName FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	echo "".$array['cFullName']."";
}
// Функция вывода НОМЕРА покупателя РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_ordercnum() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT cNumber FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	echo "".$array['cNumber']."";
}
// Функция вывода номера РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_orderid() {
	echo $_GET['o'];
}
// Функция вывода оформившего РЕДАКТИРУЕМЫЙ ЗАКАЗ.
function edit_ordereid() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT eID FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	$eID = $array['eID'];
	// Выводим option с атрибутом selected. Выводит записанного сотрудника на данный момент.
	$query2 = mysql_query("SELECT eID FROM orders WHERE eID='$eID'");
    $array2 = mysql_fetch_array($query2);
	echo " <option value='".$array2['eID']."' selected>".$array2['eID']."</option> ";
	// Вывод всех остальных доступных сотрудников. Без selecteda на option.
	$query3 = mysql_query("SELECT eID FROM users WHERE eID<>'$eID'");
    $array3 = mysql_fetch_array($query3);
	do
	{
		echo " <option value='".$array3['eID']."'>".$array3['eID']."</option> ";
	}
	while ($array3 = mysql_fetch_array($query3));
}
// Функция вывода способа доставки РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_orderdm() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT deliveryMethod FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	$dm = $array['deliveryMethod']; // Вытягиеваем текущий способ заказа.
	echo " <option value='".$dm."' selected>".$dm."</option> ";
	// Вывод всех остальных доступных способов. Без selecteda на option.
	$query2 = mysql_query("SELECT DISTINCT deliveryMethod FROM orders WHERE deliveryMethod<>'$dm'");
    $array2 = mysql_fetch_array($query2);
	do
	{
		echo " <option value='".$array2['deliveryMethod']."'>".$array2['deliveryMethod']."</option> ";
	}
	while ($array2 = mysql_fetch_array($query2));
}
// Функция вывода адреса доставки РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_orderda() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT deliveryAdress FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	echo "".$array['deliveryAdress']."";
}
// Функция вывода даты заказа РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_orderreg() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT regDate FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	echo "".$array['regDate']."";
}
// Функция вывода даты доставки РЕДАКТИРУЕМОГО ЗАКАЗА.
function edit_orderdelivery() {
	$oID = $_GET['o']; // Вытягиеваем ID заказа
	$query = mysql_query("SELECT deliveryDate FROM orders WHERE oID='$oID'");
    $array = mysql_fetch_array($query);
	echo "".$array['deliveryDate']."";
}
// Функция РЕДАКТИРОВАНИЯ ЗАКАЗА.
if (isset($_POST['edit_order'])) // Если была нажата кнопка создания, обновляем запись в БД после проверки.
{	
	/* ----- ПЕРЕМЕННЫЕ ----- */
	$oID = $_POST['id_order']; 
	$cFullName = $_POST['cFullName_order']; 
	$cNumber = $_POST['cNumber_order']; 
	$eID = $_POST['eid_order']; 
	$deliveryMethod = $_POST['deliveryMethod_order']; 
	$deliveryAdress = $_POST['deliveryAdress_order']; 
	$deliveryDate = $_POST['delivery_order']; 
	/* ----- ПЕРЕМЕННЫЕ ----- */
	
	// Записываем данные в базу.
	$result = mysql_query ("UPDATE orders SET cFullName='$cFullName', cNumber='$cNumber', eID='$eID', deliveryMethod='$deliveryMethod', deliveryAdress='$deliveryAdress', deliveryDate='$deliveryDate' WHERE oID='$oID'");
	if ($result == 'TRUE') 
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Отредактировал заказ', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../orders.php'>"); // Если данные записались - перенаправляем к списку заказов.
	}
}
/* ------------------------------------------------------------------------------------------ edit_prod.php ------------------------------------------------------------------------------------------ */
// Функция вывода фото товаров РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodPhoto() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	echo "
	<div class='col-md-4 center'>
		<a href='assets/img/prod/".$pID."-1.png' target='_blank'><img src='assets/img/prod/".$pID."-1.png' class='img-editorder' alt='NO_IMAGE'></a>
	</div>
	<div class='col-md-4 center'>
		<a href='assets/img/prod/".$pID."-2.png' target='_blank'><img src='assets/img/prod/".$pID."-2.png' class='img-editorder' alt='NO_IMAGE'></a>
	</div>
	<div class='col-md-4 center'>
		<a href='assets/img/prod/".$pID."-3.png' target='_blank'><img src='assets/img/prod/".$pID."-3.png' class='img-editorder' alt='NO_IMAGE'></a>
	</div>
	";
}
// Функция вывода номера РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodid() {
	echo $_GET['p'];
}
// Функция вывода наименования РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodname() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT nameProduct FROM products WHERE pID='$pID'");
    $array = mysql_fetch_array($query);
	echo "".$array['nameProduct']."";
}
// Функция вывода цены РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodcost() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT cost FROM products WHERE pID='$pID'");
    $array = mysql_fetch_array($query);
	echo "".$array['cost']."";
}
// Функция вывода состояния РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodcon() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT pCondition FROM products WHERE pID='$pID'");
    $array = mysql_fetch_array($query);
	$pcon = $array['pCondition']; // Вытягиеваем текущее состояние товара.
	echo " <option value='".$pcon."' selected>".$pcon."</option> ";
	// Вывод всех остальных доступных стостояний. Без selecteda на option.
	$query2 = mysql_query("SELECT DISTINCT pCondition FROM products WHERE pCondition<>'$pcon'");
    $array2 = mysql_fetch_array($query2);
	do
	{
		echo " <option value='".$array2['pCondition']."'>".$array2['pCondition']."</option> ";
	}
	while ($array2 = mysql_fetch_array($query2));
}
// Функция вывода размеров РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodsize() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT size FROM products WHERE pID='$pID'");
    $array = mysql_fetch_array($query);
	echo "".$array['size']."";
}
// Функция вывода гарантии РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodgar() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT warranty FROM products WHERE pID='$pID'");
    $array = mysql_fetch_array($query);
	echo "".$array['warranty']."";
}
// Функция вывода доп.информации РЕДАКТИРУЕМОГО ТОВАРА.
function edit_prodinfo() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT subCatID, info FROM products WHERE pID='$pID'");
    $array = mysql_fetch_array($query);
	$infoval = explode("|", $array['info']); // Преобразуем строку в массив и заносим в переменную.
	$arr_length = count($infoval); // Считаем количество переменных, на которые был разделен массив.
	/* ----- ИНФО.ПОЛЯ ----- */
	$subCatID = $array['subCatID']; // Вытягиваем ID сабкатегории, в которой расположен товар
	$query2 = mysql_query("SELECT info FROM subCategories WHERE subCatID='$subCatID'");
    $array2 = mysql_fetch_array($query2);
	$info = explode("|", $array2['info']); // Преобразуем строку в массив и заносим в переменную.
	/* ----- ИНФО.ПОЛЯ ----- */
	
	// Циклим вывод всех всех доп.полей для этого товара.
		for($i=0;$i<$arr_length;$i++) 
		{ 
			echo "
			<div class='col-md-4'>
			<span class='title'>".$info[$i].":</span>
			<input name='prodinfo[]' type='text' class='form-control' value='".$infoval[$i]."'> 
			<br>
			</div>
			";
		}
	// Цикл вывода всех инф.полей закончен.
}
// Функция РЕДАКТИРОВАНИЯ ТОВАРА.
if (isset($_POST['edit_prod'])) // Если была нажата кнопка создания, обновляем запись в БД после проверки.
{	
	/* ----- ПЕРЕМЕННЫЕ ----- */
	$pID = $_POST['id_prod']; // Вытягиеваем ID товара
	$name_prod = $_POST['name_prod']; 
	$cost_prod = $_POST['cost_prod']; 
	$con_prod = $_POST['con_prod']; 
	$size_prod = $_POST['size_prod']; 
	$gar_prod = $_POST['gar_prod']; 
	/* ----- ПЕРЕМЕННЫЕ ----- */
	
	// Записываем данные в базу.
	$result = mysql_query ("UPDATE products SET nameProduct='$name_prod', cost='$cost_prod', pCondition='$con_prod', size='$size_prod', warranty='$gar_prod' WHERE pID='$pID'");
	if ($result == 'TRUE') 
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Отредактировал товар', '-')");
		echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../products.php'>"); // Если данные записались - перенаправляем к списку заказов.
	}
}
// Удаление ТОВАРА.
if (isset($_POST['delprod'])) 
{
	mysql_query('SET foreign_key_checks = 0');
	$id_prod = $_POST['id_prod'];
	$result = mysql_query("DELETE FROM products WHERE pID = '$id_prod'");
	if ($result == 'TRUE')
	{
		$eID = $_SESSION['id'];
		$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Удалил товар', '-')");
		exit ("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../products.php'>"); // УСПЕХ
	}
	else 
	{
		echo "Ошибка!"; // ОШИБКА
	}
	mysql_query('SET foreign_key_checks = 1');
}
/* ------------------------------------------------------------------------------------------ index.php ------------------------------------------------------------------------------------------ */
// Функция вывода ПОСЛЕДНИХ ЗАКАЗОВ.
function index_orders() {
	$query = mysql_query("SELECT * FROM orders ORDER BY oID DESC LIMIT 10"); // Читаем таблицу orders
    $array = mysql_fetch_array($query);
	do
	{
		$query2 = mysql_query("SELECT * FROM ordersProd WHERE oID='".$array['oID']."'"); // Читаем таблицу ordersProd, по oID
		$array2 = mysql_fetch_array($query2);
		
		$sum = mysql_query("SELECT sum(cost) AS summ FROM ordersProd WHERE oID='".$array['oID']."'"); // Считаем сумму.
		$r = mysql_fetch_row($sum);
		
		$date = $array['regDate'];
		$formatdate = date("d.m.y", strtotime($date));
		$formattime = date("H:i", strtotime($date));
		echo "
		<tr>
			<td><a target='_blank' href='../../orders.php#".$array['oID']."'>#".$array['oID']."</a></td>
			<td>".$array['cFullName']."</td>
			<td>$".$r[0]."</td>
			<td>".$formatdate." &nbsp;&nbsp;
				<span class='text-muted'>".$formattime."</span>
			</td>
			<td>".$array['status']."</td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
// Функция вывода информации по ЛАСТ РАССЫЛКЕ. (ВСЕГО ОТПРАВЛЕНО)
function last_mailing1() {
	$query = mysql_query("SELECT total_mess FROM mailing ORDER BY mID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	echo $array['total_mess'];
}
// Функция вывода информации по ЛАСТ РАССЫЛКЕ. (КЛИКОВ)
function last_mailing2() {
	$query = mysql_query("SELECT click_mess FROM mailing ORDER BY mID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	echo $array['click_mess'];
}
// Функция вывода информации по ЛАСТ РАССЫЛКЕ. (ОТКАЗАЛИСЬ)
function last_mailing3() {
	$query = mysql_query("SELECT unsub_mess FROM mailing ORDER BY mID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	echo $array['unsub_mess'];
}
// Функция вывода информации по ЛАСТ РАССЫЛКЕ. (КЛИКОВ)
function last_mailing_prof() {
	$query = mysql_query("SELECT * FROM mailing ORDER BY mID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	$all_mess = $array['total_mess'];
	$click_mess = $array['click_mess'];
	$mailing_prof = ($click_mess/$all_mess)*100;
	$mailing_prof = substr($mailing_prof, 0, 4); // Выбираем первых 4* символа.
	
	echo $mailing_prof;
}
// Функция вывода информации по ГОДОВОМУ ДОХОДУ.
function year_profit() {
	$sum = mysql_query("SELECT sum(statInfo) AS summ FROM stat WHERE statName='profit' LIMIT 12"); // Считаем сумму.
	$r = mysql_fetch_row($sum);
	echo $r[0];
}
// Функция вывода информации по ЛАСТ ДОХОДУ.
function last_profit() {
	$query = mysql_query("SELECT statInfo FROM stat WHERE statName='profit' ORDER BY statID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	echo $array['statInfo'];
}
// Функция вывода информации по ЛАСТ ДОХОДУ. (В ПРОЦЕНТАХ В СРАВНЕНИИ)
function last_profit_per() {
	$query = mysql_query("SELECT statInfo FROM stat WHERE statName='profit' ORDER BY statID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	$current_m = $array['statInfo'];
	
	$query = mysql_query("SELECT statInfo FROM stat WHERE statName='profit' ORDER BY statID DESC LIMIT 1, 1");
	$array = mysql_fetch_array($query);
	$last_m = $array['statInfo'];
	
	if ($current_m < $last_m)
	{
		$per = 100-($current_m*100/$last_m);
		$per = substr($per, 0, 2); // Выбираем первых 2* символа.
		echo "
			<span class='change down'><i class='lnr lnr-chevron-down'></i> ".$per."%</span>
		";
	}
	else
	{
		$per = ($current_m*100/$last_m)-100;
		$per = substr($per, 0, 2); // Выбираем первых 2* символа.
		echo "
			<span class='change up'><i class='lnr lnr-chevron-up'></i> ".$per."%</span>
		";
	}
}
// Функция вывода информации по ЛАСТ ПОСЕЩЕНИЯМ.
function last_visits() {
	$query = mysql_query("SELECT statInfo FROM stat WHERE statName='visits' ORDER BY statID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	echo $array['statInfo'];
}
// Функция вывода информации по ЛАСТ ПОСЕЩЕНИЯМ. (В ПРОЦЕНТАХ В СРАВНЕНИИ)
function last_visits_per() {
	$query = mysql_query("SELECT statInfo FROM stat WHERE statName='visits' ORDER BY statID DESC LIMIT 1");
	$array = mysql_fetch_array($query);
	$current_v = $array['statInfo'];
	
	$query = mysql_query("SELECT statInfo FROM stat WHERE statName='visits' ORDER BY statID DESC LIMIT 1, 1");
	$array = mysql_fetch_array($query);
	$last_v = $array['statInfo'];
	
	if ($current_v < $last_v)
	{
		$per = 100-($current_v*100/$last_v);
		$per = substr($per, 0, 2); // Выбираем первых 2* символа.
		echo "
			<span class='change down'><i class='lnr lnr-chevron-down'></i> ".$per."%</span>
		";
	}
	else
	{
		$per = ($current_v*100/$last_v)-100;
		$per = substr($per, 0, 2); // Выбираем первых 2* символа.
		echo "
			<span class='change up'><i class='lnr lnr-chevron-up'></i> ".$per."%</span>
		";
	}
}
// Функция вывода информации по ПОСЕЩЕНИЯМ ЗА ГОД.
function year_visits() {
	$sum = mysql_query("SELECT sum(statInfo) AS summ FROM stat WHERE statName='visits' LIMIT 12"); // Считаем сумму.
	$r = mysql_fetch_row($sum);
	echo $r[0];
}
// Функция вывода TOP-10.
function index_top10() {
	$query = mysql_query("SELECT * FROM products ORDER BY sales DESC LIMIT 10"); // Читаем таблицу products
    $array = mysql_fetch_array($query);
	do
	{	
		$sales = $array['sales'];
		$cost = $array['cost'];
		$r = $sales*$cost;
		
		echo "
		<tr>
			<td>".$array['nameProduct']."</td>
			<td><i class='fa fa-eye'></i> ".$array['views']."</td>
			<td><i class='fa fa-shopping-cart'></i> ".$array['sales']."</td>
			<td><i class='fa fa-money'></i> $".$r."</td>
			<td><a href='products.php#".$array['pID']."'><i class='fa fa-bar-chart'></i></a></td>
		</tr>
		";
	}
	while ($array = mysql_fetch_array($query));
}
// Функция УВЕДОМЛЕНИЙ.
function notification() {
	$sum_notf = 0; // Переменная кол-ва уведомлений.
	
	/*--------- ИЩЕМ ПОВОД ДЛЯ УВЕДОМЛЕНИЙ ---------*/
		// ТОВАР
		$query1 = mysql_query("SELECT status FROM products WHERE status='<span class=label-danger>НЕТ НА СКЛАДЕ</span>'");
		$rows1 = mysql_num_rows($query1);
		if ($rows1 != '0')
		{
			$sum_notf++;
		}
		// ЗАКАЗЫ
		$query2 = mysql_query("SELECT status FROM orders WHERE status='<span class=label-warning>[1] В ОЖИДАНИИ</span>'");
		$rows2 = mysql_num_rows($query2);
		if ($rows2 != '0')
		{
			$sum_notf++;
		}
		// ТИКЕТЫ
		$query3 = mysql_query("SELECT status FROM tikets WHERE status='<span class=label-warning>ОЖИДАЕТ ОТВЕТА</span>'");
		$rows3 = mysql_num_rows($query3);
		if ($rows3 != '0')
		{
			$sum_notf++;
		}
		// ПОСТАВКА
		$time = strftime('%F', time());
		$query4 = mysql_query("SELECT arrivalDate FROM supplyHistory WHERE arrivalDate='$time'");
		$rows4 = mysql_num_rows($query4);
		if ($rows4 != '0')
		{
			$sum_notf++;
		}
	/*--------- НАШЛИ ПОВОД ДЛЯ УВЕДОМЛЕНИЙ ---------*/
	
	/*--------- ВЫВОД УВЕДОМЛЕНИЙ ---------*/
		// СЧЕТЧИК
		if ($sum_notf != '0')
		{
			echo "<span class='badge bg-danger'>".$sum_notf."</span>";
		}
		echo "</a><ul class='dropdown-menu notifications'>";
		// ТОВАР
		if ($rows1 != '0')
		{
			echo " <li><a href='products.php' class='notification-item'><span class='dot bg-danger'></span>Некоторые товары закончились!</a></li> ";
		}
		// ЗАКАЗЫ
		if ($rows2 != '0')
		{
			echo " <li><a href='orders.php' class='notification-item'><span class='dot bg-danger'></span>Есть ожидающие заказы!</a></li> ";
		}
		// ТИКЕТЫ
		if ($rows3 != '0')
		{
			echo " <li><a href='tikets.php' class='notification-item'><span class='dot bg-danger'></span>Есть ожидающие тикеты!</a></li> ";
		}
		// ПОСТАВКА
		if ($rows4 != '0')
		{
			echo " <li><a href='supply.php' class='notification-item'><span class='dot bg-success'></span>Сегодня ожидается поставка товара</a></li> ";
		}
		// ЕСЛИ НЕТ УВЕДОМЛЕНИЙ
		if ($sum_notf == '0')
		{
			echo " <li><a href='#' class='notification-item'>Нет уведомлений</a></li> ";
		}
		echo "</ul>";
	/*--------- УВЕДОМЛЕНИЯ ВЫВЕДЕНЫ ---------*/
}
/* ------------------------------------------------------------------------------------------ new_sup.php ------------------------------------------------------------------------------------------ */
// Функция вывода pID для ОФОРМЛЕНИЯ ПОСТАВКИ.
function sup_pid() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	echo $pID;
}
// Функция вывода nameProduct для ОФОРМЛЕНИЯ ПОСТАВКИ.
function sup_pname() {
	$pID = $_GET['p']; // Вытягиеваем ID товара
	$query = mysql_query("SELECT nameProduct FROM products WHERE pID='$pID'");
	$array = mysql_fetch_array($query);
	echo $array['nameProduct'];
}
// Функция ОФОРМЛЕНИЯ ПОСТАВКИ
if (isset($_POST['create_sup'])) // Если была нажата кнопка создания, записываем в БД после проверки.
{
	$pID = $_POST['pID'];
	$pName = $_POST['pName'];
	$pCost = $_POST['pCost'];
	$pAmount = $_POST['pAmount'];
	$oDate = $_POST['oDate'];
	$aDate = $_POST['aDate'];
	$sCompany = $_POST['sCompany'];
	$sName = $_POST['sName'];
	// Записываем данные в базу.
	$result = mysql_query ("INSERT INTO supplyHistory (pID, nameProduct, supplyAmount, oneCost, orderDate, arrivalDate, supplierCompany, supplierName) VALUES ('$pID', '$pName', '$pAmount', '$pCost', '$oDate', '$aDate', '$sCompany', '$sName')");
	if ($result == 'TRUE')
	{
		$result2 = mysql_query ("UPDATE products SET amount=(amount+$pAmount) WHERE pID='$pID'");
		if ($result2 == 'TRUE')
		{	
			$eID = $_SESSION['id'];
			$result = mysql_query ("INSERT INTO activityHistory (eID, action, link) VALUES ('$eID', 'Оформил новую поставку', '-')");
			echo("<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=../../supply.php'>"); // Если данные записались - перенаправляем к списку категорий.
		}
	}
}
?>