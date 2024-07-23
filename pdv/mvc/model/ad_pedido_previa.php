<?php
session_start();
include_once("conexao.php");

$id_produto =  $_POST['id'] ?: "" ;
$hashpagina =  $_POST['hashpagina'] ?: "" ;
$botao =  $_POST['botao'] ?: "";

if( $botao == 'mais' ){

  $tab_produtos = "SELECT * FROM `produtos` where codigo = '$id_produto' ";
  $produtos = mysqli_query($conn, $tab_produtos);
  print_r($produtos);
  if($produtos->num_rows > 0){
    while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
          $nome = $rows_produtos['nome'];
          $detalhe = $rows_produtos['detalhes'];
          $preco_venda = $rows_produtos['preco_venda'];
          
    }

    $insert_table = "INSERT INTO `pedido_previa`( `id`, `id_produto`, `produto`, `quantidade`, `valor`, `observacao`,`hashpagina`) 
    VALUES (null, '$id_produto', '$detalhe', '1', '$preco_venda', '$obs', '$hashpagina')";
    $adiciona_pedido = mysqli_query($conn, $insert_table);
    if (!$adiciona_pedido) {
        // There was an error in the query
        die("Error: " . mysqli_error($conn));
      }

    }else{
      // die("Error: Produto não cadastrado");
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Produto não cadastrado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


    }

  }elseif( $botao == 'deletar' ){

  // $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' and hashpagina = '$hashpagina'";
  $delete = "DELETE FROM pedido_previa WHERE id = '$id_produto' AND hashpagina = '$hashpagina' ORDER BY id DESC LIMIT 1";

  $delete_item = mysqli_query($conn, $delete);
  if (!$delete_item) {
    // There was an error in the query
    die("Error: " . mysqli_error($conn));
  }
  

  }else{
  
  // $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' and hashpagina = '$hashpagina'";
  $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' AND hashpagina = '$hashpagina' ORDER BY id DESC LIMIT 1";
  $delete_item = mysqli_query($conn, $delete);
  if (!$delete_item) {
    // There was an error in the query
    die("Error: " . mysqli_error($conn));
  }

}