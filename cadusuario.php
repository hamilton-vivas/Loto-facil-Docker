<?php
include("classes.php");

$usuario = $_POST['usuario'];
$nome_usuario = $_POST['nome_usuario'];
$senha = $_POST['senha'];

$objeto = new CadUsuario();
$objtela = new Tela();

$op_ok=$objeto->cadUsuario_1($nome_usuario,$senha);

if(isset($op_ok))
 {
   $r_lista=$objeto->listar("usuario","");
   echo $objtela->abreHtml("Lista Usuários - Sistema LOTOFACIL");
   echo $objtela->abreFormulario("");
   echo $objtela->tela_lista_usuario($r_lista,"usuario","f_usuario.php","movusuario.php",$usuario);
   echo $objtela->linha_Menu_apostador($usuario);
   echo $objtela->fechaFormulario();
   echo $objtela->fechaHtml();
 }
?>

