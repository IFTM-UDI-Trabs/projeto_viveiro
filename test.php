<html>
<head>
<title>Como criar tabelas com PHP</title>
</head>
<body>
<?php
include("conexao_cad.php");
/* substitua as variáveis abaixo pelas que se adequam ao seu caso */
$dbhost = '127.0.0.1'; // endereco do servidor de banco de dados
$dbuser = 'root'; // login do banco de dados
$dbpass = ''; // senha
$dbname = 'projeto_viveiro'; // nome do banco de dados a ser usado
// $conecta = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);


$seleciona = mysql_select_db($dbname);

$sqlcriatabela = "CREATE TABLE contatos (nome VARCHAR(50), telefone VARCHAR(25));";

$criatabela = mysql_query(  $conexao_cad, $sqlcriatabela );

// inicia a conexao ao servidor de banco de dados

if(! $conexao_cad ){
  die("<br />Nao foi possivel conectar: " . mysql_error());
}
echo "<br />Conexao realizada!";

// seleciona o banco de dados no qual a tabela vai ser criada

if (! $seleciona){
  die("<br />Nao foi possivel selecionar o banco de dados $dbname");
}
echo "<br />selecionado o banco de dados $dbname";

// finalmente, cria a tabela 

if(! $criatabela ){
  die("<br />Nao foi possivel criar a tabela: " . mysql_error());
}

echo "<br />A tabela foi criada!";

// encerra a conexão
mysql_close($conexao_cad);
?>

</body>
</html>