<?php 
$PLName = $_GET['plId'];
$mysql = new mysqli('localhost','root','','akuetto');
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$names = $mysql -> query ("SELECT * FROM `PLName` WHERE `name` = '$PLName'");
$namesInfo = $names -> fetch_assoc(); 
$text3 = "nameId";
$playlist = $namesInfo[$text3];
$pl = $mysql -> query ("SELECT * FROM `PLGenre` WHERE `nameId` = '$playlist' order by `dateAdded` desc;");

$plForCount = $mysql -> query ("SELECT * FROM `PLGenre` WHERE `nameId` = '$playlist' ");
$arr = [];
$i=1;
while($plCount = $plForCount -> fetch_assoc()) {
	$text4 = "songId";
	$arr[$i]=$plCount[$text4];
	$i++;
}

$resultSongs = $mysql -> query ("SELECT * FROM `songs` ");
$songsInfo = $resultSongs -> fetch_assoc();
$text2 = "artistId";
$artId = $songsInfo[$text2];
$artist = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId`='$artId'");
$artInfo = $artist -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $namesInfo['name']?></title>
	<link rel="icon" href="images/playlistPurp.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/favorite.css">
	<link rel="stylesheet" type="text/css" href="css/search.css">
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
						<img src="images/userpics/<?= $namesInfo['ava']?>" class="favPic">
						<div class="favHeadText">
							<div class="nameTrash">
							<h2 id="nameOfPl"><?php echo $namesInfo['name']?></h2>
							<?php if (( $_COOKIE['id'] == $namesInfo['userId'] ) or (($_COOKIE['admin']== 1 ) and ($namesInfo['userId']== NULL ))){ ?>
								<form method="post" enctype="multipart/form-data" id="delpl" action="vendor/deletePl.php">
									<input style="display: none" value = "<?php echo $namesInfo['name']?>" name="plName">
									<input type='hidden' value = "<?php echo $namesInfo['nameId']?>" name="plId">
									<img class = "trash cursor" src="images/closedTrash.jpg" alt="">
							</form>
							<?php } ?>
							</div>
							<?php
							if ($namesInfo['userId'] != NULL){
								$user_id = $namesInfo['userId'];
							$nameUs = $mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$user_id'");
							$nameOfUser = $nameUs -> fetch_assoc();
							?>
								<p style="font-size:20px"><?php echo $nameOfUser['nickname'] ?></p>
						<?php } elseif ($namesInfo['artistId'] != NULL) { 
							$art_id = $namesInfo['artistId'];
							$nameAr = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId` = '$art_id'");
							$nameOfArt = $nameAr -> fetch_assoc();
							?>
								<p style="font-size:20px"><?php echo $nameOfArt['artistName'] ?></p>
						<?php  } ?>
							<p style="margin-bottom: 10px;" class="bio"><?php echo $namesInfo['description'] ?></p>
							<?php
								$userIdForHeart=$_COOKIE['id'];
								$plIdForHeart = $namesInfo['name'];
								$isExistQuery =  $mysql -> query ("SELECT `nameFavPl` FROM favoritePL WHERE `userId` = '$userIdForHeart' AND `nameFavPl` = '$plIdForHeart';");
								$isExist =  $isExistQuery -> fetch_assoc();
								$text = 'nameFavPl';
								if($isExist[$text] !=null){ ?>
							<form action="vendor/addToFavPl.php?pl=<?php echo $namesInfo['name']?>" method="post">
								<button class="cursor" style="background: transparent; border:none;" type="submit">
									<img  style="width: 30px; height: 30px;" src="images/galka.png" >
								</button>
							</form>
							<?php } else{ ?>
							<form  action="vendor/addToFavPl.php?pl=<?php echo $namesInfo['name']?>" method="post">
								<button class="cursor"  style="background: transparent; border:none;" type="submit">
									<img style="width: 30px; height: 30px;" src="images/plusWhite.png" >
								</button>
							</form>
							<?php } if (( $_COOKIE['id'] == $namesInfo['userId'] ) or (($_COOKIE['admin']== 1 ) and ($namesInfo['userId']== NULL ))){ ?>
							<a href="search.php">
								<img style="margin-top: 10px;margin-left: 5px; width: 30px; height: 30px;" src="images/addToPl.png">
							</a>
							<?php } ?>

						</div>
					</div>
					<hr class="favHr">
					</div>

				<div class="favMainCont">
				
				<div class="songDescr">
					<?php if (( $_COOKIE['id'] == $namesInfo['userId'] ) or (($_COOKIE['admin']== 1 ) and ($namesInfo['userId']== NULL ))){ ?>
						<label class="songNumber" style="width: 40px; color: #a5a5a5;">№</label>
						<label class="songTextOther" style="width: 250px; color: #a5a5a5;">Наименование</label>
						<label class="songTextOther" style="width: 165px; color: #a5a5a5;">Дата добавления</label>
						<label class="songTextOther" style="width: 105px; color: #a5a5a5;">Удалить</label>
						<label class="songTextOther" style="width: 125px; color: #a5a5a5;">В избранное</label>
						<label class="songTextOther" style="width: 60px; color: #a5a5a5;">Длительность</label>
					<?php }else{ ?>
						<label class="songNumber" style="width: 40px; color: #a5a5a5;">№</label>
						<label class="songTextOther" style="width: 290px; color: #a5a5a5;">Наименование</label>
						<label class="songTextOther" style="width: 165px; color: #a5a5a5;">Дата добавления</label>
						<label class="songTextOther" style="width: 130px; color: #a5a5a5;">В избранное</label>
						<label class="songTextOther" style="width: 60px; color: #a5a5a5;">Длительность</label>
						<?php } ?>
					</div>
					<?php	 
					$i=1; while ($plInfo = $pl -> fetch_assoc()) {		
						$text1 = "songId";
						$songId = $plInfo[$text1];
						$songs = $mysql -> query ("SELECT * FROM `songs` WHERE `songId`='$songId' ");
						$songsInfo = $songs -> fetch_assoc(); 
						$text2 = "artistId";
						$artId = $songsInfo[$text2];
						$artist = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId`='$artId'");
						$artInfo = $artist -> fetch_assoc();
						$plSongDivNumber = $songsInfo[$text1];?>

					<div class="song eto divN<?=$i;?>" onmouseover="hoverFun(<?=$i;?>)" onmouseout="unhoverFun(<?=$i;?>)"onclick = "hoveredClick(<?=$i;?>)">
						<p class="songNumber"><?php echo "$i" ?></p>

						<div style="width: 340px;" class="songArtist">
							<p class="songTextArtist"><?php echo "$songsInfo[songName]";?></p>
							<p class="songTextOther"><?php echo "$artInfo[artistName]";?></p>
				            <div class="block" data-attr="<?=count($arr);?>" data-attr-name="<?php echo "$songsInfo[songName]"; ?>" data-attr-artist="<?php echo "$artInfo[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				            
						</div>

						<p style="width: 195px;" class="songTextOther"><?php $data = $songsInfo['dateAdded'];
							$cuttedDate = mb_strcut($data,0,10);
							echo "$cuttedDate";?></p>
						<?php if (( $_COOKIE['id'] == $namesInfo['userId'] ) or (($_COOKIE['admin']== 1 ) and ($namesInfo['userId']== NULL ))){ ?>
							<form style="width: 161px;" action="vendor/delFromPl.php?pl=<?php echo $namesInfo['name']?>" method="post">
								<button class="cursor"  style="background: transparent; border:none;" type="submit">
									<img style="width: 30px; height: 30px;" src="images/trash.jpg" >
								</button>
							</form>
							<?php }
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


						<p style="margin-left: 50px;" class="songTextOther"><?php echo "$songsInfo[duration]";?></p>
					</div>

					<hr class="songHr">
					<?php $i++; }?>
				</div>
				</div>
				</div>
			</section>
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
					<a href="artist.php?artName=<?php echo $artInfo["artistName"];?>" class="nameOfArt hrefFooter" ><?php echo "$artInfo[artistName]";?></a>
				</div>
			</div>	
		<?php require_once 'parts/footer.php' ?>
		
	</footer>
		<script src="js/songs.js"></script>
		<script src="js/hover.js"></script>
		<script src="js/trash.js"></script>
		<script src="js/ajax.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	</div>
</body>
</html>										