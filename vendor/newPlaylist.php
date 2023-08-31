<?php 
header("Content-Type: text/html; charset=UTF-8");

if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$dir = '../images/userpics/';
$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile);
$zapros="INSERT INTO PLName (name, userId, description, ava) VALUES ('$_POST[albName]','$_POST[user]','$_POST[descrip]','$namefile')";
mysqli_query($con, $zapros);
$zapros2="INSERT INTO favoritePL (nameFavPl, userId) VALUES ('$_POST[albName]','$_POST[user]')";
mysqli_query($con, $zapros2);
	header('Location: ../playlistCreation.php?playlist_accept=1'); 
}

?>