<?php include("cabecalho.php"); 
include("conecta.php");
include("banco-produto.php");

$id = $_POST['id'];
removeProduto($conexao, $id);
//renderiza
header("Location: produto-lista.php?removido=true");
//acaba por aqui
die();
?>
