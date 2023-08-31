const trash = document.querySelector('.trash'),
 form = document.getElementById('delsong'),
 nameOfPl = document.getElementById('nameOfPl').innerHTML

trash.addEventListener('mouseover',() => {
    trash.src = 'images/trash.jpg'
})

trash.addEventListener('mouseout',() => {
    trash.src = 'images/closedTrash.jpg'
})

trash.addEventListener('click',() => {
    var isSure = confirm("Вы уверены, что хотите удалить песню "+nameOfPl+"?");
    if(isSure){
        form.submit()
    }
})
