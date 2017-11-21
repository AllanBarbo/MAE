<!--
Grupo: MAE
  Data de modifica��o: 20/11/2017
  Autor: Emanuela Amorim
    Objetivo da modifica��o: fazer filtragem
-->
<?php

//Inclui a biblioteca do MPDF
include("mpdf60/mpdf.php");

// Cria conex�o
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conex�o
if ($conn->connect_error) {
    die("Conec��o falhou: " . $conn->connect_error);
}

//recebe via POST o Id do aluno a ser pesquisado,se n�o tiver nada no input ele manda o pdf com os dados
if (!empty($_POST["nomeAlunoPesquisa"])) {
  $nomeAlunoPesquisa=$_POST["nomeAlunoPesquisa"];

  $stmt = $conn->prepare("SELECT * FROM alunos WHERE nome = ?");
  $stmt->bind_param('s',$nomeAlunoPesquisa);
  $stmt->execute();
  $rst = $stmt->get_result(); 

  while($row  = $rst->fetch_assoc()){
    $idAluno = $row['idCPF'];
    $nomeAluno = $row['nome'];
    //echo $nomeAluno. " - " .$idAluno;
  }

  $stmt = $conn->prepare("SELECT * FROM  emprestimos WHERE idaluno = ?");
  $stmt->bind_param('s', $idAluno);
  $stmt->execute();
  $rst = $stmt->get_result();

  while($row = $rst->fetch_assoc()){
    $dataPrevisaoDevolucao = $row['dataPrevisaoDevolucao'];
    $dataDevolucao = $row['dataDevolucao'];
    //echo "<br>".$dataPrevisaoDevolucao. " - " .$dataDevolucao;
  }

//itesct5.0.2

}
else {
  //Seleciona da tabela emprestimos os dados
  $sql = "SELECT * FROM emprestimos ORDER BY idAluno ASC";
  $result = $conn->query($sql);
}

  $stmt = $conn->prepare("SELECT * FROM  emprestimos WHERE idaluno = ?");
  $stmt->bind_param('s', $idAluno);
  $stmt->execute();
  $rst = $stmt->get_result();

$html = "
                    <table class='table'>
                      <caption><center><strong> TABELA DE ATRASOS </strong></center></caption>
                      <tr>
                       <th>Id do aluno &emsp;</th>
                       <th>Data prevista para devolucao &emsp;</th>
                       <th>Data de devolucao &emsp;</th>
                      </tr>";

while($row = $rst->fetch_assoc()) {

                            //echo dos valores do id do Aluno e datas
                        $html .= " <tr>
                                    <td>".$row['idAluno']."</td>
                                    <td>".$row["dataPrevisaoDevolucao"]."</td>
                                    <td>".$row["dataDevolucao"]."</td>
                                   </tr>
                                 ";
                          }
                           
$html.= "         </table>
                </div>
            </body>
        </html>";

//cria nome do arquivo de acordo com a data atual
$nomeDoArquivo = "Relatorio de atrasos(" .$dataAtual. ").pdf"; 
 //cria a Data da gera��o do arquivo
$dataAtual = date("d-m-y");

 $mpdf = new mPDF();
 $mpdf -> SetTitle($nomeDoArquivo);
 $mpdf -> SetDisplayMode('fullpage');
 $mpdf -> WriteHTML($html);
 $mpdf -> Output($nomeDoArquivo, 'D');

?>