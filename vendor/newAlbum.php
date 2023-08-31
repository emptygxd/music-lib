<?php 
header("Content-Type: text/html; charset=UTF-8");

if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$dir = '../images/userpics/';
$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile);
$count=$_POST['i'];
    $zapros="INSERT INTO PLName (name, artistId, ava) VALUES ('$_POST[albName]','$_POST[artist]','$namefile')";
	mysqli_query($con, $zapros);
	$albQuery = $con -> query ("SELECT * FROM `PLName` order by nameId desc limit 1");
	$albInfo= $albQuery -> fetch_assoc(); 
	$albId = $albInfo['nameId'];
	for ($i=1;$i<= $count;$i++){
		$dirMP = '../audio/';
		$uploadfileMP = $dirMP.basename($_FILES['uploadmp'.$i]['name']);
		$namefileMP = basename($_FILES['uploadmp'.$i]['name']);
		move_uploaded_file($_FILES['uploadmp'.$i]['tmp_name'], $uploadfileMP);
		$zapros2="INSERT INTO songs (songName,artistId,duration, ava, mpfile) VALUES ('".$_POST['songname'.$i]."','$_POST[artist]','".$_POST['duration'.$i]."','$namefile','$namefileMP')";
		mysqli_query($con, $zapros2);
		$idQuery = $con -> query ("SELECT * FROM `songs` order by songId desc limit 1");
		$songInfo = $idQuery -> fetch_assoc();
		$songId = $songInfo['songId'];
		$zapros3="INSERT INTO PLGenre (songId,nameId) VALUES ('$songId','$albId')";
		mysqli_query($con, $zapros3);
	}
	header('Location: ../playlistCreation.php?playlist_accept=1'); 

}

?>