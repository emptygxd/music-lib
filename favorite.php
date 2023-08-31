<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$userId=$_COOKIE['id'];
$resultSongs = $mysql -> query ("SELECT * FROM `favorite` WHERE `userId`='$userId' ORDER BY `dateAdded` DESC");
$resultSongsPustota = $mysql -> query ('SELECT songs.songName, GROUP_CONCAT(artist.artistName SEPARATOR ", ") AS artistName, songs.dateAdded
 FROM songs INNER JOIN artist on songs.artistId = artist.artistId GROUP BY songs.songName,songs.dateAdded ORDER BY songs.dateAdded DESC;');
$resultSongsForCountPustota = $mysql -> query ('SELECT songs.songName,GROUP_CONCAT(artist.artistName SEPARATOR ", ") FROM songs INNER JOIN artist on songs.artistId = artist.artistId GROUP BY songs.songName;');


while($count = $resultSongsForCountPustota -> fetch_assoc()){
    $amountPustota++;
}


$favNamesPl = $mysql -> query ("SELECT * FROM `favoritePL` WHERE `userId` = '$userId' ORDER BY `dateAdded` DESC LIMIT 5;");
$resultSongsWOFav = $mysql -> query ("SELECT * FROM `songs`");
$songWOFavInfo = $resultSongsWOFav -> fetch_assoc();
$tex1='artistId';
$artiId= $songWOFavInfo[$tex1];

$resultArtWOFav = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId` = '$artiId'");
$artWOFavInfo = $resultArtWOFav -> fetch_assoc();

$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$userId';");
$user = $userQuery -> fetch_assoc();

$resultSongsForCount = $mysql -> query ("SELECT * FROM `favorite` WHERE `userId`='$userId' ORDER BY `dateAdded` DESC");
$resultSongsForCount2 = $mysql -> query ("SELECT * FROM `favorite` WHERE `userId`='$userId' ORDER BY `dateAdded` DESC");

while($count = $resultSongsForCount2 -> fetch_assoc()){
    $amount++;
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Избранное</title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="icon" href="images/homePurp.png">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/favorite.css">
	<link rel="stylesheet" type="text/css" href="css/search.css">
</head>

<body style="Padding-bottom:131px">
	<?php
if ($_COOKIE['user']==''):
	header('Location: login.php?zareg=1');
else:
?>
 <div class="wrapper" style="background: #0E0E0E;">
<div class="menuMain">
	<?php require_once 'parts/sideMenu.php' ?>
			<section class="main-content" >
				<div class="headFav">
					<div class="profileLineFav">
					<?php require_once 'parts/head.php' ?>
					</div>
				</div>
				<hr class="favHr">

				<div class="favPL">
					<div class="PLHead">
						<img src="images/favorite.png" class="favPic">
						<div class="favHeadText">
							<h2 >Избранное</h2>

							<p style="margin-top: 10px; font-size:24px"><?php echo($_COOKIE['user'])?></p>
						</div>
					</div>
					<hr class="favHr">
					
				</div>
				<div class="favMainCont">
				
					<?php
					$forCounter = $resultSongsForCount -> fetch_assoc();
					$counter =$forCounter;
					if ($counter==0){
						while ($songArtName = $resultSongsPustota -> fetch_assoc()) {
							$songName = $songArtName["songName"];
							$songs = $mysql -> query ("SELECT * FROM `songs` WHERE `songName`='$songName'");
							$songsInfo = $songs -> fetch_assoc()?>
						   <div class="block" data-attr="<?=$amountPustota;?>"  data-attr-name="<?php echo "$songArtName[songName]"; ?>" data-attr-artist="<?php echo "$songArtName[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				<?php }	?>	


						<p class="pustota">Тут пока пусто...<a style="color:#B593FE" href="index.php">Исправим?</a></p>
					</div>
				

					<?php	} else{	?>
						<div class="selections">
					<div style="height: 35px;" class="podborki"> 
						<p style="margin-left: 20px; margin-top: 40px">Избранные плейлисты</p>

						<a href="playlistsFav.php">
							<p class="showAll cursor">Показать всё</p> 
						</a>
					</div>
					<div class="items">
						<?php  			
						while ($favNamesInfo=$favNamesPl-> fetch_assoc() ) {
							$nameFavPl = $favNamesInfo['nameFavPl'];
							$namesPl = $mysql -> query ("SELECT * FROM `PLName` WHERE `name` = '$nameFavPl'");
							$nameInfo = $namesPl -> fetch_assoc();
							if ($nameInfo['userId'] != NULL){
								$user_id = $nameInfo['userId'];
							$nameUs = $mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$user_id'");
							$nameOfUser = $nameUs -> fetch_assoc();
							?>
						<a href="playlist.php?plId=<?php echo $plId=$favNamesInfo['nameFavPl'];?>">
							<div class="item">
								<img src="images/userpics/<?php echo "$nameInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
								<p title="<?php echo "$favNamesInfo[nameFavPl]";?>" class="songName"><?php echo "$favNamesInfo[nameFavPl]";?></p>
								<p title="<?php echo "$nameOfUser[nickname]";?>" class="artName"><?php echo "$nameOfUser[nickname]";?></p>
							</div>
						</a>
						<?php } elseif ($nameInfo['artistId'] != NULL) { 
							$art_id = $nameInfo['artistId'];
							$nameAr = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId` = '$art_id'");
							$nameOfArt = $nameAr -> fetch_assoc();
							?>
							<a href="playlist.php?plId=<?php echo $plId=$favNamesInfo['nameFavPl'];?>">
							<div class="item">
								<img src="images/userpics/<?php echo "$nameInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
								<p title="<?php echo "$favNamesInfo[nameFavPl]";?>" class="songName"><?php echo "$favNamesInfo[nameFavPl]";?></p>
								<p title="<?php echo "$nameOfArt[artistName]";?>" class="artName"><?php echo "$nameOfArt[artistName]";?></p>
							</div>
						</a>
						<?php  } else{ ?>
							<a href="playlist.php?plId=<?php echo $plId=$favNamesInfo['nameFavPl'];?>">
							<div class="item">
								<img src="images/userpics/<?php echo "$nameInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
								<p title="<?php echo "$favNamesInfo[nameFavPl]";?>" class="songName"><?php echo "$favNamesInfo[nameFavPl]";?></p>
							</div>
						</a>
						<?php  } } ?>
					</div>
				</div>
				<hr class="favHr">
						<div class="song">
						<label class="songNumber" style="width: 30px; color: #a5a5a5;">№</label>
						<label class="songTextOther" style="width: 280px; color: #a5a5a5;">Наименование</label><!-- 380 -->
						<label class="songTextOther" style="width: 130px; color: #a5a5a5;">Дата добавления</label><!-- 235px -->
						<label class="songTextOther" style="width: 90px; color: #a5a5a5;">В избранное</label>
						<label class="songTextOther" style="width: 60px; color: #a5a5a5;">Длительность</label>
					</div>
					<?php
					$i=1; while ($songNumber = $resultSongs -> fetch_assoc()) {		
					$text1 = "songId";
					$songId = $songNumber[$text1];
					$songs = $mysql -> query ("SELECT * FROM `songs` WHERE `songId`='$songId'");
					$songsInfo = $songs -> fetch_assoc(); 
					$text2 = "artistId";
					$artId = $songsInfo[$text2];
					$artist = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId`='$artId'");
					$artInfo = $artist -> fetch_assoc();
					$favSongDivNumber = $songsInfo[$text1];?>

					<div class="song divN<?=$i;?>" onmouseover="hoverFun(<?=$i;?>)" onmouseout="unhoverFun(<?=$i;?>)"onclick = "hoveredClick(<?=$i;?>)">

						<p class="songNumber"><?php echo "$i" ?></p>

						<div class="songArtist">
							<p class="songTextArtist"><?php echo "$songsInfo[songName]";?></p>
							<p class="songTextOther"><?php echo "$artInfo[artistName]";?></p>
				            <div class="block" data-attr="<?=$amount;?>" data-attr-name="<?php echo "$songsInfo[songName]"; ?>" data-attr-artist="<?php echo "$artInfo[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				          </div>

						<p style="width: 150px;" class="songTextOther"><?php $data = $songNumber['dateAdded'];
							$cuttedDate = mb_strcut($data,0,10);
							echo "$cuttedDate";?></p>
							<?php
						$textForHeart= 'favoriteId';
						$userIdForHeart=$_COOKIE['id'];
						$songIdForHeart = $songsInfo[$text1];
							$isExistQuery =  $mysql -> query ("SELECT `favoriteId` FROM favorite WHERE `userId` = '$userIdForHeart' AND `songId` = '$songIdForHeart';");
						$isExist =  $isExistQuery -> fetch_assoc();

						if($isExist[$textForHeart] !=null){
												?>
						<form style="width: 100px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartPurp.png" class="pics2" onclick="del()">
				</button></form>
				<?php } else{
					?>
					<form style="width: 100px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartWhite.png" class="pics2" onclick="ad()">
				</button></form>
				<?php }  ?>
						<p class="songTextOther"><?php echo "$songsInfo[duration]";?></p>
					</div>
					<hr class="songHr">
					<?php $i++; }?>
				</div>
<?php
}?>
</section>
</div>
</div>
		<footer class="footer">
		<div class="trackBar">
		<div class="trackLogo">
			<img class="cover" src="images/userpics/<?php echo "$songsInfo[songId]"; ?>.jpg" alt="settingsArrow" width="60px" height="60px">
		</div>
		<div class="nameSliderButtons">
			<div class="trackName">
				<?php $text3 = 'songId';
				$songId=$songsInfo[$text3];
				$txt = $_POST['txt'];
				echo $txt;?>
				<a class="nameOfSong hrefFooter"><?php echo "$songsInfo[songName]";?></a>
				<a class="nameOfArt hrefFooter" style="margin-top: 8px;"><?php echo "$artInfo[artistName]";?></a>
			</div>	
		<?php require_once 'parts/footer.php' ?>
	</footer>
	<?php endif;?>	
	<script src = "js/songs.js"></script>
	<script src="js/hover.js"></script>
</body>
</html>