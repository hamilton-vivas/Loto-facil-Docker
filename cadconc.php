<?php
include("classes.php");

$usuario = $_POST['usuario'];
$nr_concurso = $_POST['nr_concurso'];
$dez_01 = $_POST['dez_01'];
$dez_02 = $_POST['dez_02'];
$dez_03 = $_POST['dez_03'];
$dez_04 = $_POST['dez_04'];
$dez_05 = $_POST['dez_05'];
$dez_06 = $_POST['dez_06'];
$dez_07 = $_POST['dez_07'];
$dez_08 = $_POST['dez_08'];
$dez_09 = $_POST['dez_09'];
$dez_10 = $_POST['dez_10'];
$dez_11 = $_POST['dez_11'];
$dez_12 = $_POST['dez_12'];
$dez_13 = $_POST['dez_13'];
$dez_14 = $_POST['dez_14'];
$dez_15 = $_POST['dez_15'];

$objeto = new CadConc();
$objtela = new Tela();

$op_ok=$objeto->cadConc_1($nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,$dez_08,$dez_09,
                          $dez_10,$dez_11,$dez_12,$dez_13,$dez_14,$dez_15);
if(isset($op_ok))
 {
   $r_lista=$objeto->listar("conc_ant","nr_concurso");
   
   echo $objtela->abreHtml("Lista Concursos Anteriores -LOTOFACIL");
   echo $objtela->abreFormulario("");
   echo $objtela->linha_Menu($usuario);
   echo $objtela->tela_lista_concurso($r_lista,"conc_ant","f_concurso.php","movconc.php",$usuario);
   echo $objtela->fechaFormulario();
   echo $objtela->fechaHtml();
 }
?>

