<?php

include "./mvc/model/conexao.php";

$tab_produtos = "SELECT * FROM produtos ORDER BY `produtos`.`id` ASC ";

$produtos = mysqli_query($conn, $tab_produtos);
// print_r($produtos);
// exit();

?>

<h1 class="display-12">Receber Produtos</h1>

<div class="row">

<div class="d-flex justify-content-center">
            <div id="spinner" class="spinner-border text-primary" role="status" style="display: none;">
                <span class="sr-only">Loading...</span>
            </div>
    </div>


    <div class="col-4" id="mensagem" style="visibility: visible">
        <?php
			

			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
				
			}
			?>
    </div>

    <div class="col-6">
    </div>

    

</div>



<div class="form-group col-md-6">

<b><label for="">* Codigo:</label></b><input type="text" name="codigo" id="codigo" class="form-control" autofocus ></div>
   

<script>
                    
                    document.getElementById('codigo').addEventListener('input', function() {
                        var codigo = this.value;
                                            
                        var vData = {
                                     id: codigo,
                                     }; 
                        console.table(vData);
                        $.ajax({
                                   url: './mvc/model/ad_receber.php',
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
                                        atualizar_receber()
                                        }

                                    },
                                   error: function(err) {
                                   document.getElementById('spinner').style='display:none;';
                                   },
                               });
                    });
            </script>



<label></label>
<h4> Relação de Produtos :</h4>
<div class="table-responsive">

    <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0"
        width="100%">
        <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
        <thead>
            <tr>
                <th>Lista</th>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Estoque</th>
                <th>Detalhes</th>
                <th>Preço de Custo</th>
                <th>Preço de Venda</th>
                <th>Preço de Venda iFood</th>
                <th>Ação</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
                        // print_r($rows_produtos);
						$num +=1;
                    ?>

            <tr>
                <td><?php echo $num?></td>
                <td><?php echo ($rows_produtos['codigo'])?></td>
                <td><?php echo ($rows_produtos['nome'])?></td>
                <td><?php echo ($rows_produtos['categoria'])?></td>
                <td><?php echo ($rows_produtos['estoque_atual'])?></td>
                <td><?php echo ($rows_produtos['detalhes'])?></td>
                <td><?php echo ($rows_produtos['preco_custo'])?></td>
                <td><?php echo ($rows_produtos['preco_venda'])?></td>
                <td><?php echo ($rows_produtos['preco_venda_ifood'])?></td>
                <td>
                    <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal"
                        data-target="#myModal<?php echo $rows_produtos['id']; ?>">Visualizar</button>


                    <button type="button" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal"
                        data-target="#exampleModal" data-idproduto="<?php echo $rows_produtos['id']; ?>"
                        data-nomeproduto="<?php echo $rows_produtos['nome']; ?>"
                        data-detalhesproduto="<?php echo $rows_produtos['detalhes']; ?>"
                        data-codigoproduto="<?php echo $rows_produtos['codigo']; ?>"
                        data-categoriaproduto="<?php echo $rows_produtos['categoria']; ?>"
                        data-custoproduto="<?php echo $rows_produtos['preco_custo']; ?>"
                        data-precoproduto="<?php echo $rows_produtos['preco_venda']; ?>"
                        data-precoprodutoifood="<?php echo $rows_produtos['preco_venda_ifood']; ?>"
                        data-estoqueatualproduto="<?php echo $rows_produtos['estoque_atual']; ?>"
                        data-estoqueminimoproduto="<?php echo $rows_produtos['estoque_minimo']; ?>"
                        data-datacompraproduto="<?php echo $rows_produtos['data_compra']; ?>"
                        data-datavalidadeproduto="<?php echo $rows_produtos['data_validade']; ?>"
                        data-unidadeproduto="<?php echo $rows_produtos['unidade']; ?>"
                        data-marcaproduto="<?php echo $rows_produtos['marca']; ?>"
                        data-fornecedorproduto="<?php echo $rows_produtos['fornecedor']; ?>"
                        data-observacoesproduto="<?php echo $rows_produtos['observacoes']; ?>"
                        data-img="<?php echo $rows_produtos['img']; ?>"
                        data-srcimg="<?php echo "../../../cardapio-online/img/cardapio/cardapioonline/".$rows_produtos['img']; ?>"
                        >
                        Editar
                    </button>


                    <button type="button" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal"
                        data-target="#excluirModal<?php echo $rows_produtos['id']; ?>">Excluir</button>

                </td>
            </tr>
            <!-- CONSTRUÇÃO DO MODAL DE VIZUALIZAÇÃO -->
            <div class="modal fade bd-example-modal-xl" id="myModal<?php echo $rows_produtos['id']; ?>" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center" id="myModalLabel">
                                <b><?php echo $rows_produtos['nome']; ?></b>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <!-- FIM DO CABEÇALHO DO MODAL DE VIZUALIZAÇÃO -->

                        </div>
                        <div class="modal-body">
                            <p><b>ID do Produto: </b><?php echo $rows_produtos['id']; ?></p>
                            <p><b>Nome do Produto: </b><?php echo $rows_produtos['nome']; ?></p>
                            <p><b>Codigo: </b><?php echo $rows_produtos['codigo']; ?></p>
                            <p><b>Categoria: </b><?php echo $rows_produtos['categoria']; ?></p>
                            <p><b>Detalhe: </b><?php echo $rows_produtos['detalhes']; ?></p>
                            <p><b>Preço de Custo: </b><?php echo $rows_produtos['preco_custo']; ?></p>
                            <p><b>Preço de Venda: </b><?php echo $rows_produtos['preco_venda']; ?></p>
                            <p><b>Preço de Venda iFood: </b><?php echo $rows_produtos['preco_venda_ifood']; ?></p>
                            <p><b>Estoque Atual: </b><?php echo $rows_produtos['estoque_atual']; ?></p>
                            <p><b>Estoque Mínimo: </b><?php echo $rows_produtos['estoque_minimo']; ?></p>
                            <p><b>Data da Compra: </b><?php echo $rows_produtos['data_compra']; ?></p>
                            <p><b>Data de Validade: </b><?php echo $rows_produtos['data_validade']; ?></p>
                            <p><b>Fornecedor: </b><?php echo $rows_produtos['fornecedor']; ?></p>
                            <p><b>Observações/Ingredientes: </b><?php echo $rows_produtos['observacoes']; ?></p>

                        </div>
                    </div>
                    <!-- FIM DO CORPO DA MENSAGEM DO MODAL DE VIZUALIZAÇÃO -->
                </div>
            </div>


            <!-- CONSTRUÇÃO DO MODAL DE EXCLUZÃO -->
            <div class="modal fade bd-example-modal-xl" id="excluirModal<?php echo $rows_produtos['id']; ?>"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center" id="myModalLabel"><b>Excluir o Iten
                                    <?php echo $rows_produtos['id']; ?> da sua lista de Produtos?</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <!-- FIM DO CABEÇALHO DO MODAL DE EXCLUZÃO -->

                        </div>

                        <div class="modal-body">

                            <p><b>ID do Produto: </b><?php echo $rows_produtos['id']; ?></p>
                            <p><b>Nome do Produto: </b><?php echo $rows_produtos['nome']; ?></p>
                            <p><b>Codigo: </b><?php echo $rows_produtos['codigo']; ?></p>
                            <p><b>Categoria: </b><?php echo $rows_produtos['categoria']; ?></p>
                            <p><b>Detalhe: </b><?php echo $rows_produtos['detalhes']; ?></p>
                            <p><b>Preço de Custo: </b><?php echo $rows_produtos['preco_custo']; ?></p>
                            <p><b>Preço de Venda: </b><?php echo $rows_produtos['preco_venda']; ?></p>
                            <p><b>Preço de Venda iFood: </b><?php echo $rows_produtos['preco_venda_ifood']; ?></p>
                            <p><b>Estoque Atual: </b><?php echo $rows_produtos['estoque_atual']; ?></p>
                            <p><b>Estoque Mínimo: </b><?php echo $rows_produtos['estoque_minimo']; ?></p>
                            <p><b>Data da Compra: </b><?php echo $rows_produtos['data_compra']; ?></p>
                            <p><b>Data de Validade: </b><?php echo $rows_produtos['data_validade']; ?></p>
                            <p><b>Fornecedor: </b><?php echo $rows_produtos['fornecedor']; ?></p>
                            <p><b>Observações/Ingredientes: </b><?php echo $rows_produtos['observacoes']; ?></p>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                <a href="mvc/model/exclui_produtos.php?id=<?php echo $rows_produtos['id']; ?>"><button
                                        type="button" class="btn btn-xs btn-danger">Excluir</button></a>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- FIM DO CORPO DA MENSAGEM DO MODAL DE EXCLUZÃO -->

            </div>
</div>


<?php $index++;
									} ?>


</tbody>
</table>
</div>

<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-xl" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Produto</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<!-- CRIA O FORMULÁRIO PARA APRESENTRAÇÃO E ENVIA PELO METODO POST PARA O SCRIPT "edita_produtos.php" -->
				        <form method="POST" action="mvc/model/edita_produtos.php" enctype="multipart/form-data">
				        	<div class="row">
					          	<div class="form-group col-md-4">
					            	<label for="recipient-name" class="col-form-label">Código(Barras):</label>
					            	<input name="codigo" type="text" class="form-control" id="codigo">
					          	</div>
					          	<div class="form-group col-md-4">
					            	<label for="recipient-name" class="col-form-label">Nome:</label>
					            	<input  name="nome" type="text" class="form-control" id="recipient-name">
					          	</div>
					          	<div class="form-group col-md-4">
					            	<label for="message-text" class="col-form-label">Detalhes:</label>
					            	<input name="detalhes" type="text" class="form-control" id="detalhes-text">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Categoria:</label>
					            	<input  name="categoria" type="text" class="form-control" id="categoria">
					          	</div>	          				          			
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Preço de Custo:</label>
					            	<input name="preco_custo" type="text" class="form-control" id="preco-custo">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Preço de Venda:</label>
					            	<input  name="preco_venda" type="text" class="form-control" id="preco-venda">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Preço de Venda iFood:</label>
					            	<input  name="preco_venda_ifood" type="text" class="form-control" id="preco-venda-ifood">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Estoque Atual:</label>
					            	<input name="estoque_atual" type="text" class="form-control" id="estoque-atual">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Estoque Mínimo:</label>
					            	<input name="estoque_minimo" type="text" class="form-control" id="estoque-minimo">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Data da Compra:</label>
					            	<input name="data_compra" type="text" class="form-control"  id="data-compra">
					          	</div>	          				          			
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Data da Validade:</label>
					            	<input name="data_validade" type="text" class="form-control"  id="data-validade">
					          	</div>
					          	<div class="form-group col-md-2">
					            	<label for="recipient-name" class="col-form-label">Unidade (Kg/L):</label>
					            	<input name="unidade" type="text" class="form-control" id="unidade">
					          	</div>
					          	<div class="form-group col-md-4">
					            	<label for="recipient-name" class="col-form-label">Marca:</label>
					            	<input name="marca" type="text" class="form-control" id="marca">
					          	</div>
					          	<div class="form-group col-md-4">
					            	<label for="recipient-name" class="col-form-label">Fornecedor:</label>
					            	<input name="fornecedor" type="text" class="form-control" id="fornecedor">
					          	</div>	          				          			
					         		<div class="form-group col-md-12">
					            	<label for="message-text" class="col-form-label">Observação/Ingredientes:</label>
					            	<textarea name="observacoes" class="form-control" id="observacoes" ></textarea>
                                    <input id="img" name="img" type="hidden">
					          	</div>
                                  <div class="form-group col-md-12">
                                      <input type="file" id="imagemInput" accept="image/*" name="imgproduto">
                                    </div>
                                    <div class="form-group col-md-12">
                                   <img id="imgsrc" src="" alt="">
                                 </div>
                                
                                  <div class="form-group col-md-6">
                                      <div class="form-group col-md-4">
                                          <span id="remove_img" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_img(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                     <canvas id="canvas" style="max-width: 300px; display: none;"></canvas>
                                  </div>
                                
                                <script>
                                    const imagemInput = document.getElementById('imagemInput');
                                    const canvas = document.getElementById('canvas');
                                    
                                    imagemInput.addEventListener('change', function(event) {
                                        const file = event.target.files[0];
                                        
                                        if (file) {
                                            const reader = new FileReader();
                                            
                                            reader.onload = function(e) {
                                                const img = new Image();
                                                img.src = e.target.result;
                                                
                                                img.onload = function() {
                                                    const width = 400; // Defina a largura desejada
                                                    const height = 400; // Defina a altura desejada
                                                    
                                                    canvas.width = width;
                                                    canvas.height = height;
                                                    
                                                    const ctx = canvas.getContext('2d');
                                                    ctx.drawImage(img, 0, 0, width, height);
                                                    
                                                    canvas.style.display = 'block';
                                                };
                                            };
                                            
                                            reader.readAsDataURL(file);
                                        } else {
                                            canvas.style.display = 'none';
                                        }
                                        document.getElementById('remove_img').style = "display: flex!important;"
                                        document.getElementById('imgsrc').style = "display: none!important;"
                                    });
                                    
                                </script>

                                <script>
                                  function remove_img() {
                                    document.getElementById('canvas').value = ""
                                    document.getElementById('canvas').style = "display: none!important;"

                                    document.getElementById('imagemInput').value = ""
                                    
                                    document.getElementById('remove_img').value = ""
                                    document.getElementById('remove_img').style = "display: none!important;"
                                   
                                    document.getElementById('imgsrc').style = "display: flex!important;"


                                    }
                                </script>

					          </div>
				          <!--cria um campo invisivel "hidden" para pegar o id "id_Produto"-->
				          <input name="id" type="hidden" id="id_Produto">

					      <div class="modal-footer">
					        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
					        <button type="submit" class="btn btn-warning">Editar</button>
					      </div>

				        </form>
				      </div>
				    </div>
				  </div>
				</div>

				<script type="text/javascript">
	var var1= document.getElementById("mensagem");
	setTimeout(function() {var1.style.visibility = "hidden";},5000)
</script>


<!-- CRIA O SCRIPT JQUERY PARA TRATAR DOS DADOS QUE VEEM COM A CHAMADA DA REQUIZIÇÃO DO MODAL -->
<script type="text/javascript">
$('#exampleModal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal

  var recipient = button.data('idproduto')
  var recipientnome = button.data('nomeproduto')
  var recipientdetalhes = button.data('detalhesproduto')
  var recipientcodigo = button.data('codigoproduto')
  var recipientcategoria = button.data('categoriaproduto')
  var recipientcusto = button.data('custoproduto')
  var recipientvenda = button.data('precoproduto')
  var recipientestoqueatual = button.data('estoqueatualproduto')
  var recipientestoqueminimo = button.data('estoqueminimoproduto')
  var recipientdatacompra = button.data('datacompraproduto')
  var recipientdatavalidade = button.data('datavalidadeproduto')
  var recipientunidade = button.data('unidadeproduto')
  var recipientmarca = button.data('marcaproduto')
  var recipientfornecedor = button.data('fornecedorproduto')
  var recipientobservacoes = button.data('observacoesproduto')
  var recipientprecoprodutoifood = button.data('precoprodutoifood')
  var recipientimg = button.data('img')
  var recipientscr = button.data('srcimg')


  var modal = $(this)
  modal.find('.modal-title').text('Editar Produto ID:  ' + recipient)
  modal.find('#id_Produto').val(recipient)
  modal.find('#codigo').val(recipientcodigo)
  modal.find('#recipient-name').val(recipientnome)
  modal.find('#detalhes-text').val(recipientdetalhes)
  modal.find('#categoria').val(recipientcategoria)
  modal.find('#preco-custo').val(recipientcusto)
  modal.find('#preco-venda').val(recipientvenda)
  modal.find('#estoque-atual').val(recipientestoqueatual)
  modal.find('#estoque-minimo').val(recipientestoqueminimo)
  modal.find('#data-compra').val(recipientdatacompra)
  modal.find('#data-validade').val(recipientdatavalidade)
  modal.find('#unidade').val(recipientunidade)
  modal.find('#marca').val(recipientmarca)
  modal.find('#fornecedor').val(recipientfornecedor)
  modal.find('#observacoes').val(recipientobservacoes)
  modal.find('#preco-venda-ifood').val(recipientprecoprodutoifood)
  modal.find('#img').val(recipientimg)
  modal.find('#imgsrc').val(recipientscr)

  var imageElement = modal.find('#imgsrc');
  imageElement.attr('src', recipientscr);

})
</script>




<script>
$(document).ready(function() {
    $('#dtBasicExample').DataTable({
        "paging": true, // false to disable pagination (or any other option)
        "ordering": true, // false to disable sorting (or any other option)
        "searching": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
        }
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>

<script>
    function atualizar_receber() {
        location.reload()
    };
</script> 