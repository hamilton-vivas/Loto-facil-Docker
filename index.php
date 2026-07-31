<?php
include("classes.php");
$objeto = new Tela();

echo $objeto->abreHtml("Login");
echo $objeto->abreFormulario("login.php");
echo $objeto->abreTabela();
echo $objeto->telaLogin("usuario","senha");
echo $objeto->botaoOkLimpar();
echo $objeto->fechaTabela();
echo $objeto->fechaFormulario();
echo $objeto->fechaHtml();
?>
