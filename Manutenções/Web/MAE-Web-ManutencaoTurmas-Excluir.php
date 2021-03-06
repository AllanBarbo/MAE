
<!DOCTYPE html>
<html lang='pt-br'>
  <head>
    <!-- Bootstrap -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

    <title>Manutenção de turmas</title>

    <!-- jQuery (plugins JavaScript do Bootstrap) -->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
  </head>
  <body>
    <!--Div container -->
    <div class='container'>
        <h2><center>Manutenção de turmas</center></h2><br>
        <center><div class='.col-xs-9'>
          <?php
              // Verifica se usuário escolheu algum nome
              if(isset($_POST["select"]))
              {
                foreach($_POST["select"] as $id)
                {
                  //seta a variavel "$id" (id da turma) com o input do select
                }

                // Cria conexão
                $conn = new mysqli("localhost", "root", "","educatio");
                // Checa conexão
                if ($conn->connect_error) {
                    die("Conecção falhou: " . $conn->connect_error);
                }

                $sql = "SELECT IdTurma FROM disciplinas WHERE idTurma = $id ";
                $resultadoDisciplinas = $conn->query($sql);

                if ($resultadoDisciplinas->num_rows!=0){
                  $sql = "SELECT * FROM turmas WHERE id = $id ";
                  $resultadoTurma = $conn->query($sql);

                  while($row = $resultadoTurma->fetch_assoc()) {
                        //echo dos valores do id do Aluno e multas
                    echo " <table class='table table-bordered'>
                                <caption>Turma deletada</caption>
                                <tr>
                                  <td>
                                    <b>ID do  Curso</b>: ".$row["idCurso"]." <br>
                                    <b>Nome da turma</b>: ".$row["nome"]." <br>
                                  </td>
                                </tr>
                              </table>
                             ";
                      }

                  echo "<script>alert('Existe disciplinas atreladas a turma')</script>";
                  echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";
                }

                else{
                  $sql = "SELECT * FROM turmas WHERE id = $id ";
                  $resultadoTurma = $conn->query($sql);

                  while($row = $resultadoTurma->fetch_assoc()) {
                        //echo dos valores do id do Aluno e multas
                    echo " <table class='table table-bordered'>
                                <caption>Turma deletada</caption>
                                <tr>
                                  <td>
                                    <b>ID do  Curso</b>: ".$row["idCurso"]." <br>
                                    <b>Nome da turma</b>: ".$row["nome"]." <br>
                                  </td>
                                </tr>
                              </table>
                             ";
                      }
                      $sql = "UPDATE `turmas` SET `ativo` = 'N' WHERE `id` = $id";
                      $resultadoUPDATE = $conn->query($sql);

                      echo "<script>alert('Turma excluida com sucesso!')</script>";
                      echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";
                }
              }
          ?>

      </div>
  </body>
</html>
