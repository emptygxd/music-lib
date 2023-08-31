
function previewFile(){
let avaDiv = document.querySelector('.newPic');
let file = document.querySelector('input[type=file]').files[0];
let reader = new FileReader();
reader.onloadend = function(){
    avaDiv.style = 'background-size:150px 150px; border-radius: 20px; background-image: url('+ reader.result +')';
    avaDiv.classList.remove('plus')
}

if (file){
    reader.readAsDataURL(file)
}else{
    avaDiv.style = 'background-image: none';
    avaDiv.classList.add('plus')

}
}