<?php
include("classes.php");
$objeto1 = new Operacao();
$objeto2 = new Tela();
$nr_concurso = $_POST['nr_concurso'];
$usuario = $_POST['usuario'];

echo $objeto2->abreHtml("Concursos Anteriores - Lotofacil");
echo $objeto2->abreFormulario("movconc.php");
echo $objeto2->linha_Menu($usuario);
echo $objeto2->abreTabela();
$result_c = $objeto1->localizar("conc_ant","nr_concurso",$nr_concurso,"nr_concurso");
echo $objeto2->tela_lista_concurso($result_c,"conc_ant","f_concurso.php","movconc.php",$usuario);
echo $objeto2->fechaFormulario();
echo $objeto2->fechaHtml();
?>

