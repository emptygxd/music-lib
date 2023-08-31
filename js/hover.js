function hoverFun(value){
	songDiv = document.querySelector('.divN'+value);
	songDiv.classList.add("hovered");
}

function unhoverFun(value){
	songDiv = document.querySelector('.divN'+value);
	songDiv.classList.remove("hovered");
}

