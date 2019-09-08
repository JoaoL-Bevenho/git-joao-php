<?php

/*
O score é formado ao criar um anuncio ou atualiza-lo, com uma somatoria de pontos com base no plano e se
o anunciante em questão é ou não cliente. Quanto mais a pontuação, maior a posição de destaque na lista.
*/

class score{

  // //retorna o score do cliente
  // public function getScore($id){
  //   include_once("db_config.php");
  //   $conn = new db_conn();
  //   $db_connection = $conn->connection();
  //   $sqlStmtSelectValue = "SELECT clientes.score FROM agendalocal.clientes WHERE clientes.id=".$id.";";
  //   if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
  //   {
  //     $resultStmtSelectValue = pg_execute($db_connection, "", array());
  //     if($rowResultStmtSelectValue = pg_fetch_array($resultStmtSelectValue)){
  //       $score = $rowResultStmtSelectValue['score'];
  //     }
  //   }
  //   return $score;
  // }
  //
  //
  // //atualiza o score do cliente
  // public function setScore($id, $isCliente, $Plano){
  //   $score = 0;
  //   if($isCliente == 1){
  //     $score = 50;
  //   } else if ($isCliente == 0 && $Plano == "Ouro"){
  //     $score = 40;
  //   } else if ($isCliente == 0 && $Plano == "Prata"){
  //     $score = 30;
  //   }
  //   include_once("db_config.php");
  //   $conn = new db_conn();
  //   $db_connection = $conn->connection();
  //   $sqlStmtSelectValue = "UPDATE agendalocal.clientes SET score=".$score." WHERE id=".$id.";";
  //   if($resultStmtSelectValue = pg_prepare($db_connection,"",  $sqlStmtSelectValue))
  //   {
  //     $resultStmtSelectValue = pg_execute($db_connection, "", array());
  //     return "Atualizado";
  //   } else{
  //     return "Falha ao atualizar";
  //   }
  // }


}
?>
