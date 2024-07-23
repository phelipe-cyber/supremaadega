<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i');
$hora_pedido = date('H:i');

include_once ("conexao.php");

$codigo = $_POST['id'];

$update_estoque = "UPDATE `produtos` SET `estoque_atual` = (estoque_atual + 1) WHERE `produtos`.`codigo` = '$codigo'";

$mysql  = mysqli_query($conn, $update_estoque);

if(mysqli_affected_rows($conn)!= -1){

    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Recebido com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}else{

    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao Receber <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

$conn->close();
