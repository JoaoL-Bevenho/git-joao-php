<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
  $conn = new db_conn();
  $db_connection = $conn->connection();
  if(!isset($_SESSION['user_id'])) { echo "<script>location.href='login.php';</script>"; }
  else
  {
    // echo "<script>alert('Realize o login');</script>";
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      Agenda Local - Registros
    </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <!-- CSS Customizado Local Mobile -->
    <link href="css/local.css" type="text/css" rel="stylesheet">
    <!--Glyphicons-->
    <link href="glyph_css/glyph_bootstrap.css" type="text/css" rel="stylesheet"> <!-- http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" -->
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" type="text/css" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" type="text/css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" type="text/css" rel="stylesheet">
  </head>
  <body id="page-top">
    <?php
      if(!empty($_GET['modal_toshow']))
      {
        $modalToShow = $_GET['modal_toshow'];
        echo"<script> window.onload = function() { $('#".$modalToShow."').modal('show'); } </script>";
      }
    ?>
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top navLogoBar">

    

      <a class="navbar-brand mr-1" href="index.php">
        <img src="Agenda Local - PNG.png" class="imgLogo">
      </a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0 logoColor" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      </div>
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw logoColor"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right menuItemColor" aria-labelledby="userDropdown">
            <a class="dropdown-item menuItemColor" href="#" data-toggle="modal" data-target="#logoutModal">
              <span class="glyphicon glyphicon-log-out"></span>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div id="wrapper">

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a>
            </li>

            <li class="breadcrumb-item active">Anúncios Pendentes</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
          
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Status</th>
                      <th>Plano</th>
                      <th>Telefone</th>
                      <th>WhatsApp</th>
                      <th>Site</th>
                      <th>Endereço</th>
                      <th>Numero</th>
                      <th>Atividade</th>
                      <th>Menu</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Status</th>
                      <th>Plano</th>
                      <th>Telefone</th>
                      <th>WhatsApp</th>
                      <th>Site</th>
                      <th>Endereço</th>
                      <th>Numero</th>
                      <th>Atividade</th>
                      <th>Menu</th>

                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.usuario_anuncio WHERE usuario_anuncio.status!='Publicado'";
                      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
                      {
                        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                        {

                          echo '<tr>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["user_id"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["nome"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["status"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["tipo"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["telefone"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["whatsapp"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["site"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["endereco"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["numero"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["atividade"].'</td>';
                         
                

                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-ok'.'"'.'></span></a></td>';

                          echo '</tr>';
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        <footer>
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Todos os direitos reservados © <a href="http://www.agendalocal.com.br/" target="_blank">Agenda Local 2019</a></span>
            </div>
          </div>
        </footer>
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">Seleciona "Logout" abaixo se você deseja encerrar esta sessão.</div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="logoutSubmit" value="Logout"/>
              <input type="text" id="hiddenlogoutConfirm" name="hiddenlogoutConfirmar" value="logout" hidden/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenlogoutConfirmar'])))
            {
              session_destroy();
              echo "<script>location.href='login.php';</script>";
            }
          ?>
        </div>
      </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Aprovar Anúncio</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
           <center><button style="width:300px;" onclick="goAnunciante()"><span class="glyphicon glyphicon-user"></span> Consultar dados deste Anunciante</button></center>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
              Tem certeza que deseja continuar? <br/>
              Ao clicar em aprovar você confirma que este cliente realizou o pagamento, ele irá ser cadastrado na base de dados da cidade selecionada durante a inscrição. <br/>
              </div>
              <input id="id_input" name="id_input" hidden="hidden">
            </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Aprovar">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST"))
            {

              $use_id = $_POST['id_input'];
              $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.usuario_anuncio WHERE usuario_anuncio.user_id=".$use_id.";";
                      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
                      {
                        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                        {

                          $nome = $rowResultStmtSelectAllRegistros["nome"];
                          $telefone = $rowResultStmtSelectAllRegistros["telefone"];
                          $whatsapp = $rowResultStmtSelectAllRegistros["whatsapp"];
                          $site = $rowResultStmtSelectAllRegistros["site"];
                          $endereco = $rowResultStmtSelectAllRegistros["endereco"];
                          $numero = $rowResultStmtSelectAllRegistros["numero"];
                          $atividade = $rowResultStmtSelectAllRegistros["atividade"];
                          $status = $rowResultStmtSelectAllRegistros["status"];
                          $user_id = $rowResultStmtSelectAllRegistros["user_id"];
                          $id_cidade = $rowResultStmtSelectAllRegistros["id_cidade"];
                          $plano = $rowResultStmtSelectAllRegistros["tipo"];
                        }
                      }
                if($plano == "Ouro"){
                  $estrelas = 5;
                } else if ($plano == "Prata"){
                  $estrelas = 4;
                } else if ($plano == "Bronze"){
                  $estrelas = 3;
                } else {
                  $estrelas = 0;
                }
                $sqlStmtEditRegistro = "";
                $sqlTextEditRegistro = "UPDATE agendalocal.usuario_anuncio SET status='Publicado' WHERE user_id=".$use_id.";";//arrumar de onde vem esse user id
                $sqlStmtEditRegistro = $sqlTextEditRegistro;

              if($resultStmtEditRegistro = pg_prepare($db_connection,"",  $sqlStmtEditRegistro))
              {
                $resultStmtEditRegistro = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtEditRegistro)>0)
                {

                      $sqlTextInsertRegistro2 = "INSERT INTO agendalocal.clientes(id_cidade, id_tiporegistro, nome, telefone, endereco, numero, atividade, is_cliente, whatsapp, site, tipo, estrelas,id_anunciante,logomarca) VALUES(".$id_cidade.", 2, '".$nome."', '".$telefone."', '".$endereco."', '".$numero."', '".$atividade."', 0, '".$whatsapp."', '".$site."','".$plano."','".$estrelas."',".$use_id.",'');";
                        $sqlStmtEditRegistro2 = $sqlTextInsertRegistro2;

                        if($resultStmtEditRegistro2 = pg_prepare($db_connection,"",  $sqlStmtEditRegistro2))
                        {
                          $resultStmtEditRegistro2 = pg_execute($db_connection, "", array());
                          if(pg_affected_rows($resultStmtEditRegistro2)>0)
                          {
                              //onde vai colocar o codigo que insere esse cara nos anunciantes 2312
                            echo "<script>alert('Cadastro efetivado com sucesso!');</script>";
                            // echo "<script>location.href='pagamentos.php';</script>";
                          }
                          else
                          {
                            echo "<script>alert('Erro ao realizar cadastro.');</script>";
                          }
                        }
                        //fim da insercao
                }
                else
                {
                  echo "<script>alert('Erro ao realizar cadastro.');</script>";
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

   

    <!-- Mensagem Sucesso Modal -->
    <div class="modal fade" id="msgSucessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmação de <?php echo $_SESSION['ok_type']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-label-group">
                <?php echo $_SESSION['ok_msg']; ?><br/> Clica no botão abaixo para continuar.
              </div>
            </div>
          </div>
          <form method="POST">
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="msgSuccessSubmit"/>
              <input type="text" id="hiddenmsgsuccessSubmit" name="hiddenmsgSucessoSubmit"  value="success" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenmsgSucessoSubmit'])))
            { echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."';</script>"; }
          ?>
        </div>
      </div>
    </div>

    <!-- Alerta Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-overwrite">
          <div class="modal-header modal-header-overwrite error-msg">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Mensagem de Alerta</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-label-group">
                <?php echo $_SESSION['error_msg']; ?><br/> Clica no botão abaixo para continuar.
              </div>
            </div>
          </div>
          <form method="POST">
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="alertSubmit"/>
              <input type="text" id="hiddenalertSubmit" name="hiddenalertaSubmit"  value="error" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenalertaSubmit'])))
            { echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."';</script>"; }
          ?>
        </div>
      </div>
    </div>
  </body>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script type="text/javascript">


    function goAnunciante(){
      var id = document.getElementById('id_input').value;
      location.href = 'usuariospainel.php?id=' + id;
    }


    $(".spanViewLogo").click(function()
    {
      var $logoDir = $(this).closest("tr"),

      $tdRegistroLogoDiretorio = $logoDir.find("td:eq(7)");
      document.getElementById('recordlogoDirec').innerHTML = $tdRegistroLogoDiretorio.attr("value");
      document.getElementById('recordimglogoDirec').src = $tdRegistroLogoDiretorio.attr("value");
    });

    $(".spanEdit").click(function()
    {
      var $rowEdit = $(this).closest("tr"),

      $tdRegistroNomeEdit = $rowEdit.find("td:eq(0)");
      
      document.getElementById('id_input').value = $tdRegistroNomeEdit.text();
    });




    $(".spanDelete").click(function()
    {
      var $rowDelete = $(this).closest("tr"),

      $tdRegistroDelete = $rowDelete.find("td:eq(0)");
      document.getElementById('recordnameDelete').innerHTML = $tdRegistroDelete.text();
      document.getElementById('hiddenrecordidDelete').value = $tdRegistroDelete.attr("value");
      document.getElementById('hiddenrecordnameDelete').value = $tdRegistroDelete.text();

      $tdRegistroTelefoneDelete = $rowDelete.find("td:eq(1)");
      document.getElementById('recordtelephoneDelete').innerHTML = $tdRegistroTelefoneDelete.text();
      document.getElementById('hiddenrecordtelephoneDelete').value = $tdRegistroTelefoneDelete.text();

      $tdRegistroEnderecoDelete = $rowDelete.find("td:eq(2)");
      document.getElementById('recordaddressDelete').innerHTML = $tdRegistroEnderecoDelete.text();
      document.getElementById('hiddenrecordaddressDelete').value = $tdRegistroEnderecoDelete.text();

      $tdRegistroNumeroDelete = $rowDelete.find("td:eq(3)");
      document.getElementById('recordnumberDelete').innerHTML = $tdRegistroNumeroDelete.text();
      document.getElementById('hiddenrecordnumberDelete').value = $tdRegistroNumeroDelete.text();

      $tdTipoRegistroDelete = $rowDelete.find("td:eq(4)");
      document.getElementById('typerecordoptionsDelete').innerHTML = $tdTipoRegistroDelete.text();
      document.getElementById('hiddentyperecordoptionsDelete').value = $tdTipoRegistroDelete.attr("value");

      $tdRegistroAtividadeDelete = $rowDelete.find("td:eq(5)");
      document.getElementById('recordactivityDelete').innerHTML = $tdRegistroAtividadeDelete.text();
      document.getElementById('hiddenrecordactivityDelete').value = $tdRegistroAtividadeDelete.text();

      $tdRegistroIsClienteDelete = $rowDelete.find("td:eq(6)");
      document.getElementById('recordisclientDelete').innerHTML = $tdRegistroIsClienteDelete.text();
      document.getElementById('hiddenrecordisclientDelete').value = $tdRegistroIsClienteDelete.attr("value");
    });
    $('#dataTable').DataTable(
    {
      language:
      {
        processing:     "Processando...",
        search:         "Pesquisar",
        lengthMenu:     "Mostrar _MENU_ resultados por página",
        info:           "Mostrando _START_ até _END_ de _TOTAL_ registros",
        infoEmpty:      "Mostrando 0 até 0 de 0 registros",
        infoFiltered:   "(Filtrados de _MAX_ registros)",
        infoPostFix:    "",
        loadingRecords: "Carregando...",
        zeroRecords:    "Nenhum registro encontrado",
        emptyTable:     "Nenhum registro encontrado",
        paginate:
        {
          first:    "Primeiro",
          previous: "Anterior",
          next:     "Próximo",
          last:     "Último"
        },
        aria:
        {
          sortAscending:  ": Ordenar colunas de forma ascendente",
          sortDescending: ": Ordenar colunas de forma descendente"
        }
      }
    });
  </script>
</html>
