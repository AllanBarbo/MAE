<?php

  /*
  Grupo:? ? MAE
	Data? ? de? ? modifica��o:? ? 09/10/2017
	Autor:? ? Allan Barbosa
? ? ? ? ? ? ? ? ?Objetivo? ? da? ? modifica��o:? Cria��o do script da gera��o do arquivo para download dos relat�rios de multas

        Coment�rio do desenvolvedor: Desculpe pela "gambiarra" usando v�rios echos, n�o sei fazer de outra forma ;-;
  */

//Inclui a biblioteca do MPDF
include("C:/wamp64/www/MAE/mpdf60/mpdf.php");

// Cria conex�o
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conex�o
if ($conn->connect_error) {
      die("Conec��o falhou: " . $conn->connect_error);
}

//recebe via POST o Id do aluno a ser pesquisado,se n�o tiver nada no input ele retorna para a p�gina HTML
if (isset($_POST["idAlunoPesquisa"])) {
  $idAlunoPesquisa=$_POST["idAlunoPesquisa"];

  //Seleciona do BD o ID do aluno com as suas multas correspondentes
  $sql = "SELECT * FROM emprestimos WHERE idAluno = $idAlunoPesquisa ";
  $result = $conn->query($sql);
}
else {
  $url="http://localhost/MAE/MAE-Web-RelatorioAtraso-Aluno.html";
  echo '<script>window.location = "'.$url.'";</script>';
}

//Seta as op��es do Bootstrap no html e o c�digo para gerar a tabela que seleciona o ID do aluno e suas multas
$html = "
                    <table class='table'>
                      <caption><center><strong> Tabela de atrasos do aluno</strong></center></caption>
                      <tr>
                       <th>Id do aluno</th>
                       <th>Data prevista de devolucao</th>
                       <th>Data de devolucao</th>
                      </tr>";
                      
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
$nomeDoArquivo = "Minhas multas (" .$dataAtual. ").pdf"; //cria nome do arquivo de acordo com a data atual

 $mpdf = new mPDF();
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');
?>