function PostAjax(Song) {
    var Song = document.querySelector('.'+Song).value;
    console.log(Song)
      $.ajax({
      type: "POST",
      url: '../vendor/searchAjax.php',
      data: 'Song='+Song,
      
      success: function(result) {
      $(".songDescr").remove();
      console.log(result)
      mas = $.parseJSON(result);
      prod = "";
      for(i=0; i<mas.length; i++){
      
          prod+='asdasd'
          /*'<div class="song eto divN<?=$i;?>" onmouseover="hoverFun(<?=$i;?>)" onmouseout="unhoverFun(<?=$i;?>)"onclick = "hoveredClick(<?=$i;?>)">
          <div class="suda" style="display: flex; align-items: center;">
          <p class="songNumber"><?php echo "$i" ?></p>

          <div class="songArtist">
            <p class="songTextArtist"><?php echo "$songsInfo[songName]";?></p>
            <p class="songTextOther"><?php echo "$artInfo[artistName]";?></p>
                  <div class="block" data-attr="<?=count($arr);?>" data-attr-name="<?php echo "$songsInfo[songName]"; ?>" data-attr-artist="<?php echo "$artInfo[artistName]"; ?>" data-attr-music="<?php echo "$songsInfo[mpfile]"; ?>" data-attr-ava="<?php echo "$songsInfo[ava]"; ?>"></div>
                  
          </div>

          <p style="width: 150px;" class="songTextOther"><?php $data = $songsInfo['dateAdded'];
            $cuttedDate = mb_strcut($data,0,10);
            echo "$cuttedDate";?></p>


            <?php
          $textForHeart= 'favoriteId';
          $userIdForHeart=$_COOKIE['id'];
          $songIdForHeart = $songsInfo[$text1];
            $isExistQuery =  $mysql -> query ("SELECT `favoriteId` FROM favorite WHERE `userId` = '$userIdForHeart' AND `songId` = '$songIdForHeart';");
          $isExist =  $isExistQuery -> fetch_assoc();

          if($isExist[$textForHeart] !=null){
                      ?>
          <form action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
        <button style="background: transparent; border:none;" type="submit">
        <img id="heartW" src="images/heartPurp.png" class="pics2" onclick="del()">
      </button></form>
      <?php } else{
        ?>
        <form action="vendor/addToFavorite.php?track=<?php echo $songIdForHeart?>" method="post">
        <button style="background: transparent; border:none;" type="submit">
        <img id="heartW" src="images/heartWhite.png" class="pics2" onclick="ad()">
      </button></form>
      <?php }  ?>


          <p style="margin-left: 50px;" class="songTextOther"><?php echo "$songsInfo[duration]";?></p>
        </div>

        </div>';*/
        }   
        $(".all").append(prod);
      }
     
    });
    
    }
    