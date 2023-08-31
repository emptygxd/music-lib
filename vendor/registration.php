<?php 
header("Content-Type: text/html; charset=UTF-8");
if ($_COOKIE['user'] != '') {
	exit("<a style='position: absolute; top: 43%; left:43%; font-size: 25px; '>Вы уже авторизованны</a>");
}


if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$p1 = $_POST['password1'];
$p2 = $_POST['password2'];
if($p1==$p2){
	$dir = '../images/userpics/';
$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
$zapros="INSERT INTO users (login,password,nickname,userPic) VALUES ('$_POST[login]','$_POST[password2]','$_POST[name]', '$namefile')";
$query=mysqli_query($con, $zapros);
if ($query)
	 header('Location: ../login.php?reg_accept=1');
}
else
	header('Location: ../reg.php?reg_error=1');
}
}
?>

