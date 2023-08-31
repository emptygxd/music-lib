<?php 
$songName = $_GET['songName'];
$mysql = new mysqli('localhost','root','','akuetto');
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$songQuery = $mysql -> query ("SELECT songs.songId, songs.songName, GROUP_CONCAT(artist.artistName SEPARATOR ', ') AS artistName, 
songs.dateAdded, songs.ava, songs.mpfile, songs.duration FROM songs INNER JOIN artist on songs.artistId = artist.artistId 
WHERE `songName`='$songName' GROUP BY songs.songId, songs.songName,songs.dateAdded, songs.ava, songs.mpfile, songs.duration ORDER BY songs.dateAdded DESC;");

$songInfo = $songQuery -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $songName?></title>
	<link rel="icon" href="images/note.jpg">
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
						<img src="images/userpics/<?php echo "$songInfo[ava]"?>" class="sngPic">
						<div class="favHeadText">
						<div class="nameTrash">
						<h2  id="nameOfPl"><?php echo $songInfo['songName']?></h2>  
							<?php if ($_COOKIE['admin']==1): ?>
								<form method="post" enctype="multipart/form-data" id="delsong" action="vendor/deleteSong.php">
									<input style="display: none" value = "<?php echo $songInfo['songId']?>" name="songId">
									<img class = "trash cursor" src="images/closedTrash.jpg" alt="">
							</form>
							<?php endif; ?>
							</div>
							
							<p style="margin-top: 10px; font-size:24px"><?php echo $songInfo['artistName'] ?></p>
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
					<?php $i=1; ?>

					<div class="song divN<?=$i;?>" onmouseover="hoverFun(<?=$i;?>)" onmouseout="unhoverFun(<?=$i;?>)"onclick = "hoveredClick(<?=$i;?>)">

						<p class="songNumber"><?php echo "$i" ?></p>

						<div style="width: 315px;" class="songArtist">
							<p class="songTextArtist"><?php echo "$songInfo[songName]";?></p>
							<p class="songTextOther"><?php echo "$songInfo[artistName]";?></p>
				            <div class="block" data-attr="<?=$i;?>" data-attr-name="<?php echo "$songInfo[songName]"; ?>" data-attr-artist="<?php echo "$songInfo[artistName]"; ?>" data-attr-music="<?php echo "$songInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songInfo[ava]"; ?>"></div>
						</div>

						<p style="width: 230px;" class="songTextOther"><?php $data = $songInfo['dateAdded'];
							$cuttedDate = mb_strcut($data,0,10);
							echo "$cuttedDate";?></p>
							<?php
						$textForHeart= 'favoriteId';
						$userIdForHeart=$_COOKIE['id'];
						$songIdForHeart = $songInfo['songId'];
						$isExistQuery =  $mysql -> query ("SELECT `favoriteId` FROM favorite WHERE `userId` = '$userIdForHeart' AND `songId` = '$songIdForHeart';");
						$isExist =  $isExistQuery -> fetch_assoc();

						if($isExist[$textForHeart] !=null){
												?>
						<form style="width: 190px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart;?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartPurp.png" class="pics2" onclick="del()">
				</button></form>
				<?php } else{
					?>
					<form style="width: 190px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart;?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartWhite.png" class="pics2" onclick="ad()">
				</button></form>
				<?php }  ?>
						<p style="margin-left: 10px;" class="songTextOther"><?php echo "$songInfo[duration]";?></p>
					</div>
					<hr class="songHr">
                </div>
			</section>
		</div>
		<footer class="footer">
				<div class="trackLogo">
					<img class="cover" src="images/userpics/<?php echo "$songInfo[ava]"; ?>.jpg" alt="settingsArrow" width="60px" height="60px">
				
				</div>

				<div class="nameSliderButtons">

					<div class="trackName">
						<a class="nameOfSong hrefFooter"><?php echo "$songInfo[songName]";?></a>
						<a class="nameOfArt hrefFooter" style="margin-top: 8px;"><?php echo "$songInfo[artistName]";?></a>

					</div>	<?php require_once 'parts/footer.php' ?>
			</div>
		</footer>
		<script src="js/songs.js"></script>
		<script src="js/hover.js"></script>
		<script src="js/trashsong.js"></script>
	</div>
</body>
</html>										