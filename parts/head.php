
<img src="images/userpics/<?php echo $user['userPic']; ?>" alt="avatar" class="ava">

<a class="userNameText"><?= $_COOKIE['user']; ?></a>
<div class="dropdown">
    <img src="images/down-arrowWhite.png" onclick="myFunction()" class="dropbtn" alt="settingsArrow" width="20px" height="20px" style="margin-left: 15px;" >
    <div id="myDropdown" class="dropdown-content">
        <a href="settings.php"><img style="width: 20px;height: 20px;margin-right: 10px;" src="images/settingsWhite.png">Настройки</a>
        <a href="vendor/logout.php"> <img style="width: 20px;height: 20px;margin-right: 10px;" src="images/exitWhite.png"> Выйти</a>
    </div>
</div>
<script src="js/script.js"></script>