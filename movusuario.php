<?php
include("classes.php");

if (isset($_POST["usuario"])){
   $usuario = $_POST['usuario'];
   }
if (isset($_POST["nome_usuario"])){
   $nome_usuario = $_POST['nome_usuario'];
   }
if (isset($_POST["cod_usuario"])) {
   $cod = $_POST['cod_usuario'];
}
if (isset($_POST["senha"])) {
   $senha = $_POST['senha'];
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

$objeto = new CadUsuario();
$objtela = new Tela();

 if(isset( $excluir )) {
  $op_ok=$objeto->excluir("usuario","cod_usuario",$cod);
   if(isset($op_ok)) {
   $r_lista=$objeto->listar("usuario","");
   
   echo $objtela->abreHtml("Lista Usuários Apostadores");
   echo $objtela->abreFormulario("");
   echo $objtela->tela_lista_usuario($r_lista,"usuario","f_usuario.php","movusuario.php",$usuario);
   echo $objtela->linha_Menu_apostador($usuario);
   echo $objtela->fechaFormulario();
   echo $objtela->fechaHtml();
  }
 } elseif(isset( $alterar )) {

  echo $objtela->abreFormulario("movusuario.php");
  echo $objtela->abreTabela();
  
  $result_c = $objeto->localizar("usuario","cod_usuario",$cod,"");
  
  echo $objtela->tela_form_usuario($result_c,"usuario","nome_usuario","senha",$usuario);
  echo $objtela->botaoOkLimpar();
  echo $objtela->botaoExcluir();
  echo $objtela->fechaTabela();
  echo $objtela->fechaFormulario();

 }

 if(isset( $enviar )) {
  $op_ok=$objeto->atualizarUsuario($cod,$nome_usuario,$senha);
  if(isset($op_ok)) {
   $r_lista = $objeto->localizar("usuario","cod_usuario",$cod,"");

   echo $objtela->abreHtml("Usuários Apostadores - Sistema LOTOFÁCIL");
   echo $objtela->abreFormulario("");
   echo $objtela->tela_lista_usuario($r_lista,"usuario","f_usuario.php","movusuario.php",$usuario);
   echo $objtela->linha_Menu_apostador($usuario);
   echo $objtela->fechaFormulario();
   echo $objtela->fechaHtml();
  }
 }

?>

