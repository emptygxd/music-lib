<?php 
header("Content-Type: text/html; charset=UTF-8");

if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$dir = '../images/userpics/';
$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
$zapros="INSERT INTO artist (artistName,bio,ava) VALUES ('$_POST[artName]','$_POST[bio]','$namefile')";
$query=mysqli_query($con, $zapros); 
if ($query)
	 header('Location: ../artistCreation.php?artist_accept=1');
else
	header('Location: ../artistCreation.php?artist_error=1');
}
}
?>