<?php

//Seta as strings de acordo com seus respectivos inputs
$StringIdCurso = $_POST["idCurso"];
$StringNomeTurma = $_POST["nome"];

// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//Verificação do preeenchimento dos campus texto
if (isset($StringIdCurso) && isset($StringNomeTurma)) {
  //seleciona o ID da turma pelo id do curso e o nome da turma
  $sql = "SELECT `id` FROM `turmas` WHERE idCurso = $StringIdCurso AND nome = $StringNomeTurma";
  $result = $conn->query($sql);
  while($linha = $sql->fetch_array() ) {
    //atualiza na tabela as variaveis do input
    $sql = "UPDATE  INTO `turmas` SET `idCurso` = '$StringIdCurso', `nome` = '$StringNomeTurma' WHERE `id` = ".$linha["id"];
  }
}
else{
  if (isset($StringIdCurso)) {
    //seleciona o ID da turma pelo id do curso
    $sql = "SELECT `id` FROM `turmas` WHERE idCurso = $StringIdCurso";
    $result = $conn->query($sql);
    while($linha = $sql->fetch_array() ) {
      //atualiza na tabela as variaveis do input
      $sql = "UPDATE  INTO `turmas` SET `idCurso` = '$StringIdCurso' WHERE `id` = ".$linha["id"];
    }
  }

  if (isset($StringNomeTurma)) {
    //seleciona o ID da turma pelo id do curso e o nome da turma
    $sql = "SELECT `id` FROM `turmas` WHERE nome = $StringNomeTurma";
    $result = $conn->query($sql);
    while($linha = $sql->fetch_array() ) {
      //atualiza na tabela as variaveis do input
      $sql = "UPDATE  INTO `turmas` SET `nome` = '$StringNomeTurma' WHERE `id` = ".$linha["id"];
    }
  }
}



//Verifica se o Departamento foi criado com sucesso e redireciona para o menu inical
if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Turma editada com sucesso!')</script>";
  echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";

}
else{
  //echo "<script>alert('Erro ao editar Turma: ".$conn->error." ')</script>";
  //echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-Editar-BD.php';</script>";
}

?>
