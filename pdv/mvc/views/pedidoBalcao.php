<?php
session_start();

include "./mvc/model/conexao.php";
include_once "./mvc/model/hashPagina.php";
// print_r($_POST);
// exit();

$user =  $_SESSION['user'];
$hora_pedido = date('H:i');

$categoria = $_POST['categoria'];
$pesquisa = $_POST['pesquisa'];
$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
// print_r($_POST);
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<!-- JQuery -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

<script>
    // window.location.reload(true);
</script>

<div class="d-flex justify-content-center">
            <div id="spinner" class="spinner-border text-primary" role="status" style="display: none;">
                <span class="sr-only">Loading...</span>
            </div>
    </div>

    <div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {
                                                                        echo $_SESSION['msg'];
                                                                        unset($_SESSION['msg']);
                                                                    } ?></div>

<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">

        
        <br>

        <?php


$tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete' ORDER by id ASC" ;
$produtos = mysqli_query($conn, $tab_produtos);

$tab_pgto = "SELECT * FROM `forma_pagamento` ORDER by id ASC" ;
$pgto = mysqli_query($conn, $tab_pgto);

?>
  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- <form id="Form" action="mvc/model/ad_pedido_balcao.php" method="POST"> -->
                        
                <input type="hidden" id="hash" name="hashpagina" value="<?php echo $hashpagina ?>">

                <b><label for="">* Forma de Pagamento:</label></b>
                <div class="row">
                        <?php
                            while ($rows_pgto = mysqli_fetch_assoc($pgto)) {
                        ?>

                            <div class="form-group col-md-3">
                                <div class="form-check">
                                    <input name="pgto" class="form-check-input" type="radio" value="<?php echo ($rows_pgto['value']) ?>" id="<?php echo ($rows_pgto['tipo']) ?>">
                                    <label class="form-check-label" for="<?php echo ($rows_pgto['tipo']) ?>"><?php echo ($rows_pgto['tipo']) ?></label>
                                </div>
                            </div>
                            
                        <?php
                            }
                        ?>     
                </div>
                
                <div class="form-group col-md-6">
                    <b><label for="">* Codigo Produto:</label></b>
                    <input type="text" name="codigo" id="codigo" class="form-control" autofocus >
                </div>
   
                <div class="col-md-1">
                        <div class="" style="display: inherit;">
                            <button type="submit" id="finaliza" class="btn btn-xs btn-info" >Finalizar</button>
                        </div>
                </div>
            
                <div class="col-6">
                </div>

<br>

              <div class="row">

<div id="valor_pago_style" class="form-group col-md-6" style="display: block;" >
    <label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: green; color: white; ">Valor Pago</label>
    <input autofocus required name="valor_pago_cliente" id="valor_pago" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" value="">
</div>

<script>
    $(document).ready(function() {

        $("#valor_pago").on('keyup', function(event) {
              // console.log(event);
            // if (event.keyCode === 9 || event.keyCode === 13) {
              
                var valor_pago = document.getElementById("valor_pago").value;

                var valor_total = document.getElementById("valor_total").value;

                var total = document.getElementById("valor_total").value;

                console.log(valor_pago);

                if (valor_total == "") {
                    valor_total = "0.00";

                    var tarifa = (valor_pago.replace(",", "."));
                    var taxa = (total.replace(",", "."));
                    var total = (parseFloat(tarifa) - parseFloat(taxa));

                    var arredonda = "R$ " + (Math.round(total * 100)) / 100;
                    console.log(arredonda);

                    if(valor_pago == '' || arredonda == 'NaN' ){
                          arredonda = null;
                          document.getElementById("troco").innerHTML =  null;
                      }else{
                          document.getElementById("troco").innerHTML =  arredonda;
                      }
                          document.getElementById('troco_display').style = 'display:block';

                } else {
                    var valor_total = document.getElementById("valor_total").value;

                    var tarifa = (valor_pago.replace(",", "."));
                    var taxa = (total.replace(",", "."));
                    var total = (parseFloat(tarifa) - parseFloat(taxa));

                    var arredonda = "R$ " + (Math.round(total * 100)) / 100;
                    // console.log(arredonda);
                    if(valor_pago == '' || arredonda == 'NaN' ){
                          arredonda = null;
                          document.getElementById("troco").innerHTML =  null;
                      }else{
                          document.getElementById("troco").innerHTML =  arredonda;
                      }
                          document.getElementById('troco_display').style = 'display:block';
                    };

            // };

        });
    });
</script>

<div id="valor_pago_style_total" class="form-group col-md-6">
    <label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: blue; color: white; ">Valor Total</label>
    <input autofocus name="valor_pago" id="valor_total" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" value="<?php echo number_format($total, 2); ?>">
</div>

</div>

<div id="troco_display" class="row" style="display: block;">

<div class="col-xl-12 col-md-6 mb-4">
    <div style="font-size: 25px; background: #fe422d; color: white;">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2 text-center">
                    <div class=" font-weight-bold text-uppercase mb-1">Troco</div>
                    <div id="troco"> </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


                <script>
                    
                        // document.getElementById('codigo').addEventListener('input', function() {
                        document.getElementById('codigo').addEventListener('keydown', function(event) {
                        if (event.key === 'Enter') {
                            var codigo = this.value;
                            hashpagina =  document.getElementById("hash").value;
                            document.getElementById('spinner').style='diplay:flex;';
                                                
                            var vData = {
                                         id: codigo,
                                         hashpagina: hashpagina,
                                         botao: 'mais'
                                         }; 
                            console.table(vData);
                            $.ajax({
                                       url: './mvc/model/ad_pedido_previa.php',
                                       dataType: 'html',
                                       type: 'POST',
                                       data: vData,
                                       beforeSend: function() {
                                           // document.getElementById('spinner').style='diplay:flex;';
                                       },
                                       success: function(html) {
                                       console.log(html)
                                        if(html == "Error: Produto não cadastrado"){
                                            document.getElementById('codigo').value ='';
                                            // alert(html);
                                        }else{
                                            document.getElementById('spinner').style='display:none;';
                                            document.getElementById('codigo').value ='';
                                            atualizar_previa();
                                            }

                                        },
                                       error: function(err) {
                                       document.getElementById('spinner').style='display:none;';
                                       },
                                   });
                            }
                        });

                        
                </script>

<script>

    $("#finaliza").click(function() {
        document.getElementById('spinner').style='display:flex;';
        $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
        var opcoesPagamento = document.getElementsByName('pgto');
        var algumSelecionado = false;
        // Iterar sobre os elementos de entrada de rádio
        for (var i = 0; i < opcoesPagamento.length; i++) {
            // Verificar se o rádio está marcado
            if (opcoesPagamento[i].checked) {
                // Exibir o valor selecionado
                algumSelecionado = true;
                // alert("Você selecionou: " + opcoesPagamento[i].value);
                tipopgto = opcoesPagamento[i].value
                // Você pode adicionar mais lógica aqui conforme necessário

                hashpagina =  document.getElementById("hash").value;
                document.getElementById('spinner').style='diplay:flex;';
                valor_pago_cliente = document.getElementById("valor_total").value
                var vData = {
                    hashpagina: hashpagina,
                    pgto:tipopgto,
                    valor_pago_cliente: valor_pago_cliente
                }; 
                console.table(vData);
                $.ajax({
                                       url: './mvc/model/ad_pedido_balcao.php',
                                       dataType: 'html',
                                       type: 'POST',
                                       data: vData,
                                       beforeSend: function() {
                                           // document.getElementById('spinner').style='diplay:flex;';
                                       },
                                       success: function(html) {
                                       console.table(html)
                                            document.getElementById('spinner').style='display:none;';
                                            location.reload();

                                        },
                                       error: function(err) {
                                       document.getElementById('spinner').style='display:none;';
                                       console.table(err)

                                    //    location.reload();

                                       },
                                   });
            }
        }
        if (!algumSelecionado) {
            alert("Selecionar a forma de pagamento antes de selecionar o Item")
            document.getElementById('spinner').style='display:none;'
            event.preventDefault();
        }    
    })

</script>                

<script type="text/javascript">
                    var var1 = document.getElementById("mensagem");
                    setTimeout(function() {
                        var1.style.display = "none";
                    }, 5000)
</script>

<!-- </form> -->

    </div>

 
<script>
    function atualizar_previa() {
            $("#div").load("./mvc/views/pedidoprevia.php");
    };
</script> 




<h1 class="col-xl-6 col-md-6 mb-4" id="div" > </h1>
</div>