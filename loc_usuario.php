<?php
include("classes.php");

$objeto1 = new Operacao();
$objeto2 = new Tela();

$nome_usuario = $_POST['nr_concurso'];
$usuario = $_POST['usuario'];

echo $objeto2->abreHtml("Concursos Anteriores - Lotofacil");
echo $objeto2->abreFormulario("movusuario.php");
echo $objeto2->abreTabela();
$result_c = $objeto1->localizar("usuario","usuario",$nome_usuario,"");
echo $objeto2->tela_lista_usuario($result_c,"usuario","f_usuario.php","movusuario.php",$usuario);
echo $objeto2->linha_Menu_apostador($usuario);
echo $objeto2->fechaFormulario();
echo $objeto2->fechaHtml();
?>

