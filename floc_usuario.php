<?php
include("classes.php");
$objeto = new Tela();
$usuario = $_GET['usuario'];

echo $objeto->abreHtml("Cadastro Usuario");
echo $objeto->abreFormulario("loc_usuario.php");
echo $objeto->abreTabela();
echo $objeto->telaLocalizacao("Apostador","nr_concurso",$usuario);
echo $objeto->botaoOkLimpar();
echo $objeto->fechaTabela();
echo $objeto->fechaFormulario();
echo $objeto->fechaHtml();
?>

