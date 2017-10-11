<?php

/**
 * @author 
 * @copyright 2017
 */

	function get_post_action($name)
	{
	    $params = func_get_args();

	    foreach ($params as $name) {
	        if (isset($_POST[$name])) {
	            return $name;
	        }
	    }
	}

    $id = $_POST['idAcervo'];
    
    $link = new mysqli("localhost", "root", "", "educatio");
    if(!$link)
        die("Conexão falhou.");
    
    $sql = "SELECT * FROM `descartes` WHERE id=$id";
    $resultado = $link->query($sql);

    if(!$resultado){
    	die("Selecionar o Banco de Dados falhou.");
    }
   
    echo "<!DOCTYPE html>
		<html>
		<head>
			<meta charset='utf-8'>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
			<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

			<title>Relatorio obras descartadas</title>

			<!-- jQuery (plugins JavaScript do Bootstrap) -->
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
			<script src='js/bootstrap.min.js'></script>
		</head>
		<body>
			<div class='container-fluid'>
				<h1>Relatorios:<small><em>Obras Descartadas</em></small></h1> ";
    

    $booleanDownload = false;
    switch (get_post_action('mostrarNaTela', 'download')) {
    	case 'mostrarNaTela':
    		echo "<h3>Resultados da pesquisa:</h3>";
    		while($row = $resultado->fetch_assoc()){
		        echo "O id do livro: ".$row['id'].
		        		"<br>O funcionario que o descartou: ".$row['idFuncionario'].
		        		"<br>Motivo: ".$row['motivos'].
		        		"<br>Data do descarte: ".$row['dataDescarte'];
    		}

    		break;

    	case 'download':
    		$stringConteudoDoArquivo = "Relatorio de obras descartadas:\r\n \r\n";
	    	while($row = $resultado->fetch_assoc()){
		        $stringConteudoDoArquivo .=  "O id do livro descartado e: ".$row['id'].
		        						"\r\nO funcionario que o descartou foi: ".$row['idFuncionario'].
		        						"\r\nO motivo foi: ".$row['motivos'].
		        						"\r\nData do descarte: ".$row['dataDescarte'];
    		}

    		$stringNomeDoArquivo = "RelatorioDeObrasDescartadas.txt";
		    $dir = dirname(__FILE__)."";

		    $arquivo = fopen($stringNomeDoArquivo, "w");
		    fwrite($arquivo, $stringConteudoDoArquivo);
		    fclose($arquivo);
    		echo "<br><a href='$stringNomeDoArquivo' download>Clique aqui para fazer download do arquivo.</a>";
    		break;

    	default:
    		# code...
    		break;
    }

    echo "		</div>
    		</body>
			</html>"
?>