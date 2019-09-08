<?php
function listaProduto($conexao){
	$produtos = array();
	$resultado = mysqli_query($conexao, "select p.*,c.nome as categoria_nome from produtos as p join categorias as c on c.id=p.categoria_id");
	//´pegar produto associado a esse resultado
	//$produto = mysqli_fetch_array($resultado);
	//echo $produto['nome'];

	while($produto = mysqli_fetch_array($resultado)){
		//pucha produtos para dentro do array(qual array, produto)
		array_push($produtos,$produto);		
	}
	return $produtos;
}

function insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado){
	//inserir no banco
	$query = "insert into produtos (nome, preco, descricao, categoria_id, usado) values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id}, {$usado})";
	return mysqli_query($conexao, $query);	
}

function insereProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado){
	$query = "update produtos set nome = '{$nome}', preco = {$preco} , descricao = '{$descricao}', categoria_id={$categoria_id}, usado ={$usado} where id = '{$id}'  ";
}
function buscaProduto($conexao, $id){
	$query = "select * from produtos where id = {$id}";
	$resultado = mysqli_query($conexao, $query);
	//primeiro resultado
	return mysqli_fetch_assoc($resultado);
}

function removeProduto($conexao, $id){
	$query = "delete from produtos where id = {$id}";
	return mysqli_query($conexao, $query);
}




