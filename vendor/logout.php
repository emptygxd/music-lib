<?php
setcookie('user',$user['nickname'], time()-3600*24,"/");
setcookie('id',$user['ID'], time()-3600*24,"/");
setcookie('login',$user['login'], time()-3600*24,"/");
setcookie('pass',$user['password'], time()-3600*24,"/");
setcookie('admin',$user['admin'], time()-3600*24,"/");
header('Location: ../login.php');
?>