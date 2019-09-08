<?php include("cabecalho.php");
include("conecta.php");
include("banco-categoria.php");
	
	$categorias = listaCategorias($conexao);
?>

<h1>Formulário de cadastro</h1>
<form action="adiciona-produto.php" method="post">
   <table class="table">
		<tr>
			<td>Nome</td>
			<td><input type="text" name="nome" class="form-control" /></td>
		</tr>
		<tr>
			<td>Preço</td>
			<td><input type="number" name="preco" class="form-control"/></td>
		</tr>
		<tr>
			<td>Descrição</td>
			<td><textarea name="descricao" class="form-control"></textarea></td>
		</tr>
		<tr>
   			<td></td>
   			<td><input type="checkbox" name="usado" value="true">Usado</td>
	    </tr>
		<tr>
			<td>Categoria</td>
			<td>
				<select name="categoria_id" class="form-control">
				<!-- PARA CADA UMA DAS CATEGORIAS CHAMA ELA DE CATEGORIA-->
				<?php foreach($categorias as $categoria) : ?>
					<option value="<?=$categoria['id']?>"><?=$categoria['nome']?><br/>
				<?php endforeach ?>				
				</select>
			</td>
	   </tr>
	   <td>
	   		<td><button type="submit" class="btn btn-primary">Cadastrar</button></td>
	   </tr>
    </table>
</form>

<?php include("rodape.php"); ?>
