<?php
$mysql =new mysqli('localhost', 'root', '', 'akuetto');
$text = filter_var(trim($_POST['searchQuery']),FILTER_SANITIZE_STRING);

$searchResultSongs = $mysql -> query ("SELECT songs.songName, GROUP_CONCAT(artist.artistName SEPARATOR ', ') AS artistName, songs.dateAdded, songs.ava FROM songs INNER JOIN artist on songs.artistId = artist.artistId WHERE `songName` LIKE '%$text%' or `artistName` LIKE '%$text%' GROUP BY songs.songName,songs.dateAdded, songs.ava ORDER BY songs.dateAdded DESC;");
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$PLName = $mysql -> query ("SELECT * FROM `PLName` WHERE `name` LIKE '%$text%'");
$artistQuery = $mysql -> query ("SELECT * FROM `artist` WHERE `artistName` LIKE '%$text%'");
// $names = $mysql -> query ("SELECT * FROM `PLName` WHERE `userId` IS NULL");


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
	<title>Поиск</title>
	
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
	<div style = 'justify-content: space-between;' class="headFav">
					<form action="search.php" method="post">
					<div class="searchDiv">
						<input placeholder="Поиск" class="search" type="text" name="searchQuery">
						<div class="searchPic"><img src="images/searchPurp.png" style="width: 20px; height: 20px;"></div>
						<span class="clear"></span>
					</div>
					<input type="submit" style="opacity: 0;">
					</form>
					<div class="profileLineFav">
					<?php require_once 'parts/head.php' ?>

					</div>
				</div>
						<?php 
					if( $_POST['searchQuery']	!=''){ ?>
						<p style="margin-top:30px; margin-left: 20px;">Результаты поиска:</p>
						<?php
					 	$i=1; while ($songArtName = $resultSongs -> fetch_assoc()) {
							$songName = $songArtName["songName"];
							$songs = $mysql -> query ("SELECT * FROM `songs` WHERE `songName`='$songName'");
							$songsInfo = $songs -> fetch_assoc();?>
						<div class="block" data-attr="<?=$amount;?>"  data-attr-name="<?php echo "$songArtName[songName]"; ?>" data-attr-artist="<?php echo "$songArtName[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				        <?php $i++; }	?>
						<div class="searchItems">
						<?php 
							$i=1; 
							while ($artistInfo=$artistQuery-> fetch_assoc()) { ?>
							<a href="artist.php?artName=<?php echo $artistInfo["artistName"];?>">
								<div class="searchItem" > 
									<img src="images/userpics/<?php echo "$artistInfo[ava]"; ?>" width="93px" height="110px" style="border-radius:50%">
									<p style="text-align:center; margin-left: 0" class="songName"><?php echo "$artistInfo[artistName]";?></p>
							 	</div>
							</a>
							 <?php $i++; } ?>
							</div>
							 <div class="searchItems">
							 <?php
							$i=1; 
							while ($searchSongsInfo=$searchResultSongs-> fetch_assoc()) { ?>
							<a href="song.php?songName=<?php echo $searchSongsInfo["songName"];?>">
								<div class="searchItem" > 
									<img src="images/userpics/<?php echo "$searchSongsInfo[ava]"; ?>" width="93px" height="110px" style="border-radius:10px">
									<p class="songName"><?php echo "$searchSongsInfo[songName]";?></p>
									<p class="artName"><?php echo "$searchSongsInfo[artistName]";?></p>

							 	</div>
							</a>
							 <?php $i++; } 
							 while ($namesInfo=$PLName-> fetch_assoc()) {?>
							<a href="playlist.php?plId=<?php echo $plId=$namesInfo['name'];?>">
								<div class="searchItem"> <img src="images/userpics/<?php echo "$namesInfo[ava]"; ?>" width="93px" height="110px" style="border-radius:10px">
								<p title="<?php echo "$namesInfo[name]";?>" class="songName"><?php echo "$namesInfo[name]";?></p>
								<?php if($namesInfo['userId'] != NULL){
									$const = $namesInfo['userId'];
									$userQuery = $mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$const'");
									$user = $userQuery -> fetch_assoc();
									?>
								<p title="<?php echo "$user[nickname]";?>" class="artName"><?php echo "$user[nickname]";?></p>
								<?php };?>
								<?php if($namesInfo['artistId'] != NULL){ 
									$const = $namesInfo['artistId'];
									$artQuery = $mysql -> query ("SELECT * FROM `artist` WHERE `artistId` = '$const'");
									$art = $artQuery -> fetch_assoc();
									?>
								<p title="<?php echo "$art[artistName]";?>" class="artName"><?php echo "$art[artistName]";?></p>
								<?php } ?>
							 </div>
							 </a>
							 <?php $i++; } ?>
						</div>
						<?php }
						 else{ ?>
						<div class="searchMainCont">
						<div class="song">
						<label class="songNumber" style="width: 45px; color: #a5a5a5;">№</label>
						<label class="songTextOther" style="width: 295px; color: #a5a5a5;">Наименование</label>
						<label class="songTextOther" style="width: 170px; color: #a5a5a5;">Дата выхода</label>
						<label class="songTextOther" style="width: 120px; color: #a5a5a5;">В плейлист</label>
						<label class="songTextOther" style="width: 140px; color: #a5a5a5;">В избранное</label>
						<label class="songTextOther" style="width: 60px; color: #a5a5a5;">Длительность</label>
					</div>

						<?php
					 	$i=1; while ($songArtName = $resultSongs -> fetch_assoc()) {
							$songName = $songArtName["songName"];
							$songs = $mysql -> query ("SELECT * FROM `songs` WHERE `songName`='$songName'");
							$songsInfo = $songs -> fetch_assoc()?>
					<div class="song divN<?=$i;?>" onmouseover="hoverFun(<?=$i;?>)" onmouseout="unhoverFun(<?=$i;?>)" onclick = "hoveredClick(<?=$i;?>)">
						<p class="songNumber"><?php echo "$i" ?></p>
						<div style="width: 280px;" class="songArtist">
							<p class="songTextArtist"><?php echo "$songArtName[songName]";?></p>
							<p class="songTextOther"><?php echo "$songArtName[artistName]";?></p>
				            <div class="block" data-attr="<?=$amount;?>" data-attr-name="<?php echo "$songArtName[songName]"; ?>" data-attr-artist="<?php echo "$songArtName[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
				            
						</div>
						<p style="width: 190px;" class="songTextOther"><?php $data = $songsInfo['dateAdded'];
							$cuttedDate = mb_strcut($data,0,10);
							echo "$cuttedDate";?></p>














						<div style="width: 120px;" id = "PlDropDwn">
							<img style="z-index:123; display:flex;" title = "Добавить в плейлист" id="addToPl" src="images/addToPl.png" class="dropbtn pics2" onclick = "showDropPls(<?=$i;?>)">
							
							

							<div class="dropdown-content dropdownContent<?=$i;?>">
								<?php if ($_COOKIE['admin']== 1 ){
								$plsQuery = $mysql -> query ("SELECT * FROM `PLName` WHERE `userId`='$id' or `userId` is null");
								while( $plsInfo = $plsQuery -> fetch_assoc()){ ?>
								<form  action="vendor/addSongToPl.php?track=<?php echo "$songArtName[songName]";?>&pl=<?php echo "$plsInfo[name]";?>" method="post">
									<button style="background: transparent; border:none; min-width: 160px; padding: 0;" type="submit">
										<a><?php echo $plsInfo['name']; ?></a>
									</button>
								</form>
								<?php } }else{
									$plsQuery = $mysql -> query ("SELECT * FROM `PLName` WHERE `userId`='$id'");
									while( $plsInfo = $plsQuery -> fetch_assoc()){ ?>
									<form  action="vendor/addSongToPl.php?track=<?php echo "$songArtName[songName]";?>&pl=<?php echo "$plsInfo[name]";?>" method="post">
										<button style="background: transparent; border:none; min-width: 160px; padding: 0;" type="submit">
											<a><?php echo $plsInfo['name']; ?></a>
										</button>
									</form>
								<?php } } ?>
							</div>
							
						</div>




















							<?php
						$qwe=$songArtName['songName'];
						$qweQuery = $mysql -> query ("SELECT songs.songId FROM `songs` WHERE `songName`='$qwe'");
						$qweInfo = $qweQuery -> fetch_assoc();
						$textForHeart= 'favoriteId';
						$userIdForHeart=$_COOKIE['id'];
						$songIdForHeart=$qweInfo['songId'];
							$isExistQuery =  $mysql -> query ("SELECT `favoriteId` FROM favorite WHERE `userId` = '$userIdForHeart' AND `songId` = '$songIdForHeart';");
						$isExist =  $isExistQuery -> fetch_assoc();
						if($isExist[$textForHeart] !=null){	?>
						<form style="width: 80px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img title = "Добавить/удалить из избранного" id="heartW" src="images/heartPurp.png" class="pics2" onclick="del()">
				</button></form>
				<?php } else{
					?>
					<form style="width: 80px;" action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
					<button style="background: transparent; border:none;" type="submit">
					<img id="heartW" src="images/heartWhite.png" class="pics2" onclick="ad()">
				</button></form>
				<?php }  ?>
						<p style="margin-left: 50px;" class="songTextOther"><?php echo "$songsInfo[duration]";?></p>
					</div>
					<hr class="songHr">
					<?php $i++;} }?>
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
<script src="js/search.js"></script>
<script src ="js/songs.js"></script>
<script src ="js/PlDropDwn.js"></script>

</body>
</html>