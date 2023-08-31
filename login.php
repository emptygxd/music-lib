<?php
if ($_COOKIE['id']){
	header('Location: index.php');
}
if ($_GET["error"]==1)
{
	echo '<script> alert( "Неверный пароль или логин" ); </script>';
}

if ($_GET["reg_accept"]==1)
{
	echo '<script> alert( "Регистрация выполнена успешно" ); </script>';
}

if ($_GET["zareg"]==1)
{
	echo '<script> alert( "Зарегистрируйтесь или войдите в свой аккаунт" ); </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Авторизация</title>
	<link rel="icon" href="images/exitPurp.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body class="bodySet">	
	<div class="wrapper">
		<header class="headerLog">
			<li><img src="images/logo.webp" width="50px" height="50px"></li>
			<li style="margin-left: 20px;">AKUETTO</li>
		</header>
			<hr class="headerHr">

		<section class="main-contentLog">
			<form action="vendor/auth.php" method="post">
				<div class="log">
				<p style="margin-top: 196px;">Электронная почта</p>
				<input class="myauth" placeholder=" Эл. почта" type="text" name="login" required>
				<p style="margin-top: 25px;">Пароль</p>
				
				<label class="pass__label">
				<input class="myauth password__input" placeholder=" Пароль" type="password" name="password" required>
				<div class="pass__btn"><img src="images/eye.png" style="width: 35px;height: 35px;"></div>
				</label>

				<button class="mybtn cursor" type="submit">Войти</button>
			</form>
			<hr class="contentHr">
	
			<h1 style="margin-bottom: 55px;">Нет аккаунта?</h1>
			<a href="reg.php"><button class="mybtn2 cursor" type="button">Регистрация</button></a>
			</div>
		</section>
	</div>
	<script src="js/password.js"></script>
</body>
</html>