<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', 0); //oculta  erros

$escolha = $_POST['escolha'];

if (isset($escolha)) {

	if ($escolha == 1) { ?>

		<h1 class="text-center">Controle Financeiro</h1>

		<h4 class="text-center" style="padding: 3%;">Selecione abaixo o mês e o ano que deseja consultar !</h4>
		<hr>
		<div class="text-center" style="font-size: 20px;">
			<form method="POST" action="">
				<input type="radio" name="mes" value="01"> Janeiro &nbsp;&nbsp;
				<input type="radio" name="mes" value="02"> Fevereiro &nbsp;&nbsp;
				<input type="radio" name="mes" value="03"> Março &nbsp;&nbsp;
				<input type="radio" name="mes" value="04"> Abril &nbsp;&nbsp;
				<input type="radio" name="mes" value="05"> Maio &nbsp;&nbsp;
				<input type="radio" name="mes" value="06"> Junho &nbsp;&nbsp;
				<input type="radio" name="mes" value="07"> Julho &nbsp;&nbsp;
				<input type="radio" name="mes" value="08"> Agosto &nbsp;&nbsp;
				<input type="radio" name="mes" value="09"> Setembro &nbsp;&nbsp;
				<input type="radio" name="mes" value="10"> Outubro &nbsp;&nbsp;
				<input type="radio" name="mes" value="11"> Novembro &nbsp;&nbsp;
				<input type="radio" name="mes" value="12"> Dezembro &nbsp;&nbsp;<br><br>
				<input type="hidden" name="escolha" value="4">
				Ano:&nbsp;&nbsp;<input class="text-center" style="color: #858796; width: 100px;" type="text" name="ano" value="<?php echo date('Y') ?>">
		</div>
		<hr>

		<div style="padding: 3%;" class="text-center"><input class="btn btn-outline-info" type="submit" value="Selecionar Mês"></div>
		</form>

		<form class="text-center" method="POST" action="">
			<input class="btn btn-danger btn-sm" type="submit" value="VOLTAR">

		</form>

	<?php }
	if ($escolha == 2) {
		$data = date('d/m/Y');

	?>

		<h1 class="text-center">Controle Financeiro</h1>

		<hr>

		<h4 class="text-center" style="padding: 3%;">Click no botão abaixo para adicionar uma nova Despesa !</h4>


		<h3 style="padding: 3%;" class="text-center"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal" data-data="<?php echo $data; ?>">Adicionar Despesa</button></h3>

		<form class="text-center" method="POST" action="">
			<input class="btn btn-danger btn-sm" type="submit" value="VOLTAR">
		</form>

		<div class="modal fade bd-example-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Adicione sua Despesa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form method="POST" action="mvc/model/despesa.php">
							<div class="row">

								<div class="form-group col-md-8">
									<label for="message-text" class="col-form-label">Despesa:</label>
									<input required= "" value="" name="despesa" id="despesa" class="form-control"></input>
								</div>

								 <div class="form-group col-md-2">
									<label for="message-text" class="col-form-label">Data</label>
									<input name="data" id="data" type="text" class="form-control">
								</div>

								<div class="form-group col-md-2">
									<label for="message-text" class="col-form-label">Valor</label>
									<input required= "" value="" placeholder="R$" name="valor" id="valor" type="text" class="form-control">
								</div>

							</div>


					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Adicionar</button>
					</div>

					</form>

				</div>
			</div>
		</div>


		<!-- CRIA O SCRIPT JQUERY PARA TRATAR DOS DADOS QUE VEEM COM A CHAMADA DA REQUIZIÇÃO DO MODAL -->
		<script type="text/javascript">
			$('#exampleModal').on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) // Button that triggered the modal

				var data = button.data('data')

				var modal = $(this)

				modal.find('#data').val(data)

			})
		</script>


	<?php
	}
	if ($escolha == 3) {
		$data = date('d/m/Y');

		include "./mvc/model/conexao.php";
		$tab_pgto = "SELECT * FROM `forma_pagamento` ORDER by id ASC" ;
		$pgto = mysqli_query($conn, $tab_pgto);
		
	?>


		<h1 class="text-center">Controle Financeiro</h1>

		<hr>

		<h4 class="text-center" style="padding: 3%;">Click no botão abaixo para adicionar uma nova Entrada !</h4>

		<h3 style="padding: 3%;" class="text-center"><button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal" data-data="<?php echo $data; ?>">Adicionar Entrada</button></h3>

		<form class="text-center" method="POST" action="">
			<input class="btn btn-danger btn-sm" type="submit" value="VOLTAR">
		</form>

		<div class="modal fade bd-example-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Adicione sua Entrada</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form method="POST" action="mvc/model/rendimento.php">
							<div class="row">

								<div class="form-group col-md-4">
									<label for="message-text" class="col-form-label">Rendimento Mesa ou Balcão:</label>
									<input required= "" value="" name="rendimento" id="rendimento" class="form-control"></input>
								</div>
								<div class="form-group col-md-4">
								<label for="message-text" class="col-form-label">Forma de Pagamento:</label>

									<select style="width: 70%"  class="js-example-basic-single form-control" name="pgto" id="pgto" value="" required>
										<?php while ($rows_pgto = mysqli_fetch_assoc($pgto)) {
											?>
											<option value=""></option>
											<option value="<?php echo $rows_pgto['value']?>">
											<?php 
												echo  $rows_pgto['tipo']
											?> 
											</option>
											
											<?php
											
										}
										?>
									</select>
										<script>
											
										// In your Javascript (external .js resource or <script> tag)
										$(document).ready(function() {
											$('.js-example-basic-single').select2({
												width: 'resolve',
												dropdownAutoWidth: true,
												tags: true,
												placeholder: "Selecionar a forma de pagamento",
												allowClear: true,
												theme: "classic"
											});
										});   

										</script>
								</div>

								<div class="form-group col-md-4">
									<label for="message-text" class="col-form-label">Cliente:</label>
									<input required= "" value="" name="cliente" id="cliente" class="form-control"></input>
								</div>

								 <div class="form-group col-md-2">
									<label for="message-text" class="col-form-label">Data</label>
									<input name="data" id="data" type="text" class="form-control">
								</div>

								<div class="form-group col-md-2">
									<label for="message-text" class="col-form-label">Valor</label>
									<input required= "" value="" placeholder="R$" name="valor" id="valor" type="text" class="form-control">
								</div>

							</div>


					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Adicionar</button>
					</div>

					</form>

				</div>
			</div>
		</div>


		<!-- CRIA O SCRIPT JQUERY PARA TRATAR DOS DADOS QUE VEEM COM A CHAMADA DA REQUIZIÇÃO DO MODAL -->
		<script type="text/javascript">
			$('#exampleModal').on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) // Button that triggered the modal

				var data = button.data('data')

				var modal = $(this)

				modal.find('#data').val(data)

			})
		</script>


	<?php
	}
	if ($escolha == 4) {

		include "./mvc/model/conexao.php";



		$mes = $_POST['mes'];
		$ano = $_POST['ano'];
		$mes = "$mes" . '/' . "$ano";
		$mes_despesa = $_POST['ano'] . '-' . $_POST['mes'];


	?>
		<h1 class="text-center" style="color: green; height: 50px;">Resultados para <?php echo "$mes"; ?></h1>
		<form style="padding: 10px;" class="text-center" method="POST" action="">
			<input type="hidden" name="escolha" value="1">
			<input class="btn btn-danger btn-icon-split  btn-sm" type="submit" value="VOLTAR">

		</form>
		<?php

		$tab_vendas = "SELECT *, v.id as id_venda FROM vendas v WHERE data LIKE '%$mes%'";
		$vendas = mysqli_query($conn, $tab_vendas);

		$tab_despesas = "SELECT * FROM despesas WHERE data LIKE '%$mes%'";
		$despesas = mysqli_query($conn, $tab_despesas);

		echo "<hr>"; ?>

		<h3 class="text-center" style="color: green; height: 50px;">Rendimentos</h3>

		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th class="text-center">Data</th>
					<th class="text-center">Pedido</th>
					<th class="text-center">Imprimir</th>
					<th class="text-center">Visualizar Pedido</th>
					<th class="text-center">Rendimento</th>
					<th class="text-center">Valor Venda</th>
					<th class="text-center">Valor Receber</th>
					<th class="text-center">Pagamento</th>
					<th class="text-center">Categoria</th>
				</tr>
			</thead>
			<tbody>



				<?php

				$total1 = 0;
				$total3 = 0;


				while ($rows_vendas = mysqli_fetch_assoc($vendas)) {

					 $id = $rows_vendas['id'];
					 $id_venda = $rows_vendas['id_venda'];
					$data = $rows_vendas['data'];

					$rendimento = $rows_vendas['rendimento'];

					$valor = $rows_vendas['valor'];
					$valor_maquina = $rows_vendas['valor_maquina'];
					$pgto = $rows_vendas['pgto'];
					$pedido = $rows_vendas['id_pedido'];
					$total1 += $valor;
					$total3 += $valor_maquina;

					if( $valor_maquina == 0 ){
						$soma[] = $valor;
					   
				   }else{
					   $soma[] = $valor_maquina;
					$total4 += $valor_maquina-$valor;
					   
				   }

				   $valor4 = array_sum($soma);
				?>

					<tr>
						<td class="text-center"><b><?php echo $data; ?></b></td>
						<td class="text-center"><b><?php echo $pedido; ?></b></td>
						<td class="text-center">
							<form method="POST" action="/pdv/mvc/model/imprimir.php" target="_blank">
								<input name="id" type="hidden" value="<?php echo $pedido ? $pedido : $id_venda ; ?>">
								<input name="cliente" type="hidden" value="<?php echo $cliente; ?>">
								<input name="pgto" type="hidden" value="<?php echo $pgto; ?>">
								<button type="submit" class="btn btn-outline-success">Imprimir</button>
							</form>
						</td>
						<td class="text-center">
							<form method="POST" action="?view=adicionar_pedido_balcao" target="_blank">
								<input name="id" type="hidden" value="<?php echo $pedido ? $pedido : $id_venda ; ?>">
								<input name="cliente" type="hidden" value="<?php echo $cliente; ?>">
								<input name="pgto" type="hidden" value="<?php echo $pgto; ?>">
								<button type="submit" class="btn btn-outline-success">Visualizar</button>
							</form>
						</td>
						<td class="text-center"><?php echo $rendimento; ?></td>
						<td class="text-center" style="color: green;">R$ <?php echo number_format($valor, 2); ?></td>
						<?php
						
							if( $valor_maquina == 0 ){
								?><td class="text-center" style="color: green;">R$ <?php echo number_format($valor, 2); ?></td><?php
							}else{
								?><td class="text-center" style="color: green;">R$ <?php echo number_format($valor_maquina, 2); ?></td><?php
							}
						?>
						<td class="text-center" style="color: blue;"><?php echo $pgto; ?></td>
						<td class="text-center">
							<div style="width: 100%; color: green;">Rendimento</div>
						</td>
						<td class="text-center">
							<div type="button" style=" color: red;" data-toggle="modal" data-target="#modal_exclui_proventos" data-rendimento="<?php echo $rendimento; ?>" data-cliente="<?php echo $cliente; ?>" data-data="<?php echo $data; ?>" data-valor="<?php echo number_format($valor, 2); ?>" data-id="<?php echo $id_venda; ?>"><b>X</b></div>
						</td>
					</tr>

				<?php
				}

				?>

				<tr>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					
				</tr>

				<tr>
					<td class="text-center">
						<h4 style="width: 100%; color: green;"><b>Total:</b></h4>
					</td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					

					<td class="text-center">
						<h4 style="width: 100%; color: green;"><b>R$ <?php echo number_format($total1, 2); ?></b></h4>
					</td>
					<td class="text-center">
						<h4 style="width: 100%; color: green;"><b>R$ <?php echo number_format($valor4, 2); ?></b></h4>
					</td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
				</tr>

			</tbody>
		</table>

		<?php echo "<hr>"; ?>

		<h3 class="text-center" style="color: red; height: 50px;">Despesas</h3>

		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th class="text-center">Data</th>
					<th class="text-center">Despesa</th>
					<th class="text-center">Valor</th>
					<th class="text-center">Categoria</th>
					<td class="text-center"></td>
					<td class="text-center"></td>
				</tr>
			</thead>
			<tbody>

				<?php

				$total2 = 0;

				while ($rows_despesas = mysqli_fetch_assoc($despesas)) {

					$id2 = $rows_despesas['id'];
					$data2 = $rows_despesas['data'];
					$despesa2 = $rows_despesas['despesa'];
					$valor2 = $rows_despesas['valor'];
					$total2 += $valor2;

				?>

					<tr>
						<td class="text-center"><b><?php echo $data2; ?></b></td>
						<td class="text-center"><b><?php echo $despesa2; ?></b></td>
						<td class="text-center" style="color: red;">R$ -<?php echo number_format($valor2, 2); ?></td>
						<td class="text-center">
							<div style="width: 100%; color: red;">Despesa</div>
						</td>
						<td class="text-center"></td>
						<td class="text-center">
							<div type="button" style=" color: red;" data-toggle="modal" data-target="#modal_exclui_despesas" data-despesa="<?php echo $despesa2; ?>" data-categoria="Despesa" data-data="<?php echo $data; ?>" data-valor="<?php echo number_format($valor2, 2); ?>" data-id="<?php echo $id2; ?>"><b>X</b></div>
						</td>
					</tr>
				<?php
				}

				?>

				<tr>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
				</tr>

				<tr>
					<td class="text-center">
						<h4 style="width: 100%; color: red;"><b>Total:</b></h4>
					</td>
					<td class="text-center"></td>
					<td class="text-center">
						<h4 style="width: 100%; color: red;"><b>R$ -<?php echo number_format($total2, 2); ?></b></h4>
					</td>
					<td class="text-center"></td>
					<td class="text-center"></td>
					<td class="text-center"></td>
				</tr>

			</tbody>
		</table>

		<div class="modal fade bd-example-modal" id="modal_exclui_proventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" style="color: red;">Tem certeza que deseja Excluir Receita ?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form method="POST" action="mvc/model/exclui_rendimento.php">
							<div class="row">
								<div class="form-group col-md-4">
									<label for="message-text" class="col-form-label text-center">Rendimento</label>
									<input name="rendimento" id="rendimento" type="text" class="form-control">
								</div>

								<div class="form-group col-md-8">
									<label for="message-text" class="col-form-label text-center">Cliente</label>
									<input name="cliente" id="cliente" type="text" class="form-control">
								</div>

								<div class="form-group col-md-6">
									<label for="message-text" class="col-form-label text-center">Data</label>
									<input name="data" id="data" type="text" class="form-control">
								</div>

								<div class="form-group col-md-6">
									<label for="message-text" class="col-form-label text-center">Valor(R$)</label>
									<input name="valor" id="valor" type="text" class="form-control">
								</div>
							</div>
					</div>

					<div class="modal-footer">
						<input name="id" id="id" type="hidden" class="form-control">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Excluir</button>

					</div>
					</form>


				</div>
			</div>
		</div>

		<div class="modal fade bd-example-modal" id="modal_exclui_despesas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" style="color: red;">Tem certeza que deseja Excluir Despesa ?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">

						<form method="POST" action="mvc/model/exclui_despesas.php">
							<div class="row">

								<div class="form-group col-md-8">
									<label for="message-text" class="col-form-label text-center">Despesa</label>
									<input name="despesa" id="despesa" type="text" class="form-control">
								</div>

								<div class="form-group col-md-4">
									<label for="message-text" class="col-form-label text-center">Categoria</label>
									<input name="categoria" id="categoria" type="text" class="form-control">
								</div>

								<div class="form-group col-md-6">
									<label for="message-text" class="col-form-label text-center">Data</label>
									<input name="data" id="data" type="text" class="form-control">
								</div>

								<div class="form-group col-md-6">
									<label for="message-text" class="col-form-label text-center">Valor(R$)</label>
									<input name="valor" id="valor" type="text" class="form-control">
								</div>
							</div>

					</div>

					<div class="modal-footer">
						<input name="id" id="id" type="hidden" class="form-control">

						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Excluir</button>

					</div>
					</form>

				</div>
			</div>
		</div>

		<!-- CRIA O SCRIPT JQUERY PARA TRATAR DOS DADOS QUE VEEM COM A CHAMADA DA REQUIZIÇÃO DO MODAL -->
		<script type="text/javascript">
			$('#modal_exclui_proventos').on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) // Button that triggered the modal

				var id = button.data('id')
				var rendimento = button.data('rendimento')
				var cliente = button.data('cliente')
				var data = button.data('data')
				var valor = button.data('valor')

				var modal = $(this)

				modal.find('#id').val(id)
				modal.find('#rendimento').val(rendimento)
				modal.find('#cliente').val(cliente)
				modal.find('#data').val(data)
				modal.find('#valor').val(valor)

			})
		</script>


		<script type="text/javascript">
			$('#modal_exclui_despesas').on('show.bs.modal', function(event) {

				var button = $(event.relatedTarget) // Button that triggered the modal

				var id = button.data('id')
				var despesa = button.data('despesa')
				var categoria = button.data('categoria')
				var data = button.data('data')
				var valor = button.data('valor')

				var modal = $(this)

				modal.find('#id').val(id)
				modal.find('#despesa').val(despesa)
				modal.find('#categoria').val(categoria)
				modal.find('#data').val(data)
				modal.find('#valor').val(valor)

			})
		</script>


		<?php

		echo "<hr>";

		 $saldo = $total1 - $total3;
		
		// echo $total1;
		// echo "<br>";
		// echo $total3;
		// echo "<br>";
		// echo $total2;

		if ($saldo > 0) {
		?>

			<h2 class="text-center" style="color: green; height: 50px;"><b>Saldo Vendas: R$ <?php echo number_format($total1, 2); ?></b></h2>
			<h2 class="text-center" style="color: green; height: 50px;"><b>Venda Maquininha: R$ <?php echo number_format($total3, 2); ?></b></h2>
			<h2 class="text-center" style="color: green; height: 50px;"><b>Valor à Receber: R$ <?php echo number_format($valor4, 2); ?></b></h2>
			<h2 class="text-center" style="color: red; height: 50px;"><b>Desconto Maquininha: R$ <?php echo number_format($total4, 2); ?></b></h2>
			<?php
				if( $total2 == 0 ){
				}else{

					?><h2 class="text-center" style="color: red; height: 50px;"><b>Saldo Atual C/ À Despesas: R$ <?php echo number_format($saldo - $total2, 2); ?></b></h2><?php
				} 
			?>

		<?php
		} else {
		?>

			<h2 class="text-center" style="color: red; height: 50px;"><b>Saldo: R$ <?php echo number_format($saldo, 2); ?></b></h2>

	<?php
		}
	}
} else {

	?>
	<div class="row">
		<div class="col-8"></div>
		<div class="col-4 text-center" id="mensagem" style="visibility: visible"> <?php


																					if (isset($_SESSION['msg'])) {
																						echo $_SESSION['msg'];
																						unset($_SESSION['msg']);
																					}
																					?></div>
	</div>

	<h1 style="padding: 5%; font-size: 60px;" class="text-center">Gestão Financeira</h1>



	<div class="text-center">

		<form style="padding: 1%;" method="POST" action="">
			<input type="hidden" name="escolha" value="1">
			<input style="font-size: 30px;" class="btn btn-info" type="submit" value="Resultados">
		</form>

		<form style="padding: 1%;" method="POST" action="">
			<!-- <input type="hidden" name="escolha" value="2"> -->
			<!-- <input style="font-size: 30px;" class="btn btn-danger" type="submit" value="Adicionar Despesas"> -->
		</form>

		<form style="padding: 1%;" method="POST" action="">
			<input type="hidden" name="escolha" value="3">
			<input style="font-size: 30px;" class="btn btn-success" type="submit" value="Adicionar Entradas">
		</form>

	</div>



	<script type="text/javascript">
		var var1 = document.getElementById("mensagem");
		setTimeout(function() {
			var1.style.visibility = "hidden";
		}, 5000)
	</script>
<?php

}
?>