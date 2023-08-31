<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$userId=$_COOKIE['id'];
$songId = $_GET['pl'];
$text = 'nameFavPl';
$isExistQuery =  $mysql -> query ("SELECT `nameFavPl` FROM favoritePL WHERE `userId` = '$userId' AND `nameFavPl` = '$songId';");
$isExist =  $isExistQuery -> fetch_assoc();
if($isExist[$text] !=null){
	$mysql -> query("DELETE FROM `favoritePL` WHERE `favoritePL`.`nameFavPl` = '$isExist[$text]'");
	$mysql -> close();

}
else{
	$mysql -> query("INSERT INTO favoritePL (nameFavPl,userId) VALUES ('$songId','$_COOKIE[id]')");
	$mysql -> close();
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>