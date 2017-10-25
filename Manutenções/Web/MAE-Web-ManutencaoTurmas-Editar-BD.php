<?php
// Verifica se usuário escolheu algum nome
if(isset($_POST["select"]))
{
    // Faz loop para os livros
    foreach($_POST["select"] as $nome)
    {
      //seta a variavel $nome com o input do select
    }
    echo"$nome";


}

?>
