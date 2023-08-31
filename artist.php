<?php 
$artName = $_GET['artName'];
$mysql = new mysqli('localhost','root','','akuetto');
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$artist = $mysql -> query ("SELECT * FROM `artist` WHERE `artistName`='$artName'");
$artInfo = $artist -> fetch_assoc();
$text1 = 'artistId';
$id = $artInfo[$text1];
$resultSongs = $mysql -> query ("SELECT * FROM `songs` WHERE `artistId`='$id' ORDER BY `dateAdded` DESC");
$SongsForCount = $mysql -> query ("SELECT * FROM `songs` WHERE `artistId`='$id' ORDER BY `dateAdded` DESC");
$counter=0;
while($da = $SongsForCount -> fetch_assoc()){
    $counter++;
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $artName?></title>
	<link rel="icon" href="images/playlistPurp.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/favorite.css">
	<link rel="stylesheet" type="text/css" href="css/artists.css">
</head>
<body style="Padding-bottom:131px">
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
						<img src="images/userpics/<?php echo $artInfo['ava']?>" class="artPic">
						<div class="favHeadText">
							<h2 ><?php echo $artInfo['artistName']?> </h2>








							<?php
						$uId=$_COOKIE['id'];
						$isExistQuery = $mysql -> query ("SELECT favArtists.id FROM `favArtists` WHERE `artistId`='$id' and `userId`='$uId';");
						$isExist = $isExistQuery -> fetch_assoc();
						$textForHeart= 'id';
						if($isExist[$textForHeart] !=null){	?>
						<form style="width: 80px;" action="vendor/addToFavArt.php?aId=<?php echo $id?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img title = "Добавить/удалить из избранного" id="heartW" src="images/heartPurp.png" class="pics2" onclick="del()">
				</button></form>
				<?php } else{
					?>
					<form style="width: 80px;" action="vendor/addToFavArt.php?aId=<?php echo $id?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartWhite.png" class="pics2" onclick="ad()">
				</button></form>
				<?php }  ?>









							<p class="bio"><?php echo $artInfo['bio'] ?></p>

						</div>
					</div>
					<hr class="favHr">
					</div>

				<div class="favMainCont">
				<div class="song">
						<label class="songNumber" style="color: #a5a5a5;">№</label>
						<label class="songTextOther" style="width: 350px; color: #a5a5a5;">Наименование</label>
						<label class="songTextOther" style="width: 220px; color: #a5a5a5;">Дата выхода</label>
						<label class="songTextOther" style="width: 210px; color: #a5a5a5;">В избранное</label>
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

						<div style="width: 315px;" class="songArtist">
							<p class="songTextArtist"><?php echo "$songsInfo[songName]";?></p>
							<p class="songTextOther"><?php echo "$artInfo[artistName]";?></p>
				            <div class="block" data-attr="<?=$counter;?>" data-attr-name="<?php echo "$songsInfo[songName]"; ?>" data-attr-artist="<?php echo "$artInfo[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				            
						</div>

						<p style="width: 230px;" class="songTextOther"><?php $data = $songNumber['dateAdded'];
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
						<form style="width: 145px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartPurp.png" class="pics2" onclick="del()">
				</button></form>
				<?php } else{
					?>
					<form style="width: 145px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartWhite.png" class="pics2" onclick="ad()">
				</button></form>
				<?php }  ?>


						<p style="margin-left: 50px;" class="songTextOther"><?php echo "$songsInfo[duration]";?></p>
					</div>
					<hr class="songHr">
					<?php $i++; }?>
				</div>
			</section>
		</div>
		<footer class="footer">
				<div class="trackLogo">
					<img class="cover" src="images/userpics/<?php echo "$songsInfo[songName]"; ?>.jpg" alt="settingsArrow" width="60px" height="60px">
				</div>

				<div class="nameSliderButtons">

					<div class="trackName">
						<a class="nameOfSong hrefFooter"><?php echo "$songsInfo[songName]";?></a>
						<a class="nameOfArt hrefFooter" style="margin-top: 8px;"><?php echo "$artInfo[artistName]";?></a>

					</div>	<?php require_once 'parts/footer.php' ?>
			</div>
		</footer>
		<script src="js/songs.js"></script>
		<script src="js/hover.js"></script>
	</div>
</body>
</html>										