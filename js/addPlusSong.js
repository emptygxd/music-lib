const addBtn = document.getElementById('add'),
telo = document.querySelector('.favMainCont'),
mainCont = document.querySelector('.main-content'),
cont = document.querySelector('.insCont');
let i = 2
addBtn.addEventListener('click',()=>{
  
  let div = document.createElement('div')
  div.classList.add('insCont')
  
  let div2 = document.createElement('div')
  div2.classList.add('songPlCrearion')
  div.appendChild(div2)

  let p = document.createElement('p')
  p.classList.add('songNumber')
  p.style='width:20px;'
  p.innerText = i
  div2.appendChild(p)
 
  let input1 = document.createElement('input')
  input1.classList.add('inpOther')
  input1.style="width: 295px"
  input1.placeholder="Наименование песни"
  input1.type='text'
  input1.name="songname"+i
  input1.required = true
  div2.appendChild(input1)

  let input2 = document.createElement('input')
  input2.classList.add('inpOther')
  input2.style="width: 130px"
  input2.placeholder="Длительность"
  input2.type='text'
  input2.name="duration"+i
  input2.required = true
  div2.appendChild(input2)

  let input3 = document.createElement('input')
  input3.style="display:none"
  input3.accept = '.mp3'
  input3.id = "file"+i
  input3.type='file'
  input3.name="uploadmp"+i
  input3.required = true
  div2.appendChild(input3)

  let label = document.createElement('label')
  label.classList.add('labelForFile')
  label.htmlFor='file'+i
  label.innerHTML = 'Выберите mp3 файл'
  div2.appendChild(label)

  document.getElementById('count').value=i
  let hr = document.createElement('hr')
  hr.classList.add('songHr')
  div.appendChild(hr)

  telo.append(div)
  i++
})


//фав мейн конт больше высоты тогда добавляем к высоте