<?php 
header("Content-Type: text/html; charset=UTF-8");

if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');

$p1 = $_POST['password1'];
$p2 = $_POST['password2'];
if($p1==$p2){
$dir = '../images/userpics/';
if($_FILES['uploadfile']['name']!=null){

$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile);
	
$zapros="UPDATE `users` SET `login` = '$_POST[login]', `password` = '$_POST[password2]', `nickname` = '$_POST[nick]', `userPic` = '$namefile' WHERE `ID` = '$_COOKIE[id]'";
$query=mysqli_query($con, $zapros);
}else{
	$zapros="UPDATE `users` SET `login` = '$_POST[login]', `password` = '$_POST[password2]', `nickname` = '$_POST[nick]' WHERE `ID` = '$_COOKIE[id]'";
	$query=mysqli_query($con, $zapros);
}

if ($query){
	setcookie('login',$_POST[login], time()+3600,"/");
	setcookie('pass',$_POST[password2], time()+3600,"/");
	setcookie('user',$_POST[nick], time()+3600,"/");
	 header('Location: ../index.php?upd_accept=1');
}
else
	header('Location: ../settings.php?upd_error=1');
}
}


?>