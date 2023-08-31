<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
$result = $mysql -> query ("SELECT * FROM `users` WHERE `login`='$login' and `password` = '$password'");
$user = $result -> fetch_assoc();
if(count($user) == 0)
{
	header('Location: ../login.php?error=1');
	exit();
}
setcookie('id',$user['ID'], time()+3600*24,"/");
setcookie('login',$user['login'], time()+3600*24,"/");
setcookie('pass',$user['password'], time()+3600*24,"/");
setcookie('user',$user['nickname'], time()+3600*24,"/");
setcookie('admin',$user['admin'], time()+3600*24,"/");
$mysql->close();
header('Location: ../index.php');
exit();
?>


