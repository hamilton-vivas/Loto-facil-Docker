<?php
include("classes.php");

$objeto1 = new Quadro_loto();
$objeto2 = new Vetor_tupla();
$objeto3 = new Vetor_nrsorteados();
$objeto4 = new Vetor_NAO_sorteados();
$obj_tela = new Tela();

$tipo_aposta = $_POST['tipo_aposta'];
$usuario = $_POST['usuario'];

$result_c = $objeto1->ler_ult_conc();
$result_d = $objeto1->gravar_resultado($result_c);
$tupla_rec = $objeto2->marcar_tupla($result_d);
$sorteio_r = $objeto2->random_tupla($tupla_rec, $tipo_aposta) ;
$vetsort_r = $objeto3->gerar_vetsort($result_d);
$sorteio_n = $objeto3->random_vetsort($vetsort_r, $tipo_aposta, $sorteio_r);
$vetsort_n = $objeto4->gerar_vet_N_sort($result_d);
$sorteio_f = $objeto4->random_vetNsort($vetsort_n, $tipo_aposta, $sorteio_n);

echo $obj_tela->abreHtml("Lista Aposta Gerada");
echo $obj_tela->abreFormulario("");
echo $obj_tela->abreTabela();
echo $obj_tela->tela_resultado($sorteio_f, $tipo_aposta, $usuario);
echo $obj_tela->linha_Menu($usuario);
echo $obj_tela->fechaTabela();
echo $obj_tela->fechaFormulario();
echo $obj_tela->fechaHtml();

?>

