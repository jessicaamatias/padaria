<?php include 'menuAdmin.php'; 
//THIS FILE areaAdmin.php IS THE FILE THAT DEALS WITH THE ADMIN MENU AND SHOWS THE TABLE OF ORDERS FROM THE DATABASE
?>

<div class="container">
	<h1>List of Orders</h1>
      <?php 
            if (isset($_GET['resposta'])) {
                echo $_GET['resposta'];
            }
        ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">N</th>
      <th scope="col">Description </th>
      <th scope="col">Weight</th>
      <th scope="col">Decoration</th>
      <th scope="col">Sweets Quantity</th>
      <th scope="col">Diet Restriction</th>
      <th scope="col">Responsible Chef</th>
      <th scope="col">Status</th>
      <th scope="col">Total Price</th>
    </tr>
  </thead>
  <tbody>
	
	  <?php 
	  //selecting data from the database to show for the admin
  		$pesquisar="SELECT 
  		produto.descricao as 'descricao_produto',
  		produto.preco,
  		detalhe_venda.peso_bolo,
  		detalhe_venda.descricao_decoracao,
  		detalhe_venda.quantidade_doce,
  		detalhe_venda.adicional,
  		controle_venda.usuario_id,
  		controle_venda.status,
  		recheio_sabor.descricao
  		FROM detalhe_venda,produto, recheio_sabor,controle_venda
  		 WHERE detalhe_venda.produto_id=produto.id and recheio_sabor.id=detalhe_venda.recheio_id and detalhe_venda.venda_id=controle_venda.id  ";
  		$resultado=mysqli_query($conexao,$pesquisar);
  		$i=1;
  		$total=0;
		while ($linha=mysqli_fetch_assoc($resultado)){
			if ($linha['adicional'] !="") {
				$total=10;
			}
			if ($linha['descricao_decoracao'] !="") {
				$total+=20;
				echo $linha['descricao_decoracao'];
			}
			$total+=($linha['preco']*$linha['peso_bolo'])+ $linha['quantidade_doce'];

		    echo "
		    <tr>
		      <th scope='row'>".$i++."</th>
		      <td>".$linha['descricao_produto']."</td>
		      <td>".$linha['peso_bolo']." KG</td>
		      <td>".$linha['descricao_decoracao']." </td>
		      <td>".$linha['quantidade_doce']." </td>
		      <td>".$linha['adicional']."</td>
		      <td><div class='p-3 mb-2 bg-success text-white'>";
		      if (isset($linha['usuario_id'])) {
		      
		      $linha2=mysqli_fetch_assoc(mysqli_query($conexao,"select nome from 
		      		usuario where id=".$linha['usuario_id'].""));
		      echo $linha2['nome'];
	
		      }
		      echo"</div></td>
		      <td><div class='p-3 mb-2 bg-primary text-white'>".$linha['status']."</div> </td>
		      <td><div class='p-3 mb-2 bg-danger text-white'>Total: R$ $total</div></td>
		      
		    </tr>
		   ";
  		$total=0;

		}

echo "  </tbody>
</table>";
		

  	?>



	

</div>

</body>
</html>