function verifica_vazio(){
	var x = document.form.usuario.value;
	var y = document.form.senha.value;

	if(x == ""){
		document.getElementsByClassName("notification")[1].classList.add(" Aparece");
	}
}

function mudar_pagina(){
  window.location.href = "cadastro.php"
}

function cadastro(){

	var erro = false;
	var txt = "";

	var msg = document.getElementById("erro");

	var print = document.getElementById("txt_erro");
	var form = document.getElementById("formulario");

	var usuario = document.getElementById("username").value;
	var email = document.getElementById("email").value;
	var senha = document.getElementById("senha").value;
	var confirmacao = document.getElementById("senha_confirm").value;


	if (usuario == ""){
		erro = true;
		txt += "O Campo Usuário não pode ficar vazio!<br>";
	}

	if (email == ""){
		erro = true;
		txt += "O Campo Email não pode ficar vazio!<br>";
	} else{
		var pos_arroba = email.indexOf("@"); 

		if (pos_arroba < 1){
			erro = true;
			txt += "Email inválido.<br>"; 	  
		} else{		    
         
        	var provedor  = email.substring(pos_arroba + 1, email.length);

          // e_email = carlos@iftm.edu.br
          // provedor = "iftm.edu.br"
			var pos_ponto = provedor.indexOf(".");

			if (pos_ponto < 1){

			    erro = true;
				txt += "Email inválido.<br>";

			} else{

		        if (pos_ponto == provedor.length - 1){
		        	
		        	erro = true;
		          	txt += "Email inválido.<br>";

		        }
	      	}	  
		}
	}

	if (senha == ""){
		erro = true;
		txt += "O Campo Senha não pode ficar vazio!<br>";
	} else if (senha.length < 6 || senha.length > 10){
		erro = true;
		txt += "A senha deve ter de 6 a 10 dígitos!<br>";
	}

	if (confirmacao != senha){
		erro = true;
		txt += "O Campo Confirmar Senha deve ser igual ao Campo Senha!<br>";
	}

	if (erro == true){
		print.innerHTML = txt;
	} else{
		form.submit();
	}

	if (erro == false){
		msg.style.display = "none";
	} else{
		msg.style.display = "inline-block";
	}

	

}