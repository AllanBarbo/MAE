<?php
  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script para a inserção dos valores do input na tabela de Turmas no BD

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

//Seta as strings de acordo com seus respectivos inputs
$StringIdTurma = $_POST["idTurma"];
$StringIdCurso = $_POST["idCurso"];
$StringNomeTurma = $_POST["nome"];


// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//insere na tabela as variaveis do input
$sql = "INSERT  INTO `turmas` (`id`, `idCurso`, `nome`, `ativo`)
        VALUES ('$StringIdTurma', '$StringIdCurso', '$StringNomeTurma', 'S')";

if ($conn->query($sql) === TRUE) {
    header('Location: /MAE/MAE-Web-ManutencaoTurmas.html');
} else {
    echo "Error: " . $conn->error;
}

//fecha conexão
$conn->close();




?>
