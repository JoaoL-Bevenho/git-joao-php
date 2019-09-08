<?php
  include("php/db_config.php");
  session_start();
  $conn=new db_conn();
  $db_connection = $conn->connection();
  $result="";
  $insert_msg="";

  if(isset($_GET['id'])){
    $plano = $_GET['id'];
  }
  ?>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- CSS Customizado Local Mobile -->
    <link href="css/local.css" type="text/css" rel="stylesheet">


    <?php
    /// ******** carrega os planos nas textbox **********
      $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.planos WHERE planos.id=1";
      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
      {
        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
        {
          $plano1link = $rowResultStmtSelectAllRegistros["plano1link"];
          $plano2link = $rowResultStmtSelectAllRegistros["plano2link"];
        }
      }
    ?>

  </head>

  <body class="bg-dark bg-overwrite">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Forma de pagamento</div>
          <div class="card-body">
            <div class="form-group">
              <div class="form-row">
              Sua conta foi criada com sucesso! Para poder publicar seu anúncio, realize a assinatura do nosso plano no botão do PagSeguro abaixo,
              assim que o pagamento for identificado sua conta será ativa.
            </div>
            <div class="form-row">
              &ensp;&ensp;
            </div>

              <div class="form-row">
              Escolha uma forma de pagamento:
              </div>

              <div class="form-row">
                &ensp;&ensp;
              </div>

              <div class="form-row">
                <?php
                if($plano == "Ouro"){
                  echo $plano1link;
                } else if ($plano == "Prata"){
                  echo $plano2link;
                }
                ?>
              </div>
            </div>

          <!-- <center> -->
            <!-- <a href="pagamento.php" class="btn btn-primary btn-block btn-primary-overwrite">Finalizar</a> -->
          <!-- </center> -->



      </div>
    </div>
    <div class="container container-overwrite">
      <img src="Agenda Local - PNG.png" class="imgLogo imgLogo-overwrite">
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>
</html>
