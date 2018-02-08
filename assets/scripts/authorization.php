<?php
session_start();
include ('connect.php'); // Подключаемся к БД.

// Проверим, быть может пользователь уже авторизирован. Если это так, перенаправим его на главную страницу сайта.
if (isset($_SESSION['id'])) 
{
	header('Location: ../../index.php');
}
else 
{
	//////////////////// -- AUTHORIZATION -- ////////////////////
	if (isset($_POST['log'])) 
	{
		if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //Введеный логин = $login. Если пусто - удаляем переменную.
		if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} } //Введеный пароль = $password. Если пусто - удаляем переменную.
		$login = $_POST['login'];
		$password = $_POST['password'];
		$ip = $_SERVER['REMOTE_ADDR'];
	// Обработка переменной. Мало ли что ввели.
		$login = stripslashes($login); 
		$login = htmlspecialchars($login); 
		$password = stripslashes($password); 
		$password = htmlspecialchars($password);
	// Удаляем пробелы.
		$login = trim($login); 
		$password = trim($password);
		setlocale(LC_ALL, 'ru_RU.UTF-8'); // Переводим дату в формат СНГ.
		$time = strftime('%F %H:%M:%S', time()); // Переменная, записывающая дату авторизации.
	// Извлекаем из базы все данные о пользователе с введенным логином.
		$result = mysql_query("SELECT * FROM users WHERE login='$login'");
		$myrow = mysql_fetch_array($result); 
	// Если не найден пароль у введеного логина. (Нет пароля - нет аккаунта. Вдруг регистрация была не закончена и данные оборвались.)
		if (empty($myrow['password']))
		{
			echo "Ошибка! Пользователя с таким логином не существует!";
		}
	// Если пароль у введеного логина найден - сверяем пароли.
		else 
		{			
			if (md5(md5($password).$myrow['salt']) == $myrow['password'])
			{
				// Если пароли совпадают, то запускаем пользователю сессию.
				$_SESSION['id']=$myrow['eID']; // Записываем в сессию id пользователя.
				// Делаем переменные для записи в таблицу loggingHistory.
				$id = $myrow['eID'];
				$eFullName = $myrow['fullName'];
				$post = $myrow['post'];
				// Записываем вход в базу loggingHistory, перенаправляем на главную страницу ЛК.
				mysql_query ("INSERT INTO loggingHistory (eID,login,eFullName,post,loginDate,ip) VALUES ('$id','$login','$eFullName','$post','$time','$ip')"); // Записываем вход в базу loggingHistory.
				echo("<html><head><title>Loading..</title><meta http-equiv='Refresh' content='0; URL= ../../index.php '></head></html>"); // Перенаправляем на главную страницу ЛК.
			}
			else 
			{
				// Если введеный пароль и пароль в БД не сошлись.
				echo "Ошибка! Неверный пароль!";
			}
		}
	}
	//////////////////// -- AUTHORIZATION END -- ////////////////////
}
?>