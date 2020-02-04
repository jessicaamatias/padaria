<?php
//THIS FILE logar.php DEALS WITH THE LOGIN PROCESS, SEARCHING USER AND PASSWORD SAVED IN THE DATABASE
session_start();
include 'conexao.php';
$conexao=conexao();

$email=$_POST['email'];$senha=$_POST['senha'];//senha = password
$sql="select * from cliente where senha='$senha' and email='$email' ";
$sqlAdmin="select * from usuario where senha='$senha' and email='$email' ";
$resultado=mysqli_query($conexao,$sql);
$resultadoAdmin=mysqli_query($conexao,$sqlAdmin);
if($linha=mysqli_fetch_assoc($resultado)){
	$_SESSION['id']=$linha['id'];
	$_SESSION['nome']=$linha['nome'];
	//prints welcome message with the user name
	header("location:prices.php?resposta=<div class='alert alert-success' role='alert'>Welcome, ".$linha['nome']."!</div>");
//in the case of it being an admin accessing:
}else if($linha=mysqli_fetch_assoc($resultadoAdmin)){
	$_SESSION['id']=$linha['id'];
	$_SESSION['nome']=$linha['nome'];
	$_SESSION['nivel_acesso']=$linha['nivel_acesso'];
	header("location:areaAdmin.php?resposta=<div class='alert alert-success' role='alert'>Welcome, ".$linha['nome']."!</div>");
}else{
header("location:loginteste.php?respostaErroLogin=<div class='alert alert-danger' role='alert'>Your username or password is incorrect!</div>");
}
?>