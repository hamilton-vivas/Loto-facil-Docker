<?php
include("classes.php");
$usuario = $_GET['usuario'];
$objeto = new Tela();

echo $objeto->abreHtml("Abertura Loto Facil");
echo "<font color='#003399'>";
print "BEM VINDO:   ";
print "&nbsp;";
print "&nbsp;";
print $usuario;
print "<br>";
print "<br>";
print "Ao Sistema Lotofacil";
print "<br>";
print "<br>";
print "APOSTE COM MODERAÇÃO !!!!";
print "<br>";
print "<br>";
print "<b>MENU DO SISTEMA:</b>";
print "<br>";
echo "<A HREF='floc_concurso.php?usuario=$usuario'><font color='#CC0033'>Listar Concurso</font></A><br> ";
echo "<A HREF='gerar_aposta.php?usuario=$usuario'><font color='#CC0033'>Gerar Aposta</font></A><br> ";
echo "<A HREF='floc_usuario.php?usuario=$usuario'><font color='#CC0033'>Cadastro Usuário</font></A><br> ";
//echo "<A HREF='lendo_texto.php?usuario=$usuario'><font color='#CC0033'>LENDO TEXTO</font></A><br> ";

echo "</font>";
print "<br>";
echo "<A HREF='index.php?usuario=$usuario'>SAIR</A><br> ";
echo $objeto->fechaHtml();
?>
