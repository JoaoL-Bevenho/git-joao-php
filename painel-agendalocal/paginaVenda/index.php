<?php
// phpinfo();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
    $conn=new db_conn();
    $db_connection = $conn->connection();
    $_SESSION["register_from"]="";

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Home</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Customizado Local Mobile -->
    <link href="css/local.css" type="text/css"rel="stylesheet">

    <!--Glyphicons-->
    <link href="glyph_css/glyph_bootstrap.css" type="text/css" rel="stylesheet"> <!-- http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" -->

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<?php
/// ******** carrega os planos nas textbox **********
  $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.planos WHERE planos.id=1";
  if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
  {
    $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
    while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
    {
      $plano1valor = $rowResultStmtSelectAllRegistros["plano1valor"];
      $plano2valor = $rowResultStmtSelectAllRegistros["plano2valor"];
      $plano3valor = $rowResultStmtSelectAllRegistros["plano3valor"];
    }
  }
?>



  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top navLogoBar">
      <a class="navbar-brand mr-1" href="index.php"><img src="Agenda Local - PNG.png" class="imgLogo"></a>
      <!-- Navbar Search -->
      <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
      <!-- Navbar -->
    </nav>
    <div id="wrapper">
      <div class="divHome">
        <div id="content-wrapper">
          <div class="container-fluid">
            <!-- Breadcrumbs-->

<!------ Include the above in your HEAD tag ---------->
<center><span class="subscript">Selecione um de nossos Planos</span></center>
<br/>
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-2">
      </div>
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Bronze</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                          <span class="subscript">R$</span>
                            <?php echo $plano3valor; ?><span class="subscript">/mês</span></h1>
<!--                         <small>1 month FREE trial</small> -->
                    </div>
                      <table class="table">
                        <tr>
                            <td>
                               Nome da empresa
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Endereço
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefone
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Posição em Ordem Alfabética
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="cadastro.php?id=Bronze" class="btn btn-success" role="button">Selecionar</a>
            </div>
        </div>
    </div>

        <div class="col-xs-12 col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Prata</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                           <span class="subscript">R$</span>
                            <?php echo $plano2valor; ?><span class="subscript">/mês</span></h1>
<!--                         <small>1 month FREE trial</small> -->
                    </div>
                                       <table class="table">
                        <tr>
                            <td>
                               Nome da empresa
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Endereço
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefone e WhatsApp
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Posição em Ordem Alfabética
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="cadastro.php?id=Prata" class="btn btn-success" role="button">Selecionar</a>
            </div>
        </div>
    </div>

        <div class="col-xs-12 col-md-3">
            <div class="panel panel-warning">
                <div class="cnrflash">

                </div>
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Ouro</h3>
                </div>
                <div class="panel-body">
                    <div class="the-price">
                        <h1>
                           <span class="subscript">R$</span>
                            <?php echo $plano1valor; ?><span class="subscript">/mês</span></h1>
<!--                         <small>1 month FREE trial</small> -->
                    </div>
                      <table class="table">
                        <tr>
                            <td>
                               Nome da empresa
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Endereço
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Telefone / WhatsApp / Link
                            </td>
                        </tr>
                        <tr class="active">
                            <td>
                                Posição privilegiada
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>
                                <span class="fa fa-star" style="color:#FFD700;"></span>            
                            </td>
                        </tr>
      
                    </table>
                </div>
                <div class="panel-footer">
                    <a href="cadastro.php?id=Ouro" class="btn btn-success" role="button">Selecionar</a>
                    </div>
            </div>
        </div>
</div>
</div>

            <!-- Sticky Footer -->
            <footer class="breadcrumb">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <span>Todos os direitos reservados ©
                    <a href="http://www.agendalocal.com.br/" target="_blank">Agenda Local 2019</a>
                  </span>
                </div>
              </div>
            </footer>
          </div>
        </div>
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
          <div class="modal-body">Seleciona "Logout" abaixo se você deseja encerrar esta sessão.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
  </body>
</html>
