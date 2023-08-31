<?php

$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$namesPl = $mysql -> query ("SELECT * FROM `PLName` WHERE `artistId` IS NULL AND `userId` IS NULL ORDER BY `nameId` DESC LIMIT 5;");
$namesAlb = $mysql -> query ("SELECT * FROM `PLName` WHERE `artistId` IS NOT NULL ORDER BY `nameId` DESC LIMIT 5;");



$resultSongs = $mysql -> query ('SELECT songs.songName, GROUP_CONCAT(artist.artistName SEPARATOR ", ") AS artistName, songs.dateAdded
 FROM songs INNER JOIN artist on songs.artistId = artist.artistId GROUP BY songs.songName,songs.dateAdded ORDER BY songs.dateAdded DESC;');
$resultSongsForCount = $mysql -> query ('SELECT songs.songName,GROUP_CONCAT(artist.artistName SEPARATOR ", ") FROM songs INNER JOIN artist on songs.artistId = artist.artistId GROUP BY songs.songName;');


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

<body style="Padding-bottom:131px;">
	<?php
if ($_COOKIE['user']==''):
	header('Location: login.php?zareg=1');
else:
?>
 <div class="wrapper" style="background: #0E0E0E;">
<div class="menuMain">
	<?php require_once 'parts/sideMenu.php' ?>
	<section class="main-content" >
				<div class="head">
				<script>
							var h=(new Date()).getHours();
							if (h >= 24 || h <6) document.write('Доброй ночи.') ;
							else if (h >= 6 || h < 12) document.write('Доброе утро.'); 
							else if (h >= 12 || h < 19) document.write('Добрый день.'); 
							else if (h >= 19 || h < 24) document.write('Добрый вечер.'); 
						</script>
					<div class="profileLine">
						<?php require_once 'parts/head.php' ?>
					
					</div>
				</div>
				<div class="selections">
					<div class="podborki"> 
						<p style="margin-left: 20px; margin-top: 40px">Подборки по жанрам</p>

						<?php if ($_COOKIE['admin']=='1'): ?>
						<a href="compilationCreation.php">
							<img title="Добавить плейлист" class="cursor" src="images/plusWhite.png" style="width: 25px; height: 25px; margin-right: 20px">
						</a>
						<?php endif; ?>
					</div>
					<div class="items">
						<?php  			
						while ($namesInfo=$namesPl-> fetch_assoc() ) {?>
						<a href="playlist.php?plId=<?php echo $plId=$namesInfo['name'];?>">
							<div class="item"> <img src="images/userpics/<?php echo "$namesInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
							<p title="<?php echo "$namesInfo[name]";?>" class="songName"><?php echo "$namesInfo[name]";?></p>
						</div>
						</a>
						<?php } ?>
					</div>
				</div>
				<div>
				<?php
					 	while ($songArtName = $resultSongs -> fetch_assoc()) {
							$songName = $songArtName["songName"];
							$songs = $mysql -> query ("SELECT * FROM `songs` WHERE `songName`='$songName'");
							$songsInfo = $songs -> fetch_assoc()?>
				           	<div class="block" data-attr="<?=$amount;?>"  data-attr-name="<?php echo "$songArtName[songName]"; ?>" data-attr-artist="<?php echo "$songArtName[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				<?php }	?>
				</div>
				<?php  	

					$counter=0;
					
					$recArtistsQueryFc = $mysql -> query ("SELECT * FROM `favArtists` WHERE `userId`='$id'");
					while ($recArtistsFc = $recArtistsQueryFc-> fetch_assoc()) {
						$counter++;
					}

					if ($counter != 0){ 
				?>
				
				<div class="selections">
					<div class="podborki"> 
						
						<p style="margin-left: 20px; margin-top: 40px">Новые песни для вас</p>

					</div>
					<div class="items">
						<?php  		
						$string = "SELECT songs.songId, songs.songName, songs.dateAdded, songs.ava, artist.artistName
						FROM `songs` inner join `artist` on `songs`.`artistId`= `artist`.`artistId` 
						WHERE `songs`.`artistId`='0' ";
						$recArtistsQuery = $mysql -> query ("SELECT * FROM `favArtists` WHERE `userId`='$id'");
						
						for ($i=0; $i < $counter; $i++) { 
							$recArtistsInfo = $recArtistsQuery-> fetch_assoc();
							$string .= " or `songs`.`artistId`= '$recArtistsInfo[artistId]'";
						}
						$string .="ORDER BY dateAdded desc limit 5";

						$recSongsQuery = $mysql -> query ($string);
						while ($recSongsInfo = $recSongsQuery-> fetch_assoc()) {
							?>
						<a href="song.php?songName=<?php echo $songName=$recSongsInfo['songName'];?>">
							<div class="item">
								<img src="images/userpics/<?php echo "$recSongsInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
								<p title="<?php echo "$recSongsInfo[songName]";?>" class="songName"><?php echo "$recSongsInfo[songName]";?></p>
								<p title="<?php echo "$recSongsInfo[artistName]";?>" class="artName"><?php echo "$recSongsInfo[artistName]";?></p>
							</div>
						</a>
						<?php } ?>
						</div>
					</div>
					
					<div class="selections">
					<div class="podborki"> 
						
						<p style="margin-left: 20px; margin-top: 40px">Новые альбомы для вас</p>

					</div>
					<div class="items">
						<?php  
						
						$string = "SELECT PLName.name, PLName.ava, PLName.nameId, artist.artistName
                         FROM `PLName` inner join `artist` on `PLName`.`artistId`= `artist`.`artistId` 
						 WHERE `PLName`.`artistId`='0' ";
						$recArtistsQuery = $mysql -> query ("SELECT * FROM `favArtists` WHERE `userId`='$id'");
						
						for ($i=0; $i < $counter; $i++) { 
							$recArtistsInfo = $recArtistsQuery-> fetch_assoc();
							$string .= " or `PLName`.`artistId`= '$recArtistsInfo[artistId]'";
						}
						$string .=" ORDER BY nameId desc limit 5";

						$recSongsQuery = $mysql -> query ($string);
						while ($recSongsInfo = $recSongsQuery-> fetch_assoc()) {
							?>
						<a href="playlist.php?plId=<?php echo $plId=$recSongsInfo['name'];?>">
							<div class="item">
								<img src="images/userpics/<?php echo "$recSongsInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
								<p title="<?php echo "$recSongsInfo[name]";?>" class="songName"><?php echo "$recSongsInfo[name]";?></p>
								<p title="<?php echo "$recSongsInfo[artistName]";?>" class="artName"><?php echo "$recSongsInfo[artistName]";?></p>
								
							</div>
						</a>
						<?php } ?>
						</div>
					</div>

					<?php } ?>

					<div class="selections">
					<div class="podborki"> 
						
						<p style="margin-left: 20px; margin-top: 40px">Подборка альбомов</p>

						<?php if ($_COOKIE['admin']=='1'): ?>
						<a href="albumCreation.php">
							<img title="Добавить альбом" class="cursor" src="images/plusWhite.png" style="width: 25px; height: 25px; margin-right: 20px">
						</a>
						<?php endif; ?> 

					</div>
					<div class="items">
						<?php  			
						while ($namesInfo=$namesAlb-> fetch_assoc()) {
							$text2 = "artistId";
							$artId = $namesInfo[$text2];
							$authorsRes = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId`='$artId'");
							$authors=$authorsRes-> fetch_assoc();
							?>
						<a href="playlist.php?plId=<?php echo $plId=$namesInfo['name'];?>">
							<div class="item">
								<img src="images/userpics/<?php echo "$namesInfo[ava]"; ?>" width="93px" height="110px" style="border-radius: 10px;">
								<p title="<?php echo "$namesInfo[name]";?>" class="songName"><?php echo "$namesInfo[name]";?></p>
								<p title="<?php echo "$authors[artistName]";?>" class="artName"><?php echo "$authors[artistName]";?></p>
							</div>
						</a>
						<?php } ?>
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