



function showPassword1() {
	const btn1 = document.querySelector('.pass__btn1')
	const input1 = document.querySelector('.pass__input1')


	btn1.addEventListener('click',()=>{
		btn1.classList.toggle('active')

		if (input1.getAttribute('type')==='password'){
			input1.setAttribute('type','text')
		}else{
			input1.setAttribute('type','password')
		}
	})
}

function showPassword2() {
	const btn2 = document.querySelector('.pass__btn2')
	const input2 = document.querySelector('.pass__input2')


	btn2.addEventListener('click',()=>{
		btn2.classList.toggle('active')

		if (input2.getAttribute('type')==='password'){
			input2.setAttribute('type','text')
		}else{
			input2.setAttribute('type','password')
		}
	})
}

showPassword1()
showPassword2()