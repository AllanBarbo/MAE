<?php
  
  /*
  Grupo:​ ​ MAE
    Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
    Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da impressão via tela dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

// Cria conexão
include("mpdf60/mpdf.php");
$conn = new mysqli("localhost", "root", "","educatio");

// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//Seleciona o ID do aluno com a sua multa correspondente
$sql = "SELECT idAluno, multa FROM emprestimos ORDER BY idAluno ASC";
$result = $conn->query($sql);

//Seta as opções do Bootstrap no html e o código para gerar a tabela que seleciona o ID do aluno e suas multas
$html = "<!DOCTYPE html>
        <html lang='pt-br'>
          <head>
            <!-- Bootstrap -->
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>


            <!-- jQuery (plugins JavaScript do Bootstrap) -->
            <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
            <script src='js/bootstrap.min.js'></script>
          </head>
            <body>
                <div class='container'>
                 <!-- Cria o começo da tabela com ID e Multa como colunas -->

                  <table class='table'>
                      <caption><center><strong> Tabela de multas atrasadas </strong></center></caption>
                      <tr>
                       <th>Id do aluno</th>
                       <th>Multas</th>
                      </tr>";
                      while($row = $result->fetch_assoc()) {
                            //echo dos valores do id do Aluno e multas
                        $html .= " <tr>
                                    <td>".$row["idAluno"]."</td>
                                    <td>".$row["multa"]."</td>
                                   </tr>
                                 ";
                          }

$html.= "         </table>
                </div>
            </body>
        </html>";

 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 $mpdf->WriteHTML($html);
 $mpdf->Output();

?>
