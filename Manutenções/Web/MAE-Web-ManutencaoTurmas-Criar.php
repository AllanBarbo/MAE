
<!--
Grupo:​ ​ MAE
Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da manutenção de multas,parte de criação
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
        <h2><center>Manutenção de turmas</center></h2><br>
        <p>Caro(a) (Nome do biliotecário logado), Preencha os campos para a criação de turmas </p>

        <!--Form para criação da turma -->
          <form action="MAE-Web-ManutencaoTurmas-Criar-BD.php" method="post" >

            <div class="form-group">
             <label for="idCurso">ID do Curso:</label>
             <input type="text" class="form-control" name="idCurso" required idCurso=idCurso>
           </div>

            <div class="form-group">
             <label for="nome">Nome da Turma:</label>
             <input type="text" class="form-control" name="nome" required nome=nome>
            </div>

            <div class="form-group">
             <label for="nome">Série:</label>
             <input type="text" class="form-control" name="serie" required serie=serie>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-outline-primary">
                <span class="glyphicon glyphicon-arrow-right"></span>  Enviar
              </button>
            </div>
          </form>
      </div>
  </body>
</html>
