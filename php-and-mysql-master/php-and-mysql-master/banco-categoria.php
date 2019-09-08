<?php 
function listaCategorias($conexao){
	$categorias = array();
	$query = "select * from categorias";
	$resultado = mysqli_query($conexao, $query);
	//busca toda categoria
	while($categoria = mysqli_fetch_assoc($resultado)){
		//coloca em um array
		array_push($categorias, $categoria);
	}
	return $categorias;;
}