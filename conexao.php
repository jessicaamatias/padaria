<?php 
//THIS FILE conexao.php MAKES THE CONNECTION WITH THE DATABASE
   	function conexao(){
		$servidor = "localhost";
	    $usuario = "root";
	    $senha = "";
	    $dbname = "padaria";
	    $conexao = mysqli_connect($servidor, $usuario, $senha, $dbname);

	    return $conexao;
	}
		
 ?>
 