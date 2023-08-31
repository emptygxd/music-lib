<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
// $text3= 'favoriteId';
// $userId=$_COOKIE['id'];
$songName = $_GET['track'];
$pl = $_GET['pl'];
$plQuery =  $mysql -> query ("SELECT `nameId` FROM PLName WHERE `name` = '$pl' ;");
$songQuery =  $mysql -> query ("SELECT `songId` FROM songs WHERE `songName` = '$songName';");
$plInfo =  $plQuery -> fetch_assoc();
$songInfo =  $songQuery -> fetch_assoc();
$plId = $plInfo['nameId'];
$songId = $songInfo['songId'];
echo $plId;
echo '<pre>';
echo $songId;
$isExistQuery =  $mysql -> query ("SELECT * FROM PLGenre WHERE `songId` = '$songId' and `nameId` = '$plId';");
$isExist =  $isExistQuery -> fetch_assoc();

if($isExist !=null){
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
else{
	$mysql -> query("INSERT INTO `PLGenre` (`songId`,`nameId`) VALUES ('$songId','$plId')");
	$mysql -> close();
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
?>
