<?php
include("classes.php");

if (isset($_POST["usuario"])){
   $usuario = $_POST['usuario'];
   }
if (isset($_POST["nr_concurso"])){
   $nr_concurso = $_POST['nr_concurso'];
   }
if (isset($_POST["cod_conc"])) {
   $cod = $_POST['cod_conc'];
}
if (isset($_POST["dez_01"])) {
   $dez_01 = $_POST['dez_01'];
}
if (isset($_POST["dez_02"])) {
   $dez_02 = $_POST['dez_02'];
}
if (isset($_POST["dez_03"])) {
   $dez_03 = $_POST['dez_03'];
}
if (isset($_POST["dez_04"])) {
   $dez_04 = $_POST['dez_04'];
}
if (isset($_POST["dez_05"])) {
   $dez_05 = $_POST['dez_05'];
}
if (isset($_POST["dez_06"])) {
   $dez_06 = $_POST['dez_06'];
}
if (isset($_POST["dez_07"])) {
   $dez_07 = $_POST['dez_07'];
}
if (isset($_POST["dez_08"])) {
   $dez_08 = $_POST['dez_08'];
}
if (isset($_POST["dez_09"])) {
   $dez_09 = $_POST['dez_09'];
}
if (isset($_POST["dez_10"])) {
   $dez_10 = $_POST['dez_10'];
}
if (isset($_POST["dez_11"])) {
   $dez_11 = $_POST['dez_11'];
}
if (isset($_POST["dez_12"])) {
   $dez_12 = $_POST['dez_12'];
}
if (isset($_POST["dez_13"])) {
   $dez_13 = $_POST['dez_13'];
}
if (isset($_POST["dez_14"])) {
   $dez_14 = $_POST['dez_14'];
}
if (isset($_POST["dez_15"])) {
   $dez_15 = $_POST['dez_15'];
}
if (isset($_GET["cod"])){
   $cod = $_GET['cod'];
   }
   if (isset($_GET["usuario"])){
   $usuario = $_GET['usuario'];
   }

if (isset($_POST["ENVIAR"])){
         $enviar = $_POST['ENVIAR'];       // Entra se "submit" existe e não é null
  }
if (isset($_POST["EXCLUIR"])){
         $excluir = $_POST['EXCLUIR'];     // Entra se "submit" existe e não é null
  }
if (isset($_GET["EXCLUIR"])){
    $excluir = $_GET['EXCLUIR'];
    }
if (isset($_GET["ALTERAR"])){
    $alterar = $_GET['ALTERAR'];
    }

$objeto = new CadConc();
$objtela = new Tela();

 if(isset( $excluir )) {
  $op_ok=$objeto->excluir("conc_ant","cod_conc",$cod);
   if(isset($op_ok)) {
    $r_lista=$objeto->listar("conc_ant","nr_concurso");
    echo $objtela->abreHtml("Lista Concursos Anteriores");
    echo $objtela->abreFormulario("");
    echo $objtela->linha_Menu($usuario);
    echo $objtela->tela_lista_concurso($r_lista,"conc_ant","f_concurso.php","movconc.php",$usuario);
    //echo $objtela->linha_Menu($usuario);
    echo $objtela->fechaFormulario();
    echo $objtela->fechaHtml();
  }
 } elseif(isset( $alterar )) {
    echo $objtela->abreFormulario("movconc.php");
    echo $objtela->abreTabela();
    $result_c = $objeto->localizar("conc_ant","cod_conc",$cod,"");
    echo $objtela->tela_formulario($result_c,"conc_ant","nr_concurso","dez_01","dez_02","dez_03","dez_04","dez_05",
    "dez_06","dez_07","dez_08","dez_09","dez_10","dez_11","dez_12","dez_12","dez_14","dez_15",$usuario);
    echo $objtela->botaoOkLimpar();
    echo $objtela->botaoExcluir();
    echo $objtela->fechaTabela();
    echo $objtela->fechaFormulario();
 }
  if(isset( $enviar )) {
   $op_ok=$objeto->atualizarConc($cod,$nr_concurso,$dez_01,$dez_02,$dez_03,$dez_04,$dez_05,$dez_06,$dez_07,$dez_08,
   $dez_09,$dez_10,$dez_11,$dez_12,$dez_13,$dez_14,$dez_15);
  if(isset($op_ok)) {
   $r_lista = $objeto->localizar("conc_ant","cod_conc",$cod,"");
   echo $objtela->abreHtml("Concursos Anteriores");
   echo $objtela->abreFormulario("");
   echo $objtela->linha_Menu($usuario);
   echo $objtela->tela_lista_concurso($r_lista,"conc_ant","f_concurso.php","movconc.php",$usuario);
   echo $objtela->fechaFormulario();
   echo $objtela->fechaHtml();
  }
 }
?>

