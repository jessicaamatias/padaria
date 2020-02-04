
<?php
//THIS FILE agendar.php IS THE FILE THAT DEALS WITH BOOKINGS - INSERTING DATA IN THE DATABASE
//using timezone of Brazil that is where the webpage will be used
date_default_timezone_set('America/Sao_Paulo');
session_start();
include'conexao.php';
$conexao=conexao();
if (!isset($_SESSION['id'])) {
	//message to be shown if user is not logged in
		header("location:loginteste.php?respostaErroLogin=<div class='alert alert-danger' role='alert'>Please login to start your booking!</div>");
}else{

	$data_entrega ="";//=delivery_date
	$diasemana ="";//=week_day
	$data_entrega= $_POST['data_entrega'];
	
	//verifies the day of the week of the sent date
	//if it is a Monday, it will redirect to the previous page with the alert message		
	if (setlocale(LC_TIME, 'pt')) {
	    $diasemana= strftime("%A", strtotime($data_entrega));
	}
		if($diasemana=="segunda-feira"){//segunda-feira == Monday
				header("location:prices.php?resposta=<div class='alert alert-danger' role='alert'>On Mondays the bakery is not open, choose another day!</div>");
		}else{
		//inicializing the variables
			$idproduto="";
			$descricao_decoracao="";
			$peso_bolo=0;
			$quantidade_doce=0;
			$recheio_id=NULL; //here is the id of the cake flavour registered in the database
			$adicional="";
			$cliente_id="";

			$idproduto=$_POST['idproduto'];
			$cliente_id=$_SESSION['id'];

			$sabor_doce1=NULL;
			$sabor_doce2=NULL;

		//verificando se chegou algum dado e atualizar valor das variaveis
		//verifying if any data was received and update the value of the variables
		if (isset($_POST['descricao_decoracao'])) {
			$descricao_decoracao=$_POST['descricao_decoracao'];//=description_decoration
			
		}
		if (isset($_POST['peso_bolo'])) {//=cake_weight
			$peso_bolo=$_POST['peso_bolo'];
			
		}
		if (isset($_POST['quantidade_doce'])) {//=quantity_sweets
			$quantidade_doce=$_POST['quantidade_doce'];
			
		}
		if (isset($_POST['recheio_id'])) {//=flavour_id
			$recheio_id=$_POST['recheio_id'];
			
		}else{
			$recheio_id=3;
		}

		if (isset($_POST['adicional'])) {//adicional refers to the diet restriction that is charged 10R$ extra
			$adicional=$_POST['adicional'];
		}

		if (isset($_POST['recheio_id'])) {
			$recheio_id=$_POST['recheio_id'];
			
		}

		//controle de venda tipo numeracao
		//sale control with number
		$insere_controle_venda="INSERT INTO 
		controle_venda(cliente_id, data_entrega)
		VALUES ($cliente_id,  '$data_entrega')";
		mysqli_query($conexao,$insere_controle_venda);
		$ultimo_id_controle_venda=mysqli_insert_id($conexao);//gets the number of the id inserted in the above table


		//produto_misto = mixed_product, which is the equivalent of two services (cake + sweets) that counts as 2	
		$pes_quantidade1="SELECT COUNT(*) as 'quantidade_resultado' FROM detalhe_venda,produto WHERE produto_id=produto.id and produto.misto=1";

		$pes_quantidade2="SELECT COUNT(*) as 'quantidade_resultado' FROM detalhe_venda,produto WHERE produto_id=produto.id and produto.misto=0";
		
		//researches in the table detalhe_venda(sale_detail) to know the quantity of bookings for the chosen date
		$res=mysqli_query($conexao,$pes_quantidade1);
		$res2=mysqli_query($conexao,$pes_quantidade2);

		$res=mysqli_fetch_assoc($res);
		$res2=mysqli_fetch_assoc($res2);

		
		$resultado=$res['quantidade_resultado'] * 2;//multiplies by 2 if it refers to a mixed_product as it takes double the time
		$resultado+=$res2['quantidade_resultado'];

		if ($resultado <16 && $idproduto != 4) { //the number of orders needs to be below the number of available chefs multiplied by 4 as the chefs can only work on 4 orders each.

			//insert the sale details in the table
			 $insere_detalhes_venda="INSERT INTO detalhe_venda
			(produto_id, descricao_decoracao, peso_bolo, quantidade_doce, recheio_id,adicional, venda_id)
			 VALUES ($idproduto,'$descricao_decoracao',$peso_bolo,$quantidade_doce,'$recheio_id',
			'$adicional',$ultimo_id_controle_venda)";
			mysqli_query($conexao,$insere_detalhes_venda);

			
			$insere_detalhes_venda_doce="";//=insert_details_sale_sweets
			if (isset($_POST['sabor_doce1'])) {//=sweets_flavour1
				$sabor_doce1=$_POST['sabor_doce1'];
				$insere_detalhes_venda_doce="INSERT INTO detalhe_venda_doce(recheio_sabor_id, controle_venda_id) VALUES ($sabor_doce1,$ultimo_id_controle_venda)";

			}
			if (isset($_POST['sabor_doce2'])) {
				$sabor_doce2=$_POST['sabor_doce2'];
				$insere_detalhes_venda_doce.=", ($sabor_doce2,$ultimo_id_controle_venda)";
			} 
			mysqli_query($conexao,$insere_detalhes_venda_doce);
			header("location:prices.php?resposta=<div class='alert alert-success' role='alert'>Your order has been completed!</div>");

		}else{//if the result is more than 16 it won't be possible to make more orders for that date
			header("location:prices.php?resposta=<div class='alert alert-danger' role='alert'> Sorry, there are too many orders booked for this day, please choose another day!</div>");
		}
	}
}

?>