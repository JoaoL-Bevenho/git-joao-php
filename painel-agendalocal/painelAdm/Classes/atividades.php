<?php

class atividade{

  public function getAtividadeCodigo($descricao){

    include("../php/db_config.php");
    $conn = new db_conn();
    $db_connection = $conn->connection();

    $codigo = "0";
    $sqlStmtSelectValue = "SELECT atividades.id FROM agendalocal.atividades WHERE atividades.nome='".$descricao."'";
    if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
    {
      $resultStmtSelectValue = pg_execute($db_connection, "", array());
      if($rowResultStmtSelectValue = pg_fetch_array($resultStmtSelectValue)){
        $codigo = $rowResultStmtSelectValue['id'];
      }
    }
    return $codigo;
  }


}
?>
