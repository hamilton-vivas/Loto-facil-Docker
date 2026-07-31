<?php
include("classes.php");
$objeto = new Tela();
$usuario = $_GET['usuario'];

echo $objeto->abreHtml("Concursos Anteriores");
echo $objeto->abreFormulario("loc_concurso.php");
echo $objeto->abreTabela();
echo $objeto->telaLocalizacao("Lotofacil","nr_concurso",$usuario);
echo $objeto->botaoOkLimpar();
echo $objeto->fechaTabela();
echo $objeto->fechaFormulario();
echo $objeto->fechaHtml();
?>

