<?php
define('HOST', 'https://dbviveiro.herokuapp.com/');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'projeto_viveiro');

$conexao_cad = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');

?>