<?php include("cabecalho.php");
include("conecta.php");
include("banco-categoria.php");
include("banco-produto.php");
$id = $_GET['id'];
$produto = buscaProduto($conexao, $id);
$categorias = listaCategorias($conexao);
//if - se for verdadeiro retorne checked='checked' se não vazio
//operador ternario
$usado = $produto['usado'] ? "checked='checked'" : "";
?>

<h1>Alterando produto</h1>
<form action="altera-produto.php" method="post">
  <input type="hidden" name="id"  value="<?=$produto['id']?>"
   <table class="table">
		<tr>
			<td>Nome</td>
			<td><input type="text" name="nome" class="form-control" value="<?=$produto['nome']?>" /></td>
		</tr>
		<tr>
			<td>Preço</td>
			<td><input type="number" name="preco" class="form-control" value="<?=$produto['preco']?>"/></td>
		</tr>
		<tr>
			<td>Descrição</td>
			<td><textarea name="descricao" class="form-control"><?=$produto['descricao']?></textarea></td>
		</tr>
		<tr>
   			<td></td>
   			<td><input type="checkbox" name="usado" <?=$usado ?>value="true">Usado</td>
	    </tr>
		<tr>
			<td>Categoria</td>
			<td>
				<select name="categoria_id" class="form-control">
				<!-- PARA CADA UMA DAS CATEGORIAS CHAMA ELA DE CATEGORIA-->
				<?php foreach($categorias as $categoria) : 
					$essaEhACategoria = $produto['categoria_id'] == $categoria['id'];
					$selecao = $essaEhACategoria ? "selected='select'" : "";
					?>
					<option value="<?=$categoria['id']?>"<?=$selecao?>><?=$categoria['nome']?><br/>
				<?php endforeach ?>				
				</select>
			</td>
	   </tr>
	   <td>
	   		<td><button type="submit" class="btn btn-primary">Alterar</button></td>
	   </tr>
    </table>
</form>

<?php include("rodape.php"); ?>
