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

  $pgto = ($_POST['pgto']);
  $hashpagina = $_POST['hashpagina'];
  $valor_pago_cliente = $_POST['valor_pago_cliente'];

  $sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' order by id ASC";
  $pedido_previa = mysqli_query($conn, $sql_previa);

  while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
      
    $quantidade = $rows_previa['quantidade'];
    $pedido =     ($rows_previa['produto']);
    $preco_venda = $rows_previa['valor'];
    $observacoes = $rows_previa['observacao'];
    $id_produto = $rows_previa['id_produto'];

    if ($pgto == 'Fiado'){
      $insert_table_fiado = "INSERT INTO pedido_fiado (id, numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao,troco, pgto, usuario, `data` ,gorjeta, `status`) 
      VALUES ( NULL, '$numeropedido', '$tipo' ,'$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes','$troco' ,'$pgto', '$user', '$data_hora','', 1 )";	
      $adiciona_pedido_fiado = mysqli_query($conn, $insert_table_fiado);
    }
    
    $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, troco, pgto, usuario, `data` , gorjeta, status, frete_ifood ) VALUES
    ('$numeropedido','$tipo','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$troco','$pgto','$user','$data_hora' ,'' , 1, '' )";
  $adiciona_pedido = mysqli_query($conn, $insert_table);

  $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente' , id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
  $adiciona_pedido_2 = mysqli_query($conn, $insert_table);

  $delete_previa = "DELETE FROM pedido_previa WHERE hashpagina = '$hashpagina'";
  $delete_previa_mysqli = mysqli_query($conn, $delete_previa);

  };
  
    $novoIdInserido = $conn->insert_id;
    
    $tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete' and codigo = '$id_produto' ORDER by id ASC" ;
    $produtos = mysqli_query($conn, $tab_produtos);
  
    while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
          $estoque_atual = $rows_produtos['estoque_atual'];
    }
  
    if( $estoque_atual == "" ){
      }else{
  
        $select_quantidade =  "SELECT sum(quantidade) as quantidade FROM `pedido` WHERE numeropedido = '$numeropedido'";
        $mysqlquantidade = mysqli_query($conn, $select_quantidade);
  
        $row = mysqli_fetch_assoc($mysqlquantidade);
        $quantidade_rows = $row['quantidade'];
  
        $quantidadeAtual = $estoque_atual - $quantidade_rows;
        $update = "UPDATE `produtos` SET `estoque_atual` = '$quantidadeAtual' WHERE `produtos`.`codigo` = '$id_produto' ";
        $updatequantidade = mysqli_query($conn, $update);
  
      }  



    if($pgto == "Cartão Debito" ){
		
      $total = $_POST['valor_pago_cliente'];
      $porcentagem = 1.35;
      $resultado = $total - ($total * $porcentagem / 100);
      // $R = $total - $resultado;
          $Valor_format = number_format($resultado, 2);
  
    }elseif( $pgto == 'Cartão Credito' ){
        
      // print_r( "Valor da venda R$ ". $_POST['total']);
      // echo "<br>";
      $total = $_POST['valor_pago_cliente'];
      $pctm = 3.15;
      $valor_descontado = $total - ($total * $pctm / 100);
      $Valor_format = number_format($valor_descontado, 2);
        
    }elseif( $pgto == 'Voucher' ){
  
      $total = $_POST['valor_pago_cliente'];
      $pctm = 3.19;
      $valor_descontado = $total - ($total * $pctm / 100);
      $Valor_format = number_format($valor_descontado, 2);
  
    }elseif($pgto == 'iFood'){
  
      $total = $_POST['valor_pago_cliente'];
      
      // Taxa de comissão do Repasse em 1 Semana
      $pctmRepasse = 1.59;
      $valor_descontado_Repasse = ($total * $pctmRepasse / 100);
      $Valor_Repasse = number_format($valor_descontado_Repasse, 2);
      
      // Comissão iFood
      $pctmComissao = 23.00;
      $valor_descontado_Comissao = ($total * $pctmComissao / 100);
      $Valor_Comisssao = number_format($valor_descontado_Comissao, 2);
      
      // Comissão pela transação do Pagamento
      $pctmTransacao = 3.20;
      $valor_descontado_Transacao = ($total * $pctmTransacao / 100);
      $Valor_Transacao = number_format($valor_descontado_Transacao, 2);
      
      // Taxas e comissões
      $taxascomissao = $Valor_Repasse + $Valor_Comisssao + $Valor_Transacao;
      
      $totalpedido = $total + $frete_ifood;
  
      $valorliquido = $totalpedido - $frete_ifood -  $taxascomissao;
      
      $Valor_format = $valorliquido;
      
    }


    $tab_pedidos = "SELECT * FROM pedido WHERE numeropedido = '$numeropedido' ";

    $pedidos = mysqli_query($conn, $tab_pedidos);
  
    while($rows_produtos = mysqli_fetch_assoc($pedidos)) {

      $produto = $rows_produtos['produto'];
      $valor = $rows_produtos['valor'];
      $quantidade = $rows_produtos['quantidade'];
      $cliente = $rows_produtos['cliente'];
      $numeropedido = $rows_produtos['numeropedido'];
      $delivery = $rows_produtos['delivery'];
      $idmesa = $rows_produtos['idmesa'];
      $hora_pedido = $rows_produtos['hora_pedido'];
      $observacao = $rows_produtos['observacao'];
      $usuario = $rows_produtos['usuario'];
      $gorjeta = $rows_produtos['gorjeta'];
      $status = $rows_produtos['status'];
      $frete_ifood = $rows_produtos['frete_ifood'];
  
    }
  
    if( $pgto == 'Fiado' ){
  
      $tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_pedido = '$numeropedido' ";
      $mesas = mysqli_query($conn, $tab_mesas);
  
      $alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$numeropedido' ";
      $produto_excluido = mysqli_query($conn, $alterar_table);
      
      
    }else{
  
      $tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_pedido = '$numeropedido' ";
      $mesas = mysqli_query($conn, $tab_mesas);
    
      $insert_table = "INSERT INTO vendas ( id_pedido, valor, valor_maquina, cliente, data, rendimento, pgto) VALUES ( '$numeropedido', '$valor_pago_cliente', '$Valor_format', '$cliente', '$data', 'Mesa', '$pgto')";
      $produtos_editados = mysqli_query($conn, $insert_table);
  
      $alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$numeropedido' ";
      $produto_excluido = mysqli_query($conn, $alterar_table);
  
      $alterar_table_fiado = "UPDATE `pedido_fiado` SET `status` = '4' WHERE `numeropedido` = '$numeropedido' ";
      $alt_fiado = mysqli_query($conn, $alterar_table_fiado);
      
    }
    
  $_SESSION['novoIdInserido'] = $numeropedido;
  $_SESSION['$cliente'] = $cliente;

  