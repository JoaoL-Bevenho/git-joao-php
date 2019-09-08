<?php include("cabecalho.php");
include("conecta.php");
include("banco-produto.php"); ?>

<?php
if(array_key_exists("removido", $_GET) && $_GET["removido"]=="true"){
?>
	<p class="alert-success">Produto apagado com sucesso.</p>
<?php
}
?>
<table class="table table-striped table-bordered">
<?php
	$produtos = listaProduto($conexao);
	//foreach para cada um desses produtos quero executar esse codigo
	//o nome da variavel vai ser produto
	foreach($produtos as $produto){
	//emprima isso para mim <?= ?
?>
<tr>
	<td><?= $produto['nome']?></td>
	<td><?= $produto['preco']?></td>
	<!-- substr = controla quantidade de caracteres
	substr($produto['descricao'], 0, 15) - apartir do caractere 0, mostrar 15-->
	<td><?= substr($produto['descricao'], 0, 40)?></td>
	<td><?= $produto['categoria_nome']?></td>
	<td><a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$produto['id']?>">alterar</a></td>
	<td>
		<form action="remove-produto.php" method="post">
			<input type="hidden" name="id" value="<?=$produto['id']?>">
			<button class="btn btn-danger">remover</button>
		</form>
	</td>
</tr>
	
<?php
}
?>
</table>
<?php include("rodape.php"); ?>