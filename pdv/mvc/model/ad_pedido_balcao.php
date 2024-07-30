<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i');
$data = date('d/m/Y');
$hora_pedido = date('H:i');

include_once ("conexao.php");

  $result_usuarios = ("SELECT MAX(numeropedido) as 'Pedido'FROM `pedido`ORDER BY numeropedido DESC limit 1 ");
  $recebidos = mysqli_query($conn, $result_usuarios);

  while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

      $pedido = $row_usuario['Pedido'];
  }
  if ($pedido == null) {
      $pedido = "1001";
  } else {

      $result_usuarios = ("SELECT MAX(numeropedido)+1 as 'Pedido'FROM `pedido` ORDER BY numeropedido DESC limit 1 ");
      $recebidos = mysqli_query($conn, $result_usuarios);

      while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

          $pedido = $row_usuario['Pedido'];
      }
  };

  $numeropedido = $pedido;
  print_r($numeropedido);

