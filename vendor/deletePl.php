<?php 
header("Content-Type: text/html; charset=UTF-8");
echo '<pre>';
print_r($_POST) ;
echo '<pre>';
if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$zapros="delete from PLName where `name` = '$_POST[plName]'";
$zapros1="delete from PLGenre where `nameId` = '$_POST[plId]'";
$zapros2="delete from favoritePL where `nameFavPl` = '$_POST[plName]'";
$query=mysqli_query($con, $zapros);
$query1=mysqli_query($con, $zapros1);
$query2=mysqli_query($con, $zapros2);
if ($query and $query2 and $query1)
	 header('Location: ../index.php?delete_accept=1');
else
	header('Location: ../index.php?artist_error=1');
}
?>