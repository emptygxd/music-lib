<?php

$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$favNamesPl = $mysql -> query ("SELECT * FROM `favoritePL` WHERE `userId` = '$id' ORDER BY `dateAdded` DESC;");

$resultSongs = $mysql -> query ("SELECT * FROM `favorite` WHERE `userId`='$id' ORDER BY `dateAdded` DESC");
$resultSongsForCount = $mysql -> query ("SELECT * FROM `favorite` WHERE `userId`='$id' ORDER BY `dateAdded` DESC");


while($count = $resultSongsForCount -> fetch_assoc()){
    $amount++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Главная</title>
	
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
				<div class="selections">					
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
					$favSongDivNumber = $songsInfo[$text1];
				?>
				<div class="block" data-attr="<?=$amount;?>" data-attr-name="<?php echo "$songsInfo[songName]"; ?>" data-attr-artist="<?php echo "$artInfo[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
	 			<?php $i++; }	?>
				<div class="selections">
					<div class="podborki"> 
						
						<p style="margin-left: 20px; margin-top: 20px">Список избранных альбомов:</p>

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
</section>
</div>
</div>
		<footer class="footer">
		<div class="trackBar">
		<div class="trackLogo">
			<img class="cover" src="images/userpics/<?php echo "$songsInfo[ava]"; ?>" alt="settingsArrow" width="60px" height="60px">
		</div>

		<div class="nameSliderButtons">
			<div class="trackName">
				<a href="song.php?songName=<?php echo $songsInfo["songName"];?>" class="nameOfSong hrefFooter"><?php echo "$songsInfo[songName]";?></a>
				<div class="forNameArt">
				<a class="nameOfArt hrefFooter" ><?php echo "$artInfo[artistName]";?></a>
				</div>
			</div>	
		<?php require_once 'parts/footer.php' ?>
		
	</footer>
	<?php endif;?>	


<script src="js/hover.js"></script>
<script src = "js/songs.js"></script>

</body>
</html>