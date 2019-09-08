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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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

        <div class="col-md-4">
          <form method="POST">
            <div class="modal-body">
            <div class="form-group">
              <div class="form-label-group">
                Nova Mensagem: <br/>
                <textarea name="tx_mensagem" rows="4" cols="55"></textarea>
              </div>
            </div>
          </div>
            <input id="id_input" name="id_input" hidden="hidden">
            <div class="modal-footer">
             <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="msgSuccessSubmit"/>
              <input type="text" id="hiddenmsgsuccessSubmit" name="hiddenmsgSucessoSubmit"  value="Ok" hidden/>
            </div>
          </form>
          <?php
           
           if(isset($_GET['id'])){
              $user_id = $_GET['id'];
            } else {
              $user_id = 0;
            }

            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['tx_mensagem'])))
            {
              $selected_user_id = $user_id;
              $mensagem = $_POST['tx_mensagem'];
              $datta = date('d-m-Y');

                $sqlStmtInsertUsuario = "INSERT INTO agendalocal.usuario_mensagem(user_id,mensagem,data)VALUES(".$selected_user_id.",'".$mensagem."','".$datta."')";
                if($resultStmtInsertUsuario = pg_prepare($db_connection,"",  $sqlStmtInsertUsuario))
                {
                  $resultStmtInsertUsuario = pg_execute($db_connection, "", array());

                   if(pg_affected_rows($resultStmtInsertUsuario)>0)
                  {
                    echo "<script>alert('Mensagem enviada com sucesso!');</script>";
                    echo "<script>location.href='tablemessage.php?id=".$user_id."';</script>";
                  }
                  else
                  {
                   echo "<script>alert('Falha ao enviar mensagem.');</script>";
                   echo "<script>location.href='tablemessage.php?id=".$user_id."';</script>";
                  }
                }
            }
          ?>

            <h5>Faturas e Mensagens</h5>
            <div style="overflow: scroll; height:300px;">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tr>
                 <th>Data</th>
                <th>Mensagem</th>
              </tr>
             
            <?php
            if(isset($_GET['id'])){
              $user_id = $_GET['id'];
            } else {
              $user_id = 0;
            }
            /// ******** carrega os planos nas textbox **********
            $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.usuario_mensagem WHERE usuario_mensagem.user_id='".$user_id."';";
            if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
            {
              $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
              while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
              {
                echo "<tr><td>".$rowResultStmtSelectAllRegistros["data"]."</td>";
                echo "<td>".$rowResultStmtSelectAllRegistros["mensagem"]."</td></tr>";
              }
            }

            ?>
            
          </table>
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
      document.getElementById('recordnameEdit').value = $tdRegistroNomeEdit.text();

      $tdRegistroTelefoneEdit = $rowEdit.find("td:eq(1)");
      document.getElementById('recordtelephoneEdit').value = $tdRegistroTelefoneEdit.text();

      $tdRegistroEnderecoEdit = $rowEdit.find("td:eq(2)");
      document.getElementById('recordaddressEdit').value = $tdRegistroEnderecoEdit.text();

      $tdRegistroNumeroEdit = $rowEdit.find("td:eq(3)");
      document.getElementById('recordnumberEdit').value = $tdRegistroNumeroEdit.text();

      $tdTipoRegistroEdit = $rowEdit.find("td:eq(4)");
      var $tdTipoRegistroEditValue =  $tdTipoRegistroEdit.text();
      for (var i=0; i <document.getElementById('typerecordoptionsEdit').length; i++)
      {
        var $typesRecordOption = document.getElementById('typerecordoptionsEdit')[i].text;
        if($typesRecordOption == $tdTipoRegistroEditValue)
        {
          document.getElementById('typerecordoptionsEdit').selectedIndex  = i;
          document.getElementById('hiddenrecordidEdit').value = $tdRegistroNomeEdit.attr("value");
        }
      }

      $tdRegistroAtividadeEdit = $rowEdit.find("td:eq(5)");
      document.getElementById('recordactivityEdit').value = $tdRegistroAtividadeEdit.text();

      $tdRegistroIsClienteEdit = $rowEdit.find("td:eq(6)");
      $tdRegistroIsClienteEditValue = $tdRegistroIsClienteEdit.attr("value");
      $recordIsClientRadBtn = document.getElementsByClassName('recordisclientEdit');
      for (var i = 0; i < $recordIsClientRadBtn.length; i++)
      {
        if ($recordIsClientRadBtn[i].value == $tdRegistroIsClienteEditValue)
        {
          $recordIsClientRadBtn[i].checked = true;
        }
        else
        {
          $recordIsClientRadBtn[i].checked = false;
        }
      }
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