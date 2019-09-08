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

            <li class="breadcrumb-item active">DashBoard</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <form method="post">


                <div class="container">
                   <div class="form-row">
                    <div class="col-md-3">

                    <?php


                    $user_email = "";
                    $user_id = $_SESSION['user_id'];
                    $user_nome = "";

                    $sqlStmtCheckLogin="SELECT * FROM agendalocal.usuarios WHERE usuarios.id_usuario='".$_SESSION['user_id']."';";
                    if($resultStmtCheckLogin = pg_prepare($db_connection,"",  $sqlStmtCheckLogin))
                    {
                      $resultStmtCheckLogin = pg_execute($db_connection, "", array());
                      if($rowResultStmtCheckLogin = pg_fetch_array($resultStmtCheckLogin))
                      {
                        $sqlStmtSelectNivelAcesso="";
                        $result="";
                        $login_msg="";
                        $user_email = $rowResultStmtCheckLogin["email"];
                        $user_nome = $rowResultStmtCheckLogin["snome"];
                      }
                      else
                      {
                        $result="Usuário ou senha errada! Tente novamente!";
                        $login_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
                      }
                    }



                    /// ******** carrega os planos nas textbox **********
                      $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.usuario_anuncio WHERE usuario_anuncio.user_id='".$user_id."';";
                      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
                      {
                        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                        {
                          echo "<h5>Detalhes da conta:</h5>";
                          echo "Usuário: ";
                          echo $user_email;
                          echo "<br/>";
                          echo "Plano: ";
                          echo $rowResultStmtSelectAllRegistros["tipo"];
                          $plano = $rowResultStmtSelectAllRegistros["tipo"];
                          echo "<br/>";
                          echo '<a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'senhaModal'.'"'.'> Mudar Senha <span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a>';
                          echo "<br/>";
                          echo "<br/>";
                          echo "<h5>Detalhes do Anúncio</h5>";
                          echo "Status:";
                          echo $rowResultStmtSelectAllRegistros["status"];
                          $status = $rowResultStmtSelectAllRegistros["status"];
                          echo "<br/>";
                          echo '<a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'> Visualizar / Modificar Anúncio <span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a>';

                        }
                      }
                    ?>

                    </div>

                    <div class="col-md-9">
                      <h5>Faturas e Mensagens</h5>
                      <div style="overflow: scroll; height:300px;">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                          <th>Mensagem</th>
                          <th>Data</th>
                        </tr>
                       
                      <?php
                      /// ******** carrega os planos nas textbox **********
                      $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.usuario_mensagem WHERE usuario_mensagem.user_id='".$user_id."';";
                      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
                      {
                        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                        {
                          echo "<tr><td>".$rowResultStmtSelectAllRegistros["mensagem"]."</td>";
                          echo "<td>".$rowResultStmtSelectAllRegistros["data"]."</td></tr>";
                        }
                      }

                      ?>
                      
                    </table>
                  </div>
                    </div>
                    </div>





                  </div>
                </div>


                  </form>
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
    </div>

<?php
  $sqlStmtCheckLogin="SELECT * FROM agendalocal.usuario_anuncio WHERE usuario_anuncio.user_id='".$_SESSION['user_id']."';";
  if($resultStmtCheckLogin = pg_prepare($db_connection,"",  $sqlStmtCheckLogin))
  {
    $resultStmtCheckLogin = pg_execute($db_connection, "", array());
    if($rowResultStmtCheckLogin = pg_fetch_array($resultStmtCheckLogin))
    {
      $nome = $rowResultStmtCheckLogin["nome"];
      $telefone = $rowResultStmtCheckLogin["telefone"];
      $whatsapp = $rowResultStmtCheckLogin["whatsapp"];
      $site = $rowResultStmtCheckLogin["site"];
      $endereco = $rowResultStmtCheckLogin["endereco"];
      $numero = $rowResultStmtCheckLogin["numero"];
      $atividade = $rowResultStmtCheckLogin["atividade"];

    }
    else
    {
      // $result="Usuário ou senha errada! Tente novamente!";
      // $login_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
    }
  }


  if($plano == "Ouro"){
    $whatsapp_tipo = "text";
    $site_tipo = "text";
    $zap_display = "inline";
    $site_display = "inline";
  } else if ($plano == "Prata"){
    $whatsapp_tipo = "text";
    $site_tipo = "hidden";
    $zap_display = "inline";
    $site_display = "none";
  } else if ($plano == "Bronze"){
    $whatsapp_tipo = "hidden";
    $site_tipo = "hidden";
    $zap_display = "none";
    $site_display = "none";
  }



?>


   <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Anúncio</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordnameEdit" value="<?php echo $nome; ?>" name="registronomeEdit" class="form-control" placeholder="Nome" required/>
                  <label for="recordnameEdit">Nome</label>
                  <input type="hidden" id="hiddenrecordidEdit" name="hiddenregistroidEdit"/>
                  <input type="hidden" id="atividade" name="atividade" value="<?php echo $atividade; ?>"/>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordtelephoneEdit" value="<?php echo $telefone; ?>" name="registrotelefoneEdit" class="form-control" placeholder="Telefone" required/>
                  <label for="recordtelephoneEdit">Telefone</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="<?php echo $whatsapp_tipo; ?>" id="recordwhatsappEdit" value="<?php echo $whatsapp; ?>" name="registrowhatsappEdit" class="form-control" placeholder="WhatsApp"/>
                  <label style = "display: <?php echo $zap_display; ?>" for="recordwhatsappEdit">WhatsApp</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="<?php echo $site_tipo; ?>" id="recordSiteEdit" value="<?php echo $site; ?>" name="registroSiteEdit" class="form-control" placeholder="Site" />
                      <label style = "display: <?php echo $site_display; ?>" for="recordSiteEdit">Site</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                   <?php
                   if($plano == "Ouro"){
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                   } else if ($plano == "Prata"){
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                   } else if ($plano == "Bronze"){
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                      echo "<span class='fa fa-star' style='color:#FFD700;'></span>";
                   }
                   ?>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="recordaddressEdit" value="<?php echo $endereco; ?>" name="registroenderecoEdit" class="form-control" placeholder="Endereço" required/>
                      <label for="recordaddressEdit">Endereço</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="recordnumberEdit" value="<?php echo $numero; ?>" name="registronumeroEdit" class="form-control" placeholder="Número" required/>
                      <label for="recordnumberEdit">Número</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">

                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="card-header cardheader-overwrite">
                  <!-- <input type="text" id="recordactivityInsert" name="registroatividadeInsert" class="form-control" placeholder="Atividade"/> -->
                  <label for="recordactivityInsert">Atividade</label>

                  <select style="width: 90%;" id="registroatividadeEdit" name="registroatividadeEdit" required>
                    <option value="<?php echo $atividade ?>"><?php echo $atividade ?></option>
                    <?php
                      $sqlStmtSelectAllTiposRegistro = "SELECT * FROM agendalocal.atividades";
                      if($resultStmtSelectAllTiposRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectAllTiposRegistro))
                      {
                        $resultStmtSelectAllTiposRegistro = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllTiposRegistro = pg_fetch_array($resultStmtSelectAllTiposRegistro))
                        { echo '<option value='.'"'.$rowResultStmtSelectAllTiposRegistro["nome"].'"'.'>'.$rowResultStmtSelectAllTiposRegistro["nome"].'</option>'; }
                      }
                    ?>
                  </select>
                </div>
              </div>
             
            </div>
                </div>
              </div>
              
            </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Enviar Anúncio">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['registronomeEdit'])) && (!empty($_POST['registrotelefoneEdit'])) && (!empty($_POST['registroenderecoEdit'])))
            {

              $id_registro = (int)$_POST['hiddenregistroidEdit'];
              $nome_registro = $_POST['registronomeEdit'];
              $telefone_registro = $_POST['registrotelefoneEdit'];
              $telefone_registro = preg_replace("/[^0-9]/", "", $telefone_registro);

              $endereco_registro = $_POST['registroenderecoEdit'];
              $numero_registro = $_POST['registronumeroEdit'];
              $numero_registro = preg_replace("/[^0-9]/", "", $numero_registro);

              $tipo_registro = 2;
              $iscliente_registro = 0;
              $city_id = $_SESSION['city_id'];
              $state_initials = $_SESSION['state_initials'];

              $whatsapp = $_POST['registrowhatsappEdit'];
              $whatsapp = preg_replace("/[^0-9]/", "", $whatsapp); 

              $site = $_POST['registroSiteEdit'];
              $atividade_registro = $_POST['registroatividadeEdit'];
              
              if($plano == "Ouro"){
                $estrelas = 5;
              } else if ($plano == "Prata"){
                $estrelas = 4;
              } else if($plano == "Bronze"){
                $estrelas = 3;
              }
      
      
                $sqlStmtEditRegistro = "";
                $sqlTextEditRegistro = "UPDATE agendalocal.usuario_anuncio SET estrelas='".$estrelas."', whatsapp='".$whatsapp."', site='".$site."', tipo='".$plano."' ,id_cidade=".(int)$_SESSION['city_id'].", id_tiporegistro=2, nome='".$nome_registro."', telefone='".$telefone_registro."', endereco='".$endereco_registro."', numero='".$numero_registro."', atividade='".$atividade_registro."', is_cliente=0, status='Aguardando Aceite' WHERE user_id=".(int)$user_id;
                $sqlStmtEditRegistro = $sqlTextEditRegistro;
              

              if($status == "Aguardando Primeiro Pagamento"){
                  echo "<script>alert('Realize o pagamento da primeira fatura para poder enviar seu anúncio.');</script>";
              } else {
                  if($resultStmtEditRegistro = pg_prepare($db_connection,"",  $sqlStmtEditRegistro))
                  {
                    $resultStmtEditRegistro = pg_execute($db_connection, "", array());
                    if(pg_affected_rows($resultStmtEditRegistro)>0)
                    {
                      echo "<script>alert('Anúncio atualizado com sucesso!.');</script>";
                      echo "<script>location.href='anuncianteDash.php';</script>";
                    }
                    else
                    {
                       echo "<script>alert('Falha ao atualizar anuncio.');</script>";
                    }
                  }
              }






            }
          ?>
        </div>
      </div>
    </div>







       <!--******************** Mudar Senha Modal ****************************-->
    <div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mudar Senha</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                
                
                 <!--  <div class="form-label-group">
                    <input type="password" id="tx_senha_atual" name="tx_senha_atual" class="form-control" placeholder="Senha" required="required">
                    <label for="tx_senha_atual">Senha Atual</label>
                  </div> -->
                  
                  <!-- <br/> -->
                
                  <div class="form-label-group">
                    <input type="password" id="tx_senha" name="tx_senha" class="form-control" placeholder="Confirmar Senha" required="required">
                    <label for="tx_senha">Nova Senha</label>
                  </div>

                  <br/>

                  <div class="form-label-group">
                    <input type="password" id="tx_confirma_senha" name="tx_confirma_senha" class="form-control" placeholder="Confirmar Senha" required="required">
                    <label for="tx_confirma_senha">Confirmar Nova Senha</label>
                  </div>
                
              
              </div>
             
              
            </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Salvar">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['tx_senha'])) && (!empty($_POST['tx_confirma_senha'])))
            {
              if($_POST['tx_senha'] == $_POST['tx_confirma_senha']){
                  $pontos = array("'", "<",">","=");
                  // $senha_atual = md5(str_replace($pontos, "", $_POST['tx_senha_atual']));
                  $nova_senha = md5(str_replace($pontos, "", $_POST['tx_senha']));
                  $confirma_senha = md5(str_replace($pontos, "", $_POST['tx_confirma_senha']));
                  $state_initials = $_SESSION['state_initials'];
                  $sqlStmtEditRegistro = "";
                    $sqlTextEditRegistro = "UPDATE agendalocal.usuarios SET senha='".$nova_senha."' WHERE id_usuario=".(int)$user_id;
                    $sqlStmtEditRegistro = $sqlTextEditRegistro;
                  if($resultStmtEditRegistro = pg_prepare($db_connection,"",  $sqlStmtEditRegistro))
                  {
                    $resultStmtEditRegistro = pg_execute($db_connection, "", array());
                    if(pg_affected_rows($resultStmtEditRegistro)>0)
                    {
                      
                      echo "<script>alert('Senha modificada com sucesso!')</script>";
                      echo "<script>location.href='anuncianteDash.php';</script>";
                    }
                    else
                    {
                     echo "<script>alert('Erro ao salvar, contate o suporte ou tente novamente.');</script>";
                    }
                  }
                } else {
                  echo "<script>alert('Erro ao salvar, verifique se as senhas foram digitadas corretamente.');</script>";
                }







            } 
          ?>
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
