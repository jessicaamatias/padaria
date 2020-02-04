<?php include 'menuAdmin.php'; 
//THIS FILE pageMudarStatus.php DEALS WITH THE CHANGING OF STATUS OF THE ORDERS BY THE ADMIN
?>

<div class="container">
	<h1>Change Order Status</h1>
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
  		$pesquisar="SELECT 
  		controle_venda.id as 'idcontroleVenda',
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
  		 WHERE detalhe_venda.produto_id=produto.id and recheio_sabor.id=detalhe_venda.recheio_id and detalhe_venda.venda_id=controle_venda.id and status !='Coletado' ";
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
      $idcontroleVenda=$linha['idcontroleVenda'];
		    echo "
		    <tr>
		      <th scope='row'>".$i++."</th>
		      <td>".$linha['descricao_produto']."</td>
		      <td>".$linha['peso_bolo']." KG</td>
		      <td>".$linha['descricao_decoracao']." </td>
		      <td>".$linha['quantidade_doce']." </td>
		      <td>".$linha['adicional']."</td>
		      <td>".$linha['usuario_id']."</td>
		      <td>
          <form action='muda_status.php' name='f$i'>
          <select name='muda_status'>   
            <option value='".$linha['status']."'>".$linha['status']."</option>
            <option value='In the Oven '>In the Oven  </option>
            <option value='Finished'>Finished  </option>
            <option value='Delivered'>Delivered</option>
                     
          </select>
          </td>
		      <td>
		  <input name='idvenda' value=$idcontroleVenda type='hidden'>
		  
          <button class='btn btn-success' role='alert'> Apply</button></td>
		    </tr>
        </form>
		   ";
  		$total=0;

		}

echo "  </tbody>
</table>";
		

  	?>



	

</div>

</body>
</html>