<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$userId=$_COOKIE['id'];
$artistId = $_GET['aId'];
$text = 'nameFavPl';
$isExistQuery = $mysql -> query ("SELECT favArtists.id FROM `favArtists` WHERE `artistId`='$artistId' and `userId`='$userId';");
$isExist = $isExistQuery -> fetch_assoc();
$textForHeart= 'id';
echo $isExist[$textForHeart];
if($isExist[$textForHeart] !=null){
   
    $mysql -> query("DELETE FROM `favArtists` WHERE `favArtists`.`artistId`='$artistId' and `userId`='$userId'");
	$mysql -> close();
}else{
    
    	$mysql -> query("INSERT INTO favArtists (userId,artistId) VALUES ('$userId','$artistId')");
    	$mysql -> close();
    }
header("Location: ".$_SERVER['HTTP_REFERER']);
?>