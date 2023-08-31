<?php
if ($_GET["reg_error"]==1){
	echo '<script> alert( "Ошибка регистрации! Проверьте правильность введенных данных." ); </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Регистрация</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/reg.css">
</head>
<body class="bodySet">
	<div class="wrapper">
		<header class="headerLog">
			<li><img src="images/logo.webp" width="50px" height="50px"></li>
			<li style="margin-left: 20px;">AKUETTO</li>
		</header>
		<section class="main-contentLog">
	<div class="reg">
		<h1 style="font-size: 30px; margin-top: 30px;"> Зарегистрируйтесь и пользуйтесь </h1>
		<h1 style="font-size: 30px; margin-top: 0; margin-bottom: 60px;">всеми возможностями сайта бесплатно </h1>
			<form action="vendor/registration.php" method="post" enctype="multipart/form-data">
			<p >Ваша электронная почта</p>
			<input class="myauth2" placeholder="Эл. почта" type="text" name="login" required >
			<p>Придумайте пароль</p>
			<label class="pass__label">
				<input class="myauth2 pass__input1" placeholder="Пароль" type="password" name="password1" required >
				<div style="top: -7px;" class="pass__btn1"><img src="images/eye.png" style="width: 35px;height: 35px;"></div>
			</label>
			<p>Подтвердите пароль</p>
			<label class="pass__label">
				<input class="myauth2 pass__input2" placeholder="Пароль" type="password" name="password2" required>
				<div style="top: -7px;" class="pass__btn2"><img src="images/eye.png" style="width: 35px;height: 35px;"></div>
			</label>
			<div>
			<p>Ваше имя (никнейм)</p>
			<input class="myauth2" placeholder="Имя" type="text" name="name" required>
			<input type="file" name="uploadfile" style="display:none" accept="image/jpeg, image/png" id="file" require> 
			<label style="width:430px; margin-top: 25px; margin-left: 0; justify-content:center; display:flex;" class="labelForFile" for="file">Выберите файл</label>
			
			</div>
			<button style="margin-top: 30px; width: 430px;" class="mybtn2" type="submit">Зарегистрироваться</button>
			</form>
			<p style="margin: 0; width: auto; margin-top: 30px; margin-bottom: 30px;">У вас уже есть аккаунт? <a href="login.php" style="color: #B593FE;"> Войти</a>. </p>
			</div>
		</section>
	</div>
	<script src="js/passwordReg.js"></script>
</body>
</html>