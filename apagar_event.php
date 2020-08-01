<?php
session_start();

include_once ('conexao_cad.php');
// include_once ('edit_event.php');
// include ('agenda.php');
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$pega = $_SESSION['usuario'];

$query_event = "DELETE FROM `" .$pega. "` WHERE `id` = '$id' ";
$insere = mysqli_query($conexao_cad, $query_event);

echo "$pega, $id";
// header('Location: agenda.php');