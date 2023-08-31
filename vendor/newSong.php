<?php 
header("Content-Type: text/html; charset=UTF-8");

if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$dir = '../images/userpics/';
$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile)) {

	$dirMP = '../audio/';
	$uploadfileMP = $dirMP.basename($_FILES['uploadmp']['name']);
	$namefileMP = basename($_FILES['uploadmp']['name']);
	if (move_uploaded_file($_FILES['uploadmp']['tmp_name'], $uploadfileMP)) {

	$zapros="INSERT INTO songs (songName,artistId,duration,ava, mpfile) VALUES ('$_POST[songName]','$_POST[artist]','$_POST[duration]','$namefile','$namefileMP')";
	$query=mysqli_query($con, $zapros);
if ($query)
	 header('Location: ../songCreation.php?song_accept=1');
else
	header('Location: ../songCreation.php?song_error=1');
}
}
}
?> 