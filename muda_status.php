<?php
//THIS FILE muda_status DEALS WITH THE CHANGING OF STATUS OF THE ORDER
session_start();
include 'conexao.php';
$conexao=conexao();
$status=$_GET['muda_status'];
$idvenda=$_GET['idvenda'];

//updating status
$sql="UPDATE  controle_venda set status='$status' where id=$idvenda";
$resultado=mysqli_query($conexao,$sql);

//printing success message
header("location:areaAdmin.php?resposta=<div class='alert alert-success' role='alert'>Status changed successfully!</div>");

?>