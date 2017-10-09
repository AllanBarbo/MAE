<?php
  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ ​Relatórios
  */

// Create conecção
$conn = new mysqli("localhost", "root", "","educatio");

// Checa conecção
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//Seleciona o ID do aluno com a sua multa correspondente
$sql = "SELECT idAluno, multa FROM emprestimos";
$result = $conn->query($sql);

//Seta as opções do Bootstrap no html
echo "<!DOCTYPE html>
        <html lang='pt-br'>
          <head>
            <!-- Bootstrap -->
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

            <title>Relatórios Multas</title>

            <!-- jQuery (plugins JavaScript do Bootstrap) -->
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
            <script src='js/bootstrap.min.js'></script>
          </head>
            <body>
            </body>
          </html>";

//Cria o começo da tabela com ID e multa como colunas
 echo " <div class='container'>
         <table class='table table-hover'>
          <tr>
           <th>Id do aluno</th>
           <th>Multa</th>
          </tr>";
  while($row = $result->fetch_assoc()) {
      //echo dos valores do id do Aluno e multas
      echo " <tr>
              <td>".$row["idAluno"]."</td>
              <td>".$row["multa"]."</td>
             </tr>
           ";
  }
  //Final da tabela
  echo "  </table>
        </div>";

?>
