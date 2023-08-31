<?php 
$mysql = new mysqli('localhost','root','','akuetto');
$text = filter_var(trim($_POST['searchQuery']),FILTER_SANITIZE_STRING);

$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$searchResultSongs = $mysql -> query ("SELECT * FROM `songs` INNER JOIN `artist` on artist.artistId=songs.artistId WHERE songName LIKE '%$text%' or artistName LIKE '%$text%'");

?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Создание плейлиста</title>
	<link rel="icon" href="images/playlistPurp.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/favorite.css">
	<link rel="stylesheet" type="text/css" href="css/playlist.css">
	<link rel="stylesheet" type="text/css" href="css/search.css">
	<link rel="stylesheet" type="text/css" href="css/creation.css">
</head>
<body >
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
				<form action="vendor/newCompilation.php" method="post" enctype="multipart/form-data">
				<div class="favPL">
					<div class="PLHead">
						<div class="newPic plus cursor" >
						<input onchange="previewFile()" class="newInp" type="file" name="uploadfile" accept=".jpg" id="img">
                        </div>
                        <div style="display:flex; flex-direction: column;">
                            <input class="inpNameAlb" placeholder="Наименование подборки" type="text" name="compilName" required>
                            <textarea class="inpDesc" placeholder="Описание" type="text" name="description" required></textarea>
                        </div>
					</div>
					<hr class="favHr">
                </div>
                <div class="createbtnDiv">
                <button class="createBtn cursor">Сохранить</button>
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