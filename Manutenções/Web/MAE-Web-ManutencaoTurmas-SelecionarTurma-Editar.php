
<!--
Grupo:​ ​ MAE
Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da manutenção de multas,parte de edição
-->

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Bootstrap -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Manutenção de turmas</title>

    <!-- jQuery (plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <!--Div container -->
    <div class="container">
        <h2><center>Manutenção de Turmas</center></h2><br>
        <p>Caro(a) (Nome do biliotecário logado), Selecione a turma para edição </p>

        <!--select com os nomes das turma -->
          <form action="MAE-Web-ManutencaoTurmas-Editar.php" method="post" >

            <div class="form-group">
              <label for="select">Selecione uma turma para editar:</label>
              <?php
                $conn = new mysqli("localhost", "root", "","educatio");
                $query = $conn->query(" SELECT * FROM `turmas` WHERE ativo='S' ORDER BY idCurso ASC,nome ASC");

                //Cria o select dinamico pelo BD
                echo " <select class='form-control' id='select' name='select[]'> ";
                while($linha = $query->fetch_array() ) {
                  echo " <option value = '".$linha["id"]."'> ".$linha["nome"]." - ID do curso: ".$linha["idCurso"]."</option> ";
                }
                echo "</select>";
              ?>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-right"></span>  Enviar
              </button>
            </div>
          </form>

      </div>
  </body>
</html>
