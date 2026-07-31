<?php
include("classes.php");
$usuario = $_GET['usuario'];

$obj_tela = new Tela();

echo $obj_tela->abreHtml("Tipo Aposta");
echo $obj_tela->abreFormulario("aposta.php");
echo $obj_tela->abreTabela();
echo $obj_tela->telaTipo_aposta("$usuario");
echo $obj_tela->botaoOkLimpar();
echo $obj_tela->fechaTabela();
echo $obj_tela->fechaFormulario();
echo $obj_tela->fechaHtml();

?>

