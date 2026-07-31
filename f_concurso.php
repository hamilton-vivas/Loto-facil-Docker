<?php
include("classes.php");
$objeto = new Tela();

if (isset($_GET["usuario"])){
  $usuario = $_GET['usuario'];
  }
echo $objeto->abreHtml("Cadastro Concursos Anteriores");
echo $objeto->abreFormulario("cadconc.php");
echo $objeto->abreTabela();
echo $objeto->tela_formulario("","conc_ant","","","","","","","","","","","","","","","","",$usuario);
echo $objeto->botaoOkLimpar();
echo $objeto->fechaTabela();
echo $objeto->fechaFormulario();
echo $objeto->fechaHtml();
?>

