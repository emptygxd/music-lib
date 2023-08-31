<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$text3= 'favoriteId';
$userId=$_COOKIE['id'];
$songId = $_GET['track'];
$isExistQuery =  $mysql -> query ("SELECT `favoriteId` FROM favorite WHERE `userId` = '$userId' AND `songId` = '$songId';");
$isExist =  $isExistQuery -> fetch_assoc();
if($isExist[$text3] !=null){
	$mysql-> query("DELETE FROM `favorite` WHERE `favorite`.`favoriteId` = '$isExist[$text3]'");
	$mysql -> close();
}
else{
	$mysql -> query("INSERT INTO `favorite` (`userId`,`songId`) VALUES ('$userId','$songId')");
	$mysql -> close();
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
