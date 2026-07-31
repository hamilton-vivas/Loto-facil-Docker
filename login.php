<?php
include("classes.php");
$objeto = new Login();

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
echo $objeto->login2();
?>
