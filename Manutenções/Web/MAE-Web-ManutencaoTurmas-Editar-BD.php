<?php


//Seta as strings de acordo com seus respectivos inputs
$StringNovoIdCurso = $_POST["NovoIdCurso"];
$StringNovoNomeTurma = $_POST["NovoNome"];
$StringIdCurso = $_POST["idCurso"];
$StringNomeTurma = $_POST["nome"];

// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}


//Verifica se as preposiões dos case são iguais a true
switch (true) {
    //Caso os 2 campos NÃO estejam preenchidos
    case ( empty($StringIdCurso) && empty($StringNomeTurma) ):
            echo  "<script>alert('Preencha ao menos um campo!);</script>";
            $url="http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Editar.php";
            header('Location: ' . $url, true, 303);
            die();
          break;

    //Caso os 2 campos estejam preenchidos
    case ( !empty($StringIdCurso) && !empty($StringNomeTurma) ):
          $sqlSELECT = "SELECT `id` FROM `turmas` WHERE idCurso = '$StringIdCurso' AND nome = '$StringNomeTurma' ";
          $resultadoSELECT = $conn->query($sqlSELECT);

          while($linha = $resultadoSELECT->fetch_array() ) {
            //atualiza na tabela as variaveis do input
            $sqlUPDATE = "UPDATE `turmas` SET `idCurso` = '$StringNovoIdCurso', `nome` = '$StringNovoNomeTurma' WHERE `id` = ". $linha["id"];
            $resultadoUPDATE = $conn->query($sqlUPDATE);

            //Verifica se o Departamento foi criado com sucesso e redireciona para o menu inical
            if ($conn->query($sqlUPDATE) === TRUE) {
              echo "<script>alert('Turma editada com sucesso!')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";

            }
            else{
              echo "<script>alert('Erro ao editar Turma: ".$conn->error." ')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Editar.php';</script>";
            }
          }
        break;

    //Caso o campo de IdCurso esteja preenchido
    case ( !empty($StringIdCurso) && empty($StringNomeTurma) ):
          $sqlSELECT = "SELECT `id` FROM `turmas` WHERE idCurso = '$StringIdCurso' ";
          $resultadoSELECT = $conn->query($sqlSELECT);

          while($linha = $resultadoSELECT->fetch_array() ) {
            //atualiza na tabela as variaveis do input
            $sqlUPDATE = "UPDATE `turmas` SET `idCurso` = '$StringNovoIdCurso' WHERE `id` = ". $linha["id"];
            $resultadoUPDATE = $conn->query($sqlUPDATE);

            //Verifica se o Departamento foi criado com sucesso e redireciona para o menu inical
            if ($conn->query($sqlUPDATE) === TRUE) {
              echo "<script>alert('Turma editada com sucesso!')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";

            }
            else{
              echo "<script>alert('Erro ao editar Turma: ".$conn->error." ')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Editar.php';</script>";
            }
          }
        break;

    //Caso o campo de NomeTurma esteja preenchido
    case ( empty($StringIdCurso) && !empty($StringNomeTurma) ):
          $sqlSELECT = "SELECT `id` FROM `turmas` WHERE nome = '$StringNomeTurma' ";
          $resultadoSELECT = $conn->query($sqlSELECT);

          while($linha = $resultadoSELECT->fetch_array() ) {
            //atualiza na tabela as variaveis do input
            $sqlUPDATE = "UPDATE `turmas` SET `nome` = '$StringNovoNomeTurma' WHERE `id` = ". $linha["id"];
            $resultadoUPDATE = $conn->query($sqlUPDATE);

            //Verifica se o Departamento foi criado com sucesso e redireciona para o menu inical
            if ($conn->query($sqlUPDATE) === TRUE) {
              echo "<script>alert('Turma editada com sucesso!')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";

            }
            else{
              echo "<script>alert('Erro ao editar Turma: ".$conn->error." ')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Editar.php';</script>";
            }
          }
        break;
}


?>
