<?php 
$mysql = new mysqli('localhost','root','','akuetto');
$artistQuery = $mysql ->query ("SELECT * FROM `artist`");
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавление песни</title>
	<link rel="icon" href="images/playlistPurp.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/favorite.css">
	<link rel="stylesheet" type="text/css" href="css/playlist.css">
</head>
<body>
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
				<form action="vendor/newSong.php" method="post" enctype="multipart/form-data">
					<div class="PLHead">
						<div class="newPic plus cursor" >
						<input onchange="previewFile()" class="newInp" type="file" name="uploadfile" accept="image/jpeg, image/png" id="img">
                        </div>
                        <div style="display:flex; flex-direction: column;">
                            <input style="margin-bottom: 15px;" class="inpNameAlb" placeholder="Наименование песни" type="text" name="songName" required>

							<select name="artist" class="inpOther" required>
								<?php 
									while($artistsList = $artistQuery -> fetch_assoc()){
								?>
								<option value="<?php echo $artistsList['artistId'] ?>"><?php echo $artistsList['artistName'] ?></option>
								<?php } ?>
							</select>

                            <input class="inpOther" style="margin-top: 15px"  placeholder="Длительность" type="text" name="duration" required>
						<input style="margin-top: 11px; margin-left: 20px; display: none;" type="file" name="uploadmp" accept=".mp3" id="sng" required>
                        <label style="margin-top: 11px;" class="labelForFile" for="sng">Выберите mp3 файл</label>
                            
                        </div>
					</div>
					<hr class="favHr">
                </div>

				 <div class="createbtnDiv">
                <button type="submit" class="createBtn cursor">Сохранить</button>
				</form>
                </div>
            </div> 
			</section>
		</div>
        <script src='js/addPlusSong.js'></script>
        <script src='js/ava.js'></script>
	</div>
</body>
</html>										