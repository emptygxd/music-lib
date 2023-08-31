<?php 
header("Content-Type: text/html; charset=UTF-8");
if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');

$zapros="delete from songs where `songId` = '$_POST[songId]'";

$zapros2="delete from favorite where `songId` = '$_POST[songId]'";

$zapros3="delete from PLGenre where `songId` = '$_POST[songId]'";

$query=mysqli_query($con, $zapros);
$query2=mysqli_query($con, $zapros2);
$query3=mysqli_query($con, $zapros3);
if ($query and $query2 and $query3)
	 header('Location: ../index.php?delete_accept=1');
else
	header('Location: ../index.php?delete_error=1');
}
?>