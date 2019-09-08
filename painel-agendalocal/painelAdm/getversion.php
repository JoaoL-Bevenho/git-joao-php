<?php

if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['cliversion'])))
{
  include_once("Classes/versao.php");
  $tempVersao = new versao();
  $versao = $tempVersao->checkVersion($_POST["cliversion"]);
  $versaoNum = $tempVersao->getVersao();
  echo $versao."-".$versaoNum;
}
else {
  echo "nadie";
}

?>
