<?php
session_start();

include_once ('conexao_cad.php');
// include ('agenda.php');

$title = $_POST['title'];
$color = $_POST['color'];
$start = $_POST['start'];
$end = $_POST['end'];



$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$pega = $_SESSION['usuario'];

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));



$sql = "SELECT id FROM `".$pega."`";
$result = mysqli_query($conexao_cad, $sql);
$row = mysqli_fetch_assoc($result);

// $cont = 0;

// while ($row = mysqli_fetch_array($result)){
//     $cont++;
// }

// echo "'$title', '$color', '$data_start_conv', '$data_end_conv', '$pega', '$cont'";

// $sql = "INSERT INTO test (title, color, start, end) VALUES (test, '#40E0D0', '2020-07-07 14:00:00', '2020-07-07 00:00:00' )";

// if($conexao_cad->query($sql) === TRUE){
// 	$retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
//     $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
// }

$query_event = "INSERT INTO " .$pega. " (title, color, start, end) VALUES ('$title', '$color', '$data_start_conv', '$data_end_conv')";
$insere = mysqli_query($conexao_cad, $query_event);

header('Location: agenda.php');


// $insert_event = $conexao_cad->prepare($query_event);
// $insert_event->bindParam(':title', $dados['title']);
// $insert_event->bindParam(':color', $dados['color']);
// $insert_event->bindParam(':start', $data_start_conv);
// $insert_event->bindParam(':end', $data_end_conv);

// if ($insert_event->execute()) {
//     $retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
//     $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
// } else {
//     $retorna = ['sit' => false, 'msg' => '<div class="alert alert-danger" role="alert">Erro: Evento não foi cadastrado com sucesso!</div>'];
// }


// header('Content-Type: application/json');
// echo json_encode($retorna);
