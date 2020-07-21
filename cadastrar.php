<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/valida_cadastro.js"></script>
</head>


<?php
session_start();
include("conexao_cad.php");
include("js/valida_cadastro.js");

$usuario = mysqli_real_escape_string($conexao_cad, trim($_POST['usuario']));
$email = mysqli_real_escape_string($conexao_cad, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao_cad, trim($_POST['senha']));

$sql = "SELECT count(*) AS total FROM usuarios WHERE usuario = '$usuario'";
$result = mysqli_query($conexao_cad, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1) {
	$_SESSION['usuario_existe'] = true;
	header('Location: cadastro.php');
	exit();
}

$sql = "INSERT INTO usuarios (usuario, email, senha) VALUES ('$usuario', '$email', '$senha')";

$_SESSION['table'] = $usuario;



$create_table = "CREATE TABLE $_SESSION['table'] (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);"

if($conexao_cad->query($sql) === TRUE){
	$_SESSION['status_cadastro'] = true;
}

$conexao_cad->close();

header('Location: cadastro.php');
exit();

?>

</html>