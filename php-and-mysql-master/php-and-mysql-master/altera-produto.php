<?php include("cabecalho.php"); 
include("conecta.php");
include("banco-produto.php");
?>

<?php
//pega dados da url
$id = $_POST['id'];
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$descricao = $_POST["descricao"];
$categoria_id = $_POST["categoria_id"];
//verificar se campo existe
//		DENTRO DA   ARRAY DE POST
if(array_key_exists("usado", $_POST)){
	$usado = "true";
}else{
	$usado = "false";
}

//mysqli_query($conexao, $query) executa a query em determindada conexao
if(alteraProduto($conexao,$id, $nome, $preco, $descricao, $categoria_id, $usado)) { ?>
   <p class="text-success">O Produto <?= $nome; ?>, <?= $preco; ?> alterado com sucesso!</p>
<?php } else {
   $msg = mysqli_error($conexao);
   ?>
   <p class="text-danger">O Produto <?= $nome; ?> não foi alterado:<?= msg ?></p>
<?php 
} 
?>

<?php include("rodape.php"); ?>
