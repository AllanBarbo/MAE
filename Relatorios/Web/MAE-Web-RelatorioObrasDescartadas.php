<?php

/**
 * @author 
 * @copyright 2017
 */

    $id = $_POST['idAcervo'];
    
    $link = new mysqli("localhost", "root", "", "educatio");
    
    if(!$link)
        die("Conexão falhou.");
    
    $sql = "SELECT * FROM `descartes` WHERE idAcervo=$id";
    $resultado = $link->query($sql);
   
    while($row = $resultado->fetch_assoc()){
        echo "O id do livro descartado e: ".$row['idAcervo']."<br>";
        echo "O operador que o descartou foi: ".$row['operador']."<br>";
        echo "O motivo foi: ".$row['motivos']."<br>";
        echo "Data do descarte: ".$row['dataDescarte']."<br>";
        $conteudoDoArquivo =  "O id do livro descartado e: ".$row['idAcervo']."\nO operador que o descartou foi: ".$row['operador']."\nO motivo foi: ".$row['motivos']."\nData do descarte: ".$row['dataDescarte'];
    }
    
    
        
    $nomeDoArquivo = "RelatorioDeObrasDescartadas.txt";
    
    $arquivo = fopen($nomeDoArquivo, "w");
    
    $dir = dirname(__FILE__);
    
    $caminho = $dir."//".$nomeDoArquivo;
    
    
    $arquivo = fwrite($arquivo, $conteudoDoArquivo);
    
    echo "<a href='$caminho' download>Clique aqui para fazer download do arquivo.</a>";
?>