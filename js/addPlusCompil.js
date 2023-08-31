const addBtn = document.getElementById('add'),
telo = document.querySelector('.favMainCont'),
cont = document.querySelector('.insCont'),
fragment = document.createDocumentFragment();
let i = 2
addBtn.addEventListener('click',()=>{
  
{/* <div class="songPlCrearion" >

<p style="width:20px;margin-bottom: 20px;" class="songNumber"><?php echo "$i" ?></p>

<select name="artist" class="inpOther" required>
    <?php 
        while($songs = $songQuery -> fetch_assoc()){
    ?>
    <option value="<?php echo $songs['songId'] ?>"><?php echo $songs['songName'] ?></option>
    <?php } ?>
</select>
</div>
<hr class="songHr"> */}

  let div = document.createElement('div')
  div.classList.add('songPlCrearion')
  
  let p = document.createElement('p')
  p.style='width:20px;margin-bottom: 20px;'
  div.classList.add('songNumber')

  let hr = document.createElement('hr')
  hr.classList.add('songHr')
  div.appendChild(hr)

  telo.append(div)
  i++
})


