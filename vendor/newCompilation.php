<?php 
header("Content-Type: text/html; charset=UTF-8");

if ($_POST){
$con=mysqli_connect('127.0.0.1', 'root', '', 'akuetto');
$dir = '../images/userpics/';
$uploadfile = $dir.basename($_FILES['uploadfile']['name']);
$namefile = basename($_FILES['uploadfile']['name']);
move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadfile);
$zapros="INSERT INTO PLName (name, description,ava) VALUES ('$_POST[compilName]','$_POST[description]','$namefile')";
echo $_POST['compilName'];
echo $_POST['description'];
echo $zapros;
$query=mysqli_query($con, $zapros);
if ($query)
	 header('Location: ../compilationCreation.php?playlist_accept=1');
else
	header('Location: ../compilationCreation.php?playlist_error=1');
}
?>