<?php 
include 'conexao.php';
$conexao=conexao();

$nome=$_POST['nome'];
$endereco=$_POST['endereco'];
$email=$_POST['email'];
$telefone=$_POST['telefone'];
$senha=$_POST['senha'];

//insert into table cliente (client) the contents received through the form
$sql="insert into cliente (nome,endereco,email,telefone,senha) values ('$nome','$endereco','$email','$telefone','$senha')";
if(mysqli_query($conexao,$sql)){
	header("location:loginteste.php?resposta=<div class='alert alert-success' role='alert'>Registered successfully, now you can login!</div>");
}else{
	header("location:loginteste.php?resposta=<div class='alert alert-danger' role='alert'>
  Alguma coisa saiu errado!</div>");
}
?>