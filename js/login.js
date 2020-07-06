function verifica_vazio(){
	var x = document.form.usuario.value;
	var y = document.form.senha.value;

	if(x == ""){
		document.GetElementsByClassName("notification")[1].classList.add(" Aparece");
	}
}

function mudar_pagina(){
  window.location.href = "cadastro.php"
}