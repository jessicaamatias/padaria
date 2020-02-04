<?php
//THIS FILE muda_subchef.php DEALS WITH ASSIGNING A CHEF TO EACH ORDER
session_start();
include 'conexao.php';
$conexao=conexao();
$muda_usuario=$_GET['muda_usuario'];
$idvenda=$_GET['idvenda'];

//updates chef 
$sql="UPDATE  controle_venda set usuario_id=$muda_usuario where id=$idvenda";
$resultado=mysqli_query($conexao,$sql);

header("location:areaAdmin.php?resposta=<div class='alert alert-success' role='alert'>Chef Assigned Successfully!</div>");

?>