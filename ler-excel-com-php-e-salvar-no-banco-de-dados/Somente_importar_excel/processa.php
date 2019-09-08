<?php
	//$dados = $_FILES['arquivo'];
	//var_dump($dados);
	
	if(!empty($_FILES['arquivo']['tmp_name'])){
		$arquivo = new DomDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
		
		$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);
		
		$primeira_linha = true;
		
		$cidade_all = "";
		foreach($linhas as $linha)
		{
			if($primeira_linha == false)
			{
				if(!empty($linha->getElementsByTagName("Data")->item(0)->nodeValue) && ($linha->getElementsByTagName("Data")->item(0)->nodeValue != "0"))
				{
					$cidade = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
					$cidade_all = $cidade;
					echo "Cidade: $cidade_all <br>";

				}
				else
				{
					echo "Cidade: $cidade_all <br>";
				}
				if(!empty($linha->getElementsByTagName("Data")->item(1)->nodeValue))
				{
					$telefone = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
					echo "Telefone: $telefone <br>";
				}
				else
				{
					echo "Telefone não encontrado.<br>";
				}
				if(!empty($linha->getElementsByTagName("Data")->item(1)->nodeValue))
				{
					$nome = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
					echo "Nome: $nome <br>";
				}
				else
				{
					echo "Nome não encontrado.<br>";
				}
				if(!empty($linha->getElementsByTagName("Data")->item(1)->nodeValue))
				{
					$endereco = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
					echo "endereco: $endereco<br>";
				}
				else
				{
					echo "Endereço não encontrado.<br>";
				}
				if(!empty($linha->getElementsByTagName("Data")->item(1)->nodeValue))
				{
					$numero = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
					echo "numero: $numero <br>";
				}
				else
				{
					echo "Número não encontrado.<br>";
				}
				if(!empty($linha->getElementsByTagName("Data")->item(5)->nodeValue))
				{
					$descricao = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
					echo "Descrição: $descricao <br>";
				}
				else
				{
					echo "Descrição nao encontrada.<br>";
				}
				echo "<hr>";
			}
			$primeira_linha = false;
		}
	}
?>