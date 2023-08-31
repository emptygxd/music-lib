<?php
if ($_GET["upd_accept"]==1)
	echo '<script> alert( "Данные сохранены!"); </script>';

if ($_GET["upd_error"]==1)
	echo '<script> alert( "Ошибка! Данные не сохранены. Проверьте правильность введенных данных."); </script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="images/settingsPurp.png">
	<title>Настройки</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/settings.css">
</head>
<body class="bodySet">
	<div class="wrapper">
		<header class="headerLog">
			<li><img src="images/logo.webp" width="50px" height="50px"></li>
			<li style="margin-left: 20px;">AKUETTO</li>
		</header>
		<section class="main-contentLog">
	<div class="reg">
			<form style=" display: flex; flex-direction: column;" action="vendor/update.php" method="post" enctype="multipart/form-data">
			<p >Ваша электронная почта</p>
			<input class="myauth2" placeholder="Эл. почта" type="text" name="login" value="<?=$_COOKIE['login'] ?>" required >
			<p>Придумайте пароль</p>
			<label class="pass__label">
				<input class="myauth2 pass__input1" placeholder="Пароль" type="password" name="password1" value="<?=$_COOKIE['pass'] ?>" required >
				<div class="pass__btn1"><img src="images/eye.png" style="width: 35px;height: 35px;"></div>
			</label>
			<p>Подтвердите пароль</p>
			<label class="pass__label">
				<input class="myauth2 pass__input2" placeholder="Пароль" type="password" name="password2" value="<?=$_COOKIE['pass'] ?>" required>
				<div class="pass__btn2"><img src="images/eye.png" style="width: 35px;height: 35px;"></div>
			</label>
			<p>Ваше имя (никнейм)</p>
			<input class="myauth2" placeholder="Имя" type="text" name="nick" value="<?=$_COOKIE['user'] ?>" required>
			 <input type="file" name="uploadfile" style="display:none" accept="image/jpeg, image/png" id="file" > 
			<label style="width:430px; margin-top: 25px; margin-left: 0; justify-content:center; display:flex;" class="labelForFile" for="file">Выберите файл</label>
			
			<button style="margin-top: 30px; width: 430px;" class="mybtn2" type="submit">Сохранить</button>
			</form>
			<a onclick="history.back();" class="cursor" style="margin-top: 25px; color: #B593FE; display: flex; justify-content: center;">Назад</a>
			</div>
		</section>
	</div>
	<script src="js/passwordSet.js"></script>
</body>
</html>