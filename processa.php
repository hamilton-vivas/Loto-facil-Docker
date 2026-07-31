<?php

// Arquivo (processa.php) que executa o arquivo TXT e grava resultado no Banco de Dados
 include("classes.php");
 $objeto = new Cadconc_Ant();
 $objtela = new Tela();
 
//$arquivo = $_FILES['arquivo'];
//var_dump($arquivo);

$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
//var_dump($arquivo_tmp);

$Ok=$objeto->Ler_arquivo_txt($arquivo_tmp);

echo $objtela->abreHtml("Lista Concursos Anteriores -LOTOFACIL");
echo $objtela->abreFormulario("");
echo $Ok;
echo $objtela->fechaFormulario();
echo $objtela->fechaHtml();

?>

