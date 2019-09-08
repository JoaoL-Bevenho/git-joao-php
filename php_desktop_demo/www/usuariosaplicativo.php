<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
  $conn=new db_conn();
  $db_connection = $conn->connection();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Usuários Painel</title>

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
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top navLogoBar">
      <a class="navbar-brand mr-1" href="index.php"><img src="Agenda Local - PNG.png" class="imgLogo"></a>
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
      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link nav-overwrite" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cidades.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Cidades</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-overwrite" href="anuncios.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Anúncios</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-overwrite" href="pagamentos.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Pagamentos</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-overwrite" href="register.php?return=usuariospainel">
            <i class="fas fa-fw fa-table"></i>
            <span>Criar Contas Usuários</span>
          </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link nav-overwrite" href="usuariospainel.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Usuários Painel</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-overwrite" href="usuariosaplicativo.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Usuários Aplicativo</span>
          </a>
        </li>
      </ul>
      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active">Usuários Painel</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                <div class="divBtnAdicionar">
                  <button class="btn-adicionar btn" href="#" data-toggle="modal" data-target="#insertModal">Adicionar Novo Usuário</button>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Login</th>
                      <th>Senha</th>
                      <th>Nível Acesso</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Login</th>
                      <th>Senha</th>
                      <th>Nível Acesso</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $sqlStmtSelectAllUsuarios="SELECT * FROM agendalocal.usuarios";
                      if($resultStmtSelectAllUsuarios = pg_prepare($db_connection,"",  $sqlStmtSelectAllUsuarios  ))
                      {
                        $resultStmtSelectAllUsuarios = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllUsuarios = pg_fetch_array($resultStmtSelectAllUsuarios))
                        {
                          echo '<tr>';
                          echo '<td value='.'"'.$rowResultStmtSelectAllUsuarios["id_usuario"].'"'.'>'.$rowResultStmtSelectAllUsuarios["pnome"].' '.$rowResultStmtSelectAllUsuarios["snome"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllUsuarios["email"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllUsuarios["login"].'</td>';
                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'>Editar Senha <span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';
                          $sqlStmtSelectNivelAcessoUsuarios="SELECT niveis_acesso.tipo FROM agendalocal.niveis_acesso WHERE niveis_acesso.id_nivelacesso = ".$rowResultStmtSelectAllUsuarios["id_nivelacesso"];
                          if($resultStmtSelectNivelAcessoUsuarios = pg_prepare($db_connection,"",  $sqlStmtSelectNivelAcessoUsuarios))
                          {
                            $resultStmtSelectNivelAcessoUsuarios = pg_execute($db_connection, "", array());
                            while($rowResultStmtSelectNivelAcessoUsuarios = pg_fetch_array($resultStmtSelectNivelAcessoUsuarios))
                            {
                              echo '<td value='.'"'.$rowResultStmtSelectAllUsuarios["id_nivelacesso"].'"'.'>'.$rowResultStmtSelectNivelAcessoUsuarios["tipo"].'</td>';
                            }
                          }
                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';
                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'deleteModal'.'"'.'><span class='.'"'.'spanDelete glyphicon glyphicon-trash'.'"'.'></span></a></td>';
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
        <!-- Sticky Fo   oter -->
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
          <div class="modal-body">Seleciona "Logout" abaixo se você deseja encerrar esta sessão.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!--Insert Modal-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Registro de Cidades</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="cityInsert" name="cidadeInsert" class="form-control" placeholder="Cidade" required="required" autofocus="autofocus">
                    <label for="cityInsert">Cidade</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-header cardheader-overwrite">
                    <div>
                      <label for="stateInsert">Estado</label>
                      <select id="stateInsert" name="estadoInsert">
                          <option value="0">--Selecione uma opção--</option>
                          <?php
                              $sqlStmtSelectAllEstados="SELECT * FROM agendalocal.estados";
                              if($resultStmtSelectAllEstados = pg_prepare($db_connection,"",  $sqlStmtSelectAllEstados))
                              {
                                $resultStmtSelectAllEstados = pg_execute($db_connection, "", array());
                                while($rowResultStmtSelectAllEstados = pg_fetch_array($resultStmtSelectAllEstados))
                                {
                                  echo '<option value='.'"'.$rowResultStmtSelectAllEstados["id_estado"].'"'.'>'.$rowResultStmtSelectAllEstados["nome"].' - '.$rowResultStmtSelectAllEstados['sigla'].'</option>';
                                }
                              }
                          ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Cidade">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['cidadeInsert'])) && (!empty($_POST['estadoInsert'])))
            {
              $nome_cidade=$_POST['cidadeInsert'];
              $id_estado=(int)$_POST['estadoInsert'];
              $sqlStmlInsertCidade="INSERT INTO agendalocal.cidades(id_estado, nome) VALUES(".(int)$id_estado.", '".$nome_cidade."')";
              if($resultStmtInsertCidade = pg_prepare($db_connection,"",  $sqlStmlInsertCidade))
              {
                $resultStmtInsertCidade = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtInsertCidade)>0)
                {
                  echo "<script>alert('Cidade cadastrada com sucesso!');</script>";
                  echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/cidades.php';</script>";
                  $resultInsert="Cidade cadastrada com sucesso!";
                  $resultInsert.='Clica no '.'"'.'x'.'"'.'acima para fechar esta janela.<br/>';
                  $msgInsert='<div class='.'"'.'card-header ok-msg'.'"'.'>'.$resultInsert.'</div>';
                }
                else
                {
                  echo "<script>alert('Ocorreu um erro ao tentar cadastrar a Cidade! Tente novamente ou entre em contato com um administrador.');</script>";
                  echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/cidades.php';</script>";
                  $resultInsert="Ocorreu um erro ao tentar cadastrar a Cidade!";
                  $resultInsert.="Tente novamente ou entre em contato com um administrador.<br/>";
                  $msgInsert='<div class='.'"'.'card-header error-msg'.'"'.'>'.$resultInsert.'</div>';
                }
              }
            }
          ?>
          <?php if($msgInsert!=""){ echo $msgInsert; }?>
        </div>
      </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edição de Registro de Cidades</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="citynameEdit" name="cidadenomeEdit" class="form-control" placeholder="Cidade" required="required" autofocus="autofocus">
                    <label for="cityEdit">Cidade</label>
                    <input type="hidden" id="cityidEdit" name="cidadeidEdit"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-header cardheader-overwrite">
                    <div>
                      <label for="stateoptionsEdit">Estado</label>
                      <select id="stateoptionsEdit" name="estadoopcoesEdit">
                          <option value="0">--Selecione uma opção--</option>
                          <?php
                              $sqlStmtSelectAllEstados="SELECT * FROM agendalocal.estados";
                              if($resultStmtSelectAllEstados = pg_prepare($db_connection,"",  $sqlStmtSelectAllEstados))
                              {
                                $resultStmtSelectAllEstados = pg_execute($db_connection, "", array());
                                while($rowResultStmtSelectAllEstados = pg_fetch_array($resultStmtSelectAllEstados))
                                {
                                  echo '<option value='.'"'.$rowResultStmtSelectAllEstados["id_estado"].'"'.'>'.$rowResultStmtSelectAllEstados["nome"].' - '.$rowResultStmtSelectAllEstados['sigla'].'</option>';
                                }
                              }
                          ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Editar Cidade">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['cidadenomeEdit'])) && (!empty($_POST['cidadeidEdit'])) && (!empty($_POST['estadoopcoesEdit'])))
            {
              $id_cidade=(int)$_POST['cidadeidEdit'];
              $nome_cidade=$_POST['cidadenomeEdit'];
              $id_estado=(int)$_POST['estadoopcoesEdit'];
              $sqlStmlUpdateCidade="UPDATE agendalocal.cidades SET id_estado=".(int)$id_estado.", nome='".$nome_cidade."' WHERE id_cidade=".(int)$id_cidade;
              if($resultStmtUpdateCidade = pg_prepare($db_connection,"",  $sqlStmlUpdateCidade))
              {
                $resultStmtUpdateCidade = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtUpdateCidade)>0)
                {
                  echo "<script>alert('Cidade editada com sucesso!');</script>";
                  echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/cidades.php';</script>";
                  $resultEdit="Cidade editada com sucesso!";
                  $resultEdit.='Clica no '.'"'.'x'.'"'.'acima para fechar esta janela.<br/>';
                  $msgEdit='<div class='.'"'.'card-header ok-msg'.'"'.'>'.$resultEdit.'</div>';
                }
                else
                {
                  echo "<script>alert('Ocorreu um erro ao tentar editar a Cidade! Tente novamente ou entre em contato com um administrador.');</script>";
                  echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/cidades.php';</script>";
                  $resultEdit="Ocorreu um erro ao tentar editar a Cidade!";
                  $resultEdit.="Tente novamente ou entre em contato com um administrador.<br/>";
                  $msgEdit='<div class='.'"'.'card-header error-msg'.'"'.'>'.$resultEdit.'</div>';
                }
              }

            }
          ?>
          <?php if($msgEdit!=""){ echo $msgEdit; }?>
        </div>
      </div>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Exclusão de Registro de Cidades</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              Seleciona "Apagar Registro" abaixo se você deseja excluir o seguinte registro de Cidades:
              <div class="form-row">
                <div class="col-md-6">
                  <label>Cidade:</label>
                  <input type="hidden" id="hiddencityidDelete" name="hiddencidadeidDelete"/>
                  <label id="citynameDelete"></label>
                  <input type="hidden" id="hiddencitynameDelete" name="hiddencidadenomeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Estado:</label>
                  <input type="hidden" id="hiddenstatenameDelete" name="hiddenestadonomeDelete"/>
                  <label id="statecompositeDelete" name="estadonomeDelete"></label>
                  <input type="hidden" id="hiddenstatecompositeDelete" name="hiddenestadocompostoDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="deleteSubmit" value="Apagar Registro">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddencidadeidDelete'])) && (!empty($_POST['hiddencidadenomeDelete'])) && (!empty($_POST['hiddenestadonomeDelete'])) && (!empty($_POST['hiddenestadocompostoDelete'])))
            {
              $id_cidade=$_POST['hiddencidadeidDelete'];
              $nome_cidade=$_POST['hiddencidadenomeDelete'];
              $nome_estado=$_POST['hiddenestadonomeDelete'];
              $estado_composto=$_POST['hiddenestadocompostoDelete'];
              $estado_separado = explode(" - ",$estado_composto);
              $sigla_estado = $estado_separado[1];
              $sqlStmtSelectEstadoId="SELECT estados.id_estado FROM agendalocal.estados WHERE estados.nome='".$nome_estado."' AND estados.sigla ='".$sigla_estado."'";
              if($resultStmtSelectEstadoId = pg_prepare($db_connection,"",  $sqlStmtSelectEstadoId))
              {
                $resultStmtSelectEstadoId = pg_execute($db_connection, "", array());
                if($rowResultStmtSelectEstadoId = pg_fetch_array($resultStmtSelectEstadoId))
                {
                  $id_estado = $rowResultStmtSelectEstadoId["id_estado"];
                  $sqlStmlDeleteCidade="DELETE FROM agendalocal.cidades WHERE cidades.id_cidade = ".(int)$id_cidade." AND cidades.id_estado =".(int)$id_estado." AND cidades.nome='".$nome_cidade."'";
                  if($resultStmtDeleteCidade = pg_prepare($db_connection,"",  $sqlStmlDeleteCidade))
                  {
                    $resultStmtDeleteCidade = pg_execute($db_connection, "", array());
                    if(pg_affected_rows($resultStmtDeleteCidade)>0)
                    {
                      echo "<script>alert('Cidade excluída com sucesso!');</script>";
                      echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/cidades.php';</script>";
                      $resultDelete="Cidade excluída com sucesso!";
                      $resultDelete.='Clica no '.'"'.'x'.'"'.'acima para fechar esta janela.<br/>';
                      $msgDelete='<div class='.'"'.'card-header ok-msg'.'"'.'>'.$resultDelete.'</div>';
                    }
                    else
                    {
                      echo "<script>alert('Ocorreu um erro ao tentar excluir a Cidade! Tente novamente ou entre em contato com um administrador.');</script>";
                      echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/cidades.php';</script>";
                      $resultDelete="Ocorreu um erro ao tentar excluir a Cidade!";
                      $resultDelete.="Tente novamente ou entre em contato com um administrador.<br/>";
                      $msgDelete='<div class='.'"'.'card-header error-msg'.'"'.'>'.$resultDelete.'</div>';
                    }
                  }
                }
              }
            }
          ?>
          <?php if($msgDelete!=""){ echo $msgDelete; }?>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    $(".spanEdit").click(function()
    {
      var $rowEdit = $(this).closest("tr"),
      $tdCidadeEdit = $rowEdit.find("td:eq(0)");

      document.getElementById('citynameEdit').value = $tdCidadeEdit.text();

      $tdEstadoEdit = $rowEdit.find("td:eq(1)");
      var $tdEstadoEditValue =  $tdEstadoEdit.attr("value") + " - " + $tdEstadoEdit.text();

      for (var i=0; i <document.getElementById('stateoptionsEdit').length; i++)
      {
        var $stateOption = document.getElementById('stateoptionsEdit')[i].text;
        if($stateOption == $tdEstadoEditValue)
        {
          document.getElementById('stateoptionsEdit').selectedIndex  = i;
          document.getElementById('cityidEdit').value = $tdCidadeEdit.attr("value");
        }
      }
    });

    $(".spanDelete").click(function()
    {
      var $rowDelete = $(this).closest("tr"),
      $tdCidadeDelete = $rowDelete.find("td:eq(0)");

      document.getElementById('hiddencityidDelete').value = $tdCidadeDelete.attr("value");
      document.getElementById('citynameDelete').innerHTML = $tdCidadeDelete.text();
      document.getElementById('hiddencitynameDelete').value = $tdCidadeDelete.text();

      $tdEstadoDelete = $rowDelete.find("td:eq(1)");
      var $tdEstadoDeleteValue =  $tdEstadoDelete.attr("value") + " - " + $tdEstadoDelete.text();
      document.getElementById('hiddenstatenameDelete').value = $tdEstadoDelete.attr("value");
      document.getElementById('statecompositeDelete').innerHTML = $tdEstadoDeleteValue;
      document.getElementById('hiddenstatecompositeDelete').value = $tdEstadoDeleteValue;
    });
  </script>
</html>
