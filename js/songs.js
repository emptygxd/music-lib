const playBtn = document.querySelector('.play'),
  prevBtn = document.querySelector('.prev'),
  nextBtn = document.querySelector('.next'),
  audio = document.querySelector('.audio'),
  progressConteiner = document.querySelector('.progress__conteiner'),
  progress = document.querySelector('.progress'),
  songsAmount = document.querySelector('.block').getAttribute('data-attr'),
  nameSong = document.querySelector('.nameOfSong'),
  nameArt = document.querySelector('.nameOfArt'),
  cover=document.querySelector('.cover'),
  player=document.querySelector('.footer'),
  shuffleBtn = document.querySelector('.shuffle'),
  repeatBtn = document.querySelector('.repeat'),
  volumeBtn = document.querySelector('.volume'),
  volumeConteiner = document.querySelector('.volume__conteiner'),
  volumeBar = document.querySelector('.volume__bar')
  div = document.querySelector('.forNameArt')

let titlesArr = []
let namesArr = []
let musicfile = []
let ava = []
let arrayOfRandom = [];
let id = 1
let counterForShuffled = 1
let songidASD
window.onload = function (){
    songidASD=document.querySelector('.block').getAttribute('data-attr')
    for (let q = 1; q<=songidASD;q++){
        let block = document.querySelector('.block')
        titlesArr[q] = block.getAttribute('data-attr-name')
        namesArr[q] = block.getAttribute('data-attr-artist').split(', ');
        musicfile[q] = block.getAttribute('data-attr-music')
        ava[q] = block.getAttribute('data-attr-ava')
        block.classList.remove('block')
    }
    loadSong(id)
    audio.volume = 0.3
}

// загрузить песню при загрузке страницы
function loadSong(song){
    nameArt.innerHTML = namesArr[song][0]
    nameSong.innerHTML = titlesArr[song]
    nameSong.href = `song.php?songName=${titlesArr[song]}`
    nameArt.href = `artist.php?artName=${namesArr[song][0]}`
    cover.src = `images/userpics/${ava[song]}`
    audio.src = `audio/${musicfile[song]}`
    for (let i = 1; i<6; i++){
      if (namesArr[song][i]!=undefined){
        let p = document.createElement('p')
        p.classList.add('forDel')
        p.style = 'width: 8px'
        p.innerHTML = ','
        div.appendChild(p)
        let a = document.createElement('a')
        a.classList.add('nameOfArt')
        a.classList.add('hrefFooter')
        a.classList.add('forDel')
        a.innerHTML = namesArr[song][i]
        div.appendChild(a)
        a.href = `artist.php?artName=${namesArr[song][i]}`
    }
  }
}

function playSong(){
    player.classList.add('play')
    playBtn.src ='images/pause2White.png'
    audio.play()
}
  
  function pauseSong(){
    player.classList.remove('play') 
    playBtn.src = 'images/playWhite.png'
    audio.pause()
  }

  playBtn.addEventListener('click',()=>{
    const isPlaying = player.classList.contains('play')
  
      if (isPlaying) {
        pauseSong()
      } else{
        playSong()
      }
  })

  function nextSong(){
    for (let i = 1; i<6; i++){
      if(document.querySelector('.forDel')){
      let toDelete = document.querySelector('.forDel')
      toDelete.remove()
    }
  }
    isShuffled = player.classList.contains('shuffle')
    if (isShuffled) {
        shuffleFun()
    }else{
        id++
        if (id>songidASD){
            id=1
        }
        loadSong(id)
        console.log(id)
        playSong()
    }
}


  nextBtn.addEventListener('click',()=>{
    nextSong()
  })


  //Предыдущая избранная песня
  function prevSong(){
    for (let i = 1; i<6; i++){
      if(document.querySelector('.forDel')){
      let toDelete = document.querySelector('.forDel')
      toDelete.remove()
    }
  }
    isShuffled = player.classList.contains('shuffle')
    if (isShuffled) {
        counterForShuffled--
        if (counterForShuffled<=0) {
            counterForShuffled=arrayOfRandom.length-1
        }
        loadSong(arrayOfRandom[counterForShuffled])
        playSong()
    }else{
    id--
    if (id<=0){
        id=songidASD
    }
    loadSong(id)
    playSong()
    }
  }

  prevBtn.addEventListener('click',()=>{
    prevSong()
  })

  function shuffled(){
    player.classList.add('shuffle')
    const numbers = []
    const getRandomNumber = (min, max) => {
      const number = Math.floor( Math.random() * (max - min) + min);
      if (numbers.includes(number)) return getRandomNumber(min, max)
      else {
          numbers.push(number)
          return number
      }
  }

  for (i = 1; i <= songsAmount; i++) {
      arrayOfRandom[i]=getRandomNumber(1, Number(songsAmount)+1)
  }
  console.log(arrayOfRandom)
    shuffleBtn.src ='images/shufflePurple.png'
  }
  
  function notShuffle(){
    player.classList.remove('shuffle')
    shuffleBtn.src ='images/shuffleWhite.png'
  }

  shuffleBtn.addEventListener('click',()=>{
    const isShuffled = player.classList.contains('shuffle')
    if (isShuffled) {
    notShuffle()
  } else{
    shuffled()
  }
  })

function shuffleFun(){
    counterForShuffled++
        if (counterForShuffled>=arrayOfRandom.length) {
            counterForShuffled=1
        }
        loadSong(arrayOfRandom[counterForShuffled])
        playSong()
}


function updateProgress(e) {
    const {duration, currentTime} = e.srcElement
    const progressPercent = (currentTime / duration) * 100
    progress.style.width = `${progressPercent}%`
  }

  audio.addEventListener('timeupdate',updateProgress)  


  //перемотка
  function setProgress(e){
    const width = this.clientWidth
    const clickX = e.offsetX
    const duration = audio.duration
  
    audio.currentTime = (clickX / width) * duration 
  }
  progressConteiner.addEventListener('click',setProgress)


  //Повторение одной песни
  function repeat(){
    player.classList.add('repeat')
    repeatBtn.src ='images/repeatPurp.png'
  }
  
  function notRepeat(){
    player.classList.remove('repeat')
    repeatBtn.src ='images/repeat-buttonWhite.png'
  }
  
  repeatBtn.addEventListener('click',()=>{
    isRepeat = player.classList.contains('repeat')
    if (isRepeat) {
    notRepeat()
  } else{
    repeat()
  }
  })



//автозапуск после конца песни
audio.addEventListener('ended',()=>{
    isRepeat = player.classList.contains('repeat')
    isShuffled = player.classList.contains('shuffle')
    if (isRepeat) {
      playSong()
    }else if (isShuffled) {
      shuffleFun()
    }else{
      nextSong()
    }
  })


//Выключение звука
  let volBeforeMute
function muted() {
  player.classList.add('muted')
  volumeBtn.src ='images/mutedVolumeWhite.png'
  volBeforeMute = audio.volume
  audio.volume = 0.0
}

//Включение звука
function unmuted(){
  player.classList.remove('muted')
  volumeBtn.src ='images/high-volumeWhite.png'
  audio.volume = volBeforeMute
}

volumeBtn.addEventListener('click',()=>{
  isMuted = player.classList.contains('muted')
  if (isMuted) {
    unmuted()
  }else{
    muted()
  }
})

//Изменение звука через слайдер
function rangeSlider(value) {
    audio.volume=value/100
  }

//Воспроизведение песни мышкой
  function hoveredClick(value){
    const isPlaying = player.classList.contains('play')
    if(id==value){
      if (isPlaying) {
        pauseSong()
      }else{
        playSong()
      }
    } else{
      for (let i = 1; i<6; i++){
        if(document.querySelector('.forDel')){
        let toDelete = document.querySelector('.forDel')
        toDelete.remove()
      }
    }
        loadSong(value)
        playSong()
        
      }
      id=value
      counterForShuffled = value
  }

