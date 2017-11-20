<?php

  /*
  Grupo:? ? MAE
	Data? ? de? ? modifica��o:? ? 30/10/2017
	Autor:? ? Emanuela Amorim
    Objetivo da modifica��o: ria��o do script da gera��o do arquivo para download dos relat�rios de atraso
 */

//Inclui a biblioteca do MPDF
include("mpdf60/mpdf.php");

// Cria conex�o
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conex�o
if ($conn->connect_error) {
    die("Conec��o falhou: " . $conn->connect_error);
}

//recebe via POST o Id do aluno a ser pesquisado,se n�o tiver nada no input ele manda o pdf com TODAS as multas
if (!empty($_POST["idAlunoPesquisa"])) {
  $idAlunoPesquisa=$_POST["idAlunoPesquisa"];

  //Seleciona do BD o ID do aluno com as suas multas correspondentes
  $sql = "SELECT * FROM emprestimos WHERE idAluno = $idAlunoPesquisa ";
  $result = $conn->query($sql);
}
else {
  //Seleciona da tabela emprestimos todas as multas
  $sql = "SELECT * FROM emprestimos ORDER BY idAluno ASC";
  $result = $conn->query($sql);
}

$html = "
                    <table class='table'>
                      <caption><center><strong> Tabela de atrasos </strong></center></caption>
                      <tr>
                       <th>Id do aluno &emsp;</th>
                       <th>Data prevista para devolucao &emsp;</th>
                       <th>Data de devolucao &emsp;</th>
                      </tr>";

//Seta as op��es do Bootstrap no html e o c�digo para gerar a tabela que seleciona o ID do aluno e suas multas
while($row = $result->fetch_assoc()) {
                            //echo dos valores do id do Aluno e multas
                        $html .= " <tr>
                                    <td>".$row["idAluno"]."</td>
                                    <td>".$row["dataPrevisaoDevolucao"]."</td>
                                    <td>".$row["dataDevolucao"]."</td>
                                   </tr>
                                 ";
                          }
                           
$html.= "         </table>
                </div>
            </body>
        </html>";


$dataAtual = date("d-m-y"); //cria a Data da gera��o do arquivo
$nomeDoArquivo = "Relatorio de atrasos(" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

 $mpdf = new mPDF();
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');

?>