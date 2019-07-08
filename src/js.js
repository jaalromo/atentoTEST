document.addEventListener('DOMContentLoaded', ()=>{ //

	//para detetar qual tecla foi apertada no input nome
	document.getElementById('nome').addEventListener("keypress",(e)=>{ 
		if(/[^A-Za-z\s]/.test(e.key)){ //deteta a tecla que foi apertada e só permite escrever carateres maiúsculos, minúsculos e a spacebar
			e.preventDefault();
		}
	});

	document.getElementById('nome').addEventListener("blur",()=>{
		document.getElementById('nome').value=document.getElementById('nome').value.trim(); //elimina espaços vazios antes e depois do que esta escrito dentro do input nome
	});

	//para detetar qual tecla foi apertada no input idade
	document.getElementById('idade').addEventListener("keypress",(e)=>{
		if(/[^0-9]/.test(e.key)){ //deteta a tecla que foi apertada e só permite escrever carateres numericos
			e.preventDefault();
		}
	});
});