<?php
include("php/db_config.php");
session_start();
$conn = new db_conn();
$db_connection = $conn->connection();

	$verzao = $_GET['id'];

    $sqlStmtSelectValue = "UPDATE agendalocal.versao_lista SET versao=".$verzao." WHERE id=1;";
    if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
    {
      $resultStmtSelectValue = pg_execute($db_connection, "", array());

       $_SESSION['ok_type'] = "Sucesso";
       $_SESSION['ok_msg'] = "Operação concluida!";
       echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
     
    } else{
     echo "<script>alert('Falha ao atualizar, consulte o suporte para mais informações.');</script>";
    }

?>