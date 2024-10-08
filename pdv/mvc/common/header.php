<?php
session_start();
include('./mvc/model/conexao.php');

$login_usuario = $_SESSION['login'];

$usuario = $_SESSION['user'];

 $select_table = "SELECT * FROM cor c WHERE c.id_user = '$login_usuario'";
	$verifica_tabela = mysqli_query($conn, $select_table);
	while ($rows_cor = mysqli_fetch_assoc($verifica_tabela)) {
    $cor = $rows_cor['cor'];
  }
  
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Suprema Adega</title>

  <link href="mvc/common/css/animate.min.css" rel="stylesheet" />
  <!--ESTE COMANDO CRIA A NOTIFICAÇÃO ANIMADA  -->
  <link href="mvc/common/css/bootstrap-datepicker.css" rel="stylesheet" />

  <link rel="shortcut icon" href="mvc/common/img/suprema_adega.ico">
  <!--este comando muda o icone da janela-->

  <!-- Custom fonts for this template-->
  <link href="mvc/common/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">



  <!-- Custom styles for this template-->
  <link href="mvc/common/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa_Y_n8iDiTspZmmyPhbBWwDJ8IJbHtR8&callback=initMap" defer></script> -->
</head>


<!--INICIO DO BODY E INICIO DA CHAMADA DOS SCRIPTS JS!-->

<body id="page-top">

  <!-- INICIO DA CHAMADA DA CLASSE JQUERY-->
  <!-- Bootstrap core JavaScript-->
  <script src="mvc/common/vendor/jquery/jquery.min.js"></script>
  <script src="mvc/common/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="mvc/common/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="mvc/common/js/sb-admin-2.min.js"></script>
  <!-- FIM DA CHAMADA DA CLASSE JQUERY-->

  <script src="mvc/common/vendor/chart.js/Chart.min.js"></script>

  <script src="mvc/common/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="mvc/common/js/bootstrap-datepicker.min.js"></script>
  <script src="mvc/common/js/bootstrap-datepicker.pt-BR.min.js"></script>
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script> -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


  <!-- FIM DA CHAMADA DOS SCRIPTS JS!-->


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-<?php echo $cor ?> sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/mvc/?view=Dashboard1">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fa fa-desktop"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Menu</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->

      <!-- 
      <li class="nav-item active">
        <a class="nav-link"  href="/pdv/?view=Dashboard1">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Mesas</span></a>
      </li> -->

      <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=pedidoBalcao">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Novo Pedido</span></a>
      </li>

      <!-- <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=todosPedidoBalcao">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Ver Pedidos</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=Dashboard1">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Ver Pedidos - Mesas</span></a>
      </li> -->

      <!-- <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=delivery">
          <i class="fa fa-motorcycle"></i>
          <span>Novo Pedido - Delivery</span></a>
      </li> -->

      <!-- <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=pedidos_delivery">
          <i class="fa fa-motorcycle"></i>
          <span>Pedidos - Delivery</span></a>
      </li> -->


      <!-- Divider -->
      <!-- <hr class="sidebar-divider"> -->

      <!-- Heading -->
      <!-- <div class="sidebar-heading">
        Grupo 1
      </div> -->


      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>FERRAMENTAS</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Grupo de Ferramentas</h6>
            <a class="collapse-item" href="#" data-toggle="modal" data-target="#calculadora" style=" border-radius: 8px; font-size:18px;">Calculadora</a>
            <a class="collapse-item" href="/pdv/Agenda" style=" border-radius: 8px; font-size:18px;">Agenda</a>

          </div>
        </div>
      </li> -->

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>


      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>GERENCIAMENTO</span>
        </a>
        <!-- Para o item iniciara berta (class="collapse show")-->
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestão</h6>
            <a class="collapse-item" href="/pdv/?view=estoque" style=" border-radius: 8px; font-size:18px;">Estoque</a>
            <a class="collapse-item" href="/pdv/?view=financeiro" style=" border-radius: 8px; font-size:18px;">Financeiro</a>
            <!-- <a class="collapse-item" href="/pdv/?view=frete" style=" border-radius: 8px; font-size:18px;">Frete</a> -->
            <!-- <a class="collapse-item" href="/pdv/?view=geolocalizacao" style=" border-radius: 8px; font-size:18px;">Geolocalização</a> -->
            <!-- <a class="collapse-item" href="https://whatsapp-api-ph-b4d70f6eb4d2.herokuapp.com/" target="_blank" style=" border-radius: 8px; font-size:18px;">Conectar Whatsapp</a> -->
            <!-- <a class="collapse-item" href="/pdv/?view=cards" style=" border-radius: 8px; font-size:18px;">Pessoal</a> -->
            <a class="collapse-item" href="/pdv/?view=open" style=" border-radius: 8px; font-size:18px;">Abertura Caixa</a>
            <a class="collapse-item" href="/pdv/?view=exit" style=" border-radius: 8px; font-size:18px;">Fechamento Caixa</a>
            <a class="collapse-item" href="/pdv/?view=visualiza_caixa" style=" border-radius: 8px; font-size:18px;">Visualizar Caixa</a>
            <a class="collapse-item" href="/pdv/?view=produtos" style=" border-radius: 8px; font-size:18px;">Vendas Produtos</a>
            <a class="collapse-item" href="/pdv/?view=despesas" style=" border-radius: 8px; font-size:18px;">Add Despesas</a>
            <a class="collapse-item" href="/pdv/?view=fiado" style=" border-radius: 8px; font-size:18px;">Fiados</a>
            <!-- <a class="collapse-item" href="/pdv/?view=ponto" style=" border-radius: 8px; font-size:18px;">Ponto</a> -->

          </div>
        </div>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=tabela">
          <i class="fas fa-fw fa-table"></i>
          <span>Produtos</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <!-- <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=clientes">
          <i class="fas fa-fw fa-user"></i>
          <span>Clientes</span></a>
      </li> -->
      <!-- <li class="nav-item active">
        <a class="nav-link" href="/pdv/?view=cnpjPix">
          <i class="fas fa-fw fa-user"></i>
          <span>CNPJ - PIX</span></a>
      </li> -->



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            </li>

            <!-- Nav Item - Alerts -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="mvc/common/img/User.png">
                <label style="width: 15px;"></label>
                <span class="text-center" style=" font-size: 25px; color: #888888;"><b><?php echo $usuario; ?></b></span>

              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a style=" font-size: 20px; color: #888888;" class="dropdown-item" href="#" data-toggle="modal" data-target="#CadastroModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cadastrar Usuario
                </a>

                <a style=" font-size: 20px; color: #888888;" class="dropdown-item" href="#" data-toggle="modal" data-target="#ConfiguraçaoModal">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Configuração
                </a>

                <div class="dropdown-divider"></div>
                <a style=" font-size: 20px; color: #888888;" class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">



          <!-- Modal -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="color: red;"><b>Sair do Sistema</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5 class="text-center"><b>Tem Certeza que deseja Sair do Sistema?</b></h5>
                </div>
                <div class="modal-footer">
                  <form method="POST" action="../pdv/mvc/model/logout.php">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim!</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <!-- Modal -->
          <div class="modal fade" id="ConfiguraçaoModal" tabindex="-1" role="dialog" aria-labelledby="ConfiguraçaoModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="color: red;"><b>Configurações</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <h5 style="padding: 5%;" class="text-center"><b> Defina a cor das abas:</b></h5>
                  <div class="text-center">
                    <form method="POST" action="../pdv/mvc/model/cor_e_quantidade_de_mesas.php">
                      <input type="radio" name="cor" value="1">&nbsp;&nbsp;VERDE &nbsp;&nbsp;
                      <input type="radio" name="cor" value="2">&nbsp;&nbsp;VERMELHO &nbsp;&nbsp;
                      <input type="radio" name="cor" value="3">&nbsp;&nbsp;AMARELO &nbsp;&nbsp;
                      <input type="radio" name="cor" value="4">&nbsp;&nbsp;CIANO &nbsp;&nbsp;
                      <input type="radio" name="cor" value="5">&nbsp;&nbsp;AZUL &nbsp;&nbsp;
                      <hr>

                      <h5 style="padding: 5%;" class="text-center"><b> Defina a quantidade de Mesas do seu estabelecimento:</b></h5>
                      <input class="text-center" type="number" name="mesas">
                      <input class="text-center" type="hidden" name="login_usuario" value="<?php echo $login_usuario ?>">


                  </div>
                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger">Definir</button>
                  </form>
                </div>
              </div>
            </div>
          </div>




          <!-- Modal -->
          <div class="modal fade" id="CadastroModal" tabindex="-1" role="dialog" aria-labelledby="CadastroModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="color: red;"><b>Configurações</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <h5>Preencha os campos abaixo com um Login e uma senha, depois escreva uma pergunta que só você saiba responder. Ela será usada como segurança para que voçê possa recuperar sua senha </h5>

                  <form method="POST" action="cadastrar_administrador.php">
                    <label></label>
                    <input name="login" type="text" class="form-control text-center" placeholder="LOGIN">
                    <label></label>
                    <input name="senha" type="text" class="form-control text-center" placeholder="SENHA">
                    <label></label>
                    <textarea name="pergunta" type="text" class="form-control text-center" placeholder="Escreva uma pergunta"></textarea>
                    <label></label>
                    <input name="resposta" type="text" class="form-control text-center" placeholder="RESPOSTA">
                    <input name="nivel" type="hidden" value="2">


                </div>

                <div class="modal-footer">

                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-danger">Cadastrar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <!-- NESSA PARTE FICA O CONTEÚDO DA PÁGINA -->
          <!-- FOOTER -->