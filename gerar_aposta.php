<?php
include("classes.php");
$usuario = $_GET['usuario'];
$objeto = new Tela();

echo $objeto->abreHtml("Abertura Loto Facil");
echo "<font color='#003399'>";
print "APOSTADOR:   ";
print "&nbsp;";
print "&nbsp;";
print $usuario;
print "<br>";
print "<br>";
print "<br>";
print "<b>MENU APOSTA:</b>";
//print "&nbsp;";
//print "&nbsp;";
//print "&nbsp;";
//print "<br>";
print "<br>";

echo "<A HREF='tp_aposta_verif.php?usuario=$usuario'>Gerar Aposta <font color='#CC0033'>consultando todos concursos anteriores</font> cadastrados no sistema</A><br> ";
print "<br>";
echo "<A HREF='tipo_aposta.php?usuario=$usuario'>Gerar Aposta baseada no <font color='#CC0033'>ÚLTIMO CONCURSO</font> cadastrado, <font color='#CC0033'>NÃO</font> consultando concursos anteriores  </A><br> ";
echo "</font>";
echo $objeto->fechaHtml();
?>

