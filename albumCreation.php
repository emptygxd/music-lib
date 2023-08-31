<?php 
$mysql = new mysqli('localhost','root','','akuetto');
$id=$_COOKIE['id'];
$userQuery=$mysql -> query ("SELECT * FROM `users` WHERE `ID` = '$id';");
$user = $userQuery -> fetch_assoc();

$artistQuery = $mysql ->query ("SELECT * FROM `artist`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Создание альбома</title>
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
				<form action="vendor/newAlbum.php" method="post" enctype="multipart/form-data">
				<div class="favPL">
					<div class="PLHead">
						
						<div class="newPic plus cursor" >
							<input  onchange="previewFile()"  class="newInp" type="file" name="uploadfile" accept=".jpg" id="img">
                        </div>
                        <div style="display:flex; flex-direction: column;">
                            <input class="inpNameAlb" placeholder="Наименование альбома" type="text" name="albName" required>
							<select name="artist" class="inpOther" required>
								<?php 
									while($artistsList = $artistQuery -> fetch_assoc()){
								?>
								<option value="<?php echo $artistsList['artistId'] ?>"><?php echo $artistsList['artistName'] ?></option>
								<?php } ?>
							</select>
                        </div>
					</div>
					<hr class="favHr">
                </div>

				<div class="favMainCont">
                    <div class="insCont"> 
                        <?php $i=1 ?>
                        <div class="songPlCrearion" >

                            <p style="width:20px;" class="songNumber"><?php echo "$i" ?></p>
                            
                            <input class="inpOther" style="width: 295px" placeholder="Наименование песни" type="text" name="songname1" required >
                            <input class="inpOther" style="width: 130px"  placeholder="Длительность" type="text" name="duration1" required>
							<input style="margin-left: 20px; display:none" type="file" name="uploadmp1" accept=".mp3" id="file" required>
							<label class="labelForFile" for="file">Выберите mp3 файл</label>

                            <input id="count" type="hidden" value = "1" name="i" > 
                        </div>
                        <hr class="songHr">
                        <?php $i++;?>
                    </div>
				</div>
                <div class="textAddBnt">
                    <label id="add" class="cursor">Добавить еще песню</label>
                </div>
                <hr class="favHr">
                <div class="createbtnDiv">
                <button type="submit" class="createBtn cursor">Сохранить</button>
                </div>
				</form>
            </div>
			</section>
		</div>
        <script src='js/addPlusSong.js'></script>
        <script src='js/ava.js'></script>
	</div>
</body>
</html>										