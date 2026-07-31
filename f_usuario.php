<?php
include("classes.php");
$objeto = new Tela();
    if (isset($_GET["usuario"])){
   $usuario = $_GET['usuario'];
   }
echo $objeto->abreHtml("Cadastro Usuário Apostador");
echo $objeto->abreFormulario("cadusuario.php");
echo $objeto->abreTabela();
echo $objeto->tela_form_usuario("","usuario","","",$usuario);
echo $objeto->botaoOkLimpar();
echo $objeto->fechaTabela();
echo $objeto->fechaFormulario();
echo $objeto->fechaHtml();

?>

