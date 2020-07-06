<?php
session_start();
include('conexao_cad.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$_SESSION['nao_autenticado'] = false;

//mysqli_real_escape_string

$usuario = mysqli_real_escape_string($conexao_cad, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao_cad, $_POST['senha']);

$query = "SELECT usuario_id, usuario FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";

$result = mysqli_query($conexao_cad, $query);

// if(empty($result)){
// 	$_SESSION['nao_autenticado'] = true;
// 	header('Location: index.php');
// }

// else{$_SESSION['usuario'] = $usuario;
	
// 	header('Location: painel.php');
// 	exit();
// }

$row = mysqli_num_rows($result);

if($row == 1){
	$_SESSION['usuario'] = $usuario;
	header('Location: painel.php');
	exit();
} 

else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
}

?>