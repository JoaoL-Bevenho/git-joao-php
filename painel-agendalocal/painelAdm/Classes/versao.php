<?php

class versao{

  //retorna se você precisa ou não atualizar seu aplicativo
  public function checkVersion($versaoCliente){
    include_once("db_config.php");
    $conn = new db_conn();
    $db_connection = $conn->connection();
    $versaoServidor = 0;
    $resultado = "Em dia";
    $sqlStmtSelectValue = "SELECT versao_lista.versao FROM agendalocal.versao_lista WHERE versao_lista.id=1";
    if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
    {
      $resultStmtSelectValue = pg_execute($db_connection, "", array());
      if($rowResultStmtSelectValue = pg_fetch_array($resultStmtSelectValue)){
        $versaoServidor = $rowResultStmtSelectValue['versao'];
      }
    }
    if($versaoCliente == $versaoServidor){
      $resultado = "Em dia";
    } else if($versaoCliente < $versaoServidor){
      $resultado = "Atualizar";
    }
    return $resultado;
  }


  //retorna a versao atual do banco
  public function getVersao(){
    include_once("db_config.php");
    $conn = new db_conn();
    $db_connection = $conn->connection();
    $versaoServidor = 0;
    $resultado = "Em dia";
    $sqlStmtSelectValue = "SELECT versao_lista.versao FROM agendalocal.versao_lista WHERE versao_lista.id=1";
    if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
    {
      $resultStmtSelectValue = pg_execute($db_connection, "", array());
      if($rowResultStmtSelectValue = pg_fetch_array($resultStmtSelectValue)){
        $versaoServidor = $rowResultStmtSelectValue['versao'];
      }
    }
    return $versaoServidor;
  }


  //atualiza a versao do banco de dados
  public function setVersao($versao){
    include_once("db_config.php");
    $conn = new db_conn();
    $db_connection = $conn->connection();
    $versaoServidor = 0;
    $resultado = "Em dia";
    $sqlStmtSelectValue = "UPDATE agendalocal.versao_lista SET versao=".$versao." WHERE id=1;";
    if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
    {
      $resultStmtSelectValue = pg_execute($db_connection, "", array());

      return "Atualizado";
    } else{
      return "Falha ao atualizar";
    }
  }


}
?>
