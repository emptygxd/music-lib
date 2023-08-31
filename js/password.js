function showPassword() {
	const btn = document.querySelector('.pass__btn')
	const input = document.querySelector('.password__input')

	btn.addEventListener('click',()=>{
		btn.classList.toggle('active')

		if (input.getAttribute('type')==='password'){
			input.setAttribute('type','text')
		}else{
			input.setAttribute('type','password')
		}
	})
}
showPassword()