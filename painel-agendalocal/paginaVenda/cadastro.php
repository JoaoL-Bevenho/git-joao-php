<?php
  include("php/db_config.php");
  session_start();
  $conn=new db_conn();
  $db_connection = $conn->connection();
  $result="";
  $insert_msg="";

  if(isset($_GET['id'])){

    $pontos = array("'", "<",">","=");
    $plano = str_replace($pontos, "", $_GET['id']);
  }

  // if($_SERVER["REQUEST_METHOD"] == "POST")
  // {
  //   $userlogin=$_POST['username'];
  //   $email=$_POST['username'];
  //   $password=$_POST['password'];
  //   $idusuario=0;
  //
  //   $sqlStmtCheckLogin="SELECT usuarios.id_usuario FROM agendalocal.usuarios WHERE (usuarios.email='".$userlogin."' OR usuarios.login='".$email."') AND usuarios.senha = '".$password."'";
  //   if($resultStmtCheckLogin = pg_prepare($db_connection,"",  $sqlStmtCheckLogin))
  //   {
  //     $resultStmtCheckLogin = pg_execute($db_connection, "", array());
  //     if($rowResultStmtCheckLogin = pg_fetch_array($resultStmtCheckLogin))
  //     {
  //       $idusuario = $rowResultStmtCheckLogin[0];
  //       $result="";
  //       $insert_msg="";
  //       header("location: index.php");
  //       exit;
  //     }
  //     else
  //     {
  //       $result="Usuário ou senha errada! Tente novamente!";
  //       $insert_msg='<div class='.'"'.'card-header ok-msg'.'"'.'>'.$result.'</div>';
  //     }
  //   }
  // }
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

  </head>

  <body class="bg-dark bg-overwrite">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Registrar uma Conta</div>
        <form method="post">
          <div class="card-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="tx_nome" name="tx_nome" class="form-control" placeholder="Nome" required="required" autofocus="autofocus">
                    <label for="tx_nome">Nome</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="tx_telefone" name="tx_telefone" class="form-control" placeholder="Telefone" required="required">
                    <label for="tx_telefone">Telefone</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                <input type="text" id="tx_endereco" name="tx_endereco" class="form-control" placeholder="Endereço" required="required">
                <label for="tx_endereco">Endereço</label>
              </div>
            </div>
            </div>
          </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="tx_senha" name="tx_senha" class="form-control" placeholder="Senha" required="required">
                    <label for="tx_senha">Senha</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="tx_confirma_senha" name="tx_confirma_senha" class="form-control" placeholder="Confirmar Senha" required="required">
                    <label for="tx_confirma_senha">Confirmar Senha</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                    <div>
                      <label for="stateoptionsInsert">Cidade</label>
                      <select id="cityoptionsInsert" name="cidadeopcoesInsert" required="required">
                        <!-- <option value="0">--Selecione uma opção--</option> -->
                        <?php
                          $sqlStmtSelectAllEstados="SELECT * FROM agendalocal.cidades";
                          if($resultStmtSelectAllEstados = pg_prepare($db_connection,"",  $sqlStmtSelectAllEstados))
                          {
                            $resultStmtSelectAllEstados = pg_execute($db_connection, "", array());
                            while($rowResultStmtSelectAllEstados = pg_fetch_array($resultStmtSelectAllEstados))
                            {
                              echo "<option value='".$rowResultStmtSelectAllEstados['id_cidade']."'>".$rowResultStmtSelectAllEstados["nome"]."</option>";
                            }
                          }
                        ?>
                      </select>
                    </div>
                </div>
              </div>
            </div>
             <div class="form-group">
              <div class="form-row">
                 <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="tx_email" name="tx_email" class="form-control" placeholder="Email" required="required">
                    <label for="tx_email">Email</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    Plano escolhido: <?php echo $plano; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php echo "<center><button name='bt_continuar' class='btn btn-primary btn-block btn-primary-overwrite'>Continuar</button></center>" ?>

        </form>
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST")
          {

            $pontos = array("'", "<",">","=");



            $nome = str_replace($pontos, "", $_POST['tx_nome']);

            $telefone = str_replace($pontos, "", $_POST['tx_telefone']);

            $endereco = str_replace($pontos, "", $_POST['tx_endereco']);

            $senha_usuario = md5(str_replace($pontos, "", $_POST['tx_senha']));
            // $senha_usuario=md5($_POST['tx_senha']);
            $confirmarsenha_usuario = md5(str_replace($pontos, "", $_POST['tx_confirma_senha']));
            // $confirmarsenha_usuario=md5($_POST['tx_confirma_senha']);

            $cidade_id = str_replace($pontos, "", $_POST['cidadeopcoesInsert']);
            
            $email = str_replace($pontos, "", $_POST['tx_email']);

            //$plano ele pega la em cima
            $data = date('d-m-Y H:i:s');
            // $id_nivelacesso=(int)$_POST['nivelacessoInsert'];//ver dps

            if($senha_usuario == $confirmarsenha_usuario && ($plano == "Prata" || $plano == "Bronze" || $plano == "Ouro"))
            {
              //     $_SESSION['user_name'] = $pnome_usuario." ".$snome_usuario;

              $sqlStmtSelectAllEstados="INSERT INTO agendalocal.usuarios(id_nivelacesso, pnome, snome, email, login, senha) VALUES(3, '".$nome."', '".$nome."', '".$email."', '".$email."', '".$senha_usuario."') returning id_usuario;";

              if($resultStmtSelectAllEstados = pg_prepare($db_connection,"",  $sqlStmtSelectAllEstados))
              {
                $resultStmtSelectAllEstados = pg_execute($db_connection, "", array());
                while($rowResultStmtSelectAllEstados = pg_fetch_array($resultStmtSelectAllEstados))
                {
                  $user_id = $rowResultStmtSelectAllEstados['id_usuario'];
                  // echo "<script>alert('".$rowResultStmtSelectAllEstados['id_usuario']."');</script>";
                }
              }


              $sqlStmlInsertAnunciante="INSERT INTO agendalocal.usuario_anuncio VALUES (".$user_id.", ".$cidade_id.", 2, '".$nome."', '".$telefone."', '".$endereco."', '', '', 0, '', '', '', '".$plano."', 0, 0, 'Aguardando Primeiro Pagamento');";
              if($resultStmtInsertAnunciante = pg_prepare($db_connection,"",  $sqlStmlInsertAnunciante))
              {
                $resultStmtInsertAnunciante = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtInsertAnunciante)>0)
                {
                    // ************ CRIA UM USUARIO VINCULADO A ESTA INSCRICAO PARA ELE PODER LOGAR DEPOIS *******

                    // $nivelacesso_usuario = (int)$_POST['nivelacessoopcoesInsert'];

                  echo "<script>alert('Conta criada com sucesso! Realize o login com o email e senha fornecidos para dar continuidade.');</script>";

                    ////***************** FIM DA PARTE DO USUARIO *****************
                    echo "<script> location.href='../painelAdm/login.php';</script>";
                  // }
                }
                else
                {
                  $result="Ocorreu um erro ao tentar cadastrar o Usuário!<br/>";
                  $result.="Tente novamente ou entre em contato com um administrador.<br/>";
                  $insert_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
                }
              }
              else
              {
                $result='Ocorreu um erro na conexão com o Banco de Dados!<br/>';
                $result.='Tente novamente ou entre em contato com um administrador<br/>';
                $insert_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
              }
            }
            else
            {
              $result='Senha não pôde ser confirmada!<br/>';
              $result.='Verifique se ela foi digitada corretamente.<br/>';
              $insert_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
            }
          }
        
        ?>
        <?php if($insert_msg!=""){ echo $insert_msg; }?>
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
