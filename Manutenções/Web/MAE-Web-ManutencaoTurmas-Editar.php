
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

                //Seleciona do BD o ID da turma com as suas multas correspondentes
                $sql = "SELECT * FROM turmas WHERE id = $id ";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                      //echo dos valores do id do Aluno e multas
                  echo " <table class='table table-bordered'>
                              <caption>Turma escolhida</caption>
                              <tr>
                                <td>
                                  <b>ID do  Curso</b>: ".$row["idCurso"]." <br>
                                  <b>Nome da turma</b>: ".$row["nome"]." <br>
                                </td>
                              </tr>
                            </table>
                           ";
                    }
              }
          ?>
        </div></center>

        <p>Caro(a) (Nome do biliotecário logado), Preencha ao menos um dos campos para a edição da turma </p>

        <!--Form para criação da turma -->
          <form action='MAE-Web-ManutencaoTurmas-Editar-BD.php' method='post' >

            <div class='form-group'>
             <label for='idCurso'>Novo ID do Curso:</label>
             <input type='text' class='form-control' name='idCurso' placeholder="ID do curso inalterado" >
            </div>

            <div class='form-group'>
             <label for='nome'>Novo nome da Turma:</label>
             <input type='text' class='form-control' name='nome' placeholder="Nome inalterado">
            </div>

            <div class='form-group'>
              <button type='submit' class='btn btn-outline-primary'>
                <span class='glyphicon glyphicon-arrow-right'></span>  Enviar
              </button>
            </div>

          </form>
      </div>
  </body>
</html>
