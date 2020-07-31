<?php
session_start();

include_once ('conexao_cad.php');

$title = $_POST['title'];
$color = $_POST['color'];
$start = $_POST['start'];
$end = $_POST['end'];
$id = $_POST['id'];


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$pega = $_SESSION['usuario'];

//Converter a data e hora do formato brasileiro para o formato do Banco de Dados
$data_start = str_replace('/', '-', $dados['start']);
$data_start_conv = date("Y-m-d H:i:s", strtotime($data_start));

$data_end = str_replace('/', '-', $dados['end']);
$data_end_conv = date("Y-m-d H:i:s", strtotime($data_end));



// echo "'$title', '$color', '$data_start_conv', '$data_end_conv', '$pega', '$id'";

// $sql = "INSERT INTO test (title, color, start, end) VALUES (test, '#40E0D0', '2020-07-07 14:00:00', '2020-07-07 00:00:00' )";

// if($conexao_cad->query($sql) === TRUE){
// 	$retorna = ['sit' => true, 'msg' => '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>'];
//     $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Evento cadastrado com sucesso!</div>';
// }
// UPDATE `test` SET `id`=[6],`title`=[123],`color`=[#8B4513],`start`=[2020-07-06 23:00:00],`end`=[2020-07-06 00:00:00] WHERE 1
$query_event = "UPDATE " .$pega. " SET `title`= '$title', `color`='$color', `start`='$data_start_conv', `end`= '$data_end_conv' WHERE `id` = '$id'";
$insere = mysqli_query($conexao_cad, $query_event);

header('Location: agenda.php');