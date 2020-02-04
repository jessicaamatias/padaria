<?php include 'menuAdmin.php'; ?>

<div class="container">
	<h1>Assign Chef to Order</h1>
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
  		 WHERE detalhe_venda.produto_id=produto.id and recheio_sabor.id=detalhe_venda.recheio_id and detalhe_venda.venda_id=controle_venda.id
        and status !='Coletado'";

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
      $idControleVenda=$linha['idcontroleVenda'];

		    echo "
		    <tr>
		      <th scope='row'>".$i++."</th>
		      <td>".$linha['descricao_produto']."</td>
		      <td>".$linha['peso_bolo']." KG</td>
		      <td>".$linha['descricao_decoracao']." </td>
		      <td>".$linha['quantidade_doce']." </td>
		      <td>".$linha['adicional']."</td>
		      <td>
          <form action='muda_subchefe.php' name='f$i'>
          ";
		  // para listar todos os usuarios no select
		  //to list all users in the select from the table usuario (user)
      $pes_usu="SELECT * FROM usuario ";
      $result=mysqli_query($conexao,$pes_usu);
    echo "<select name='muda_usuario'>";
    echo"<option value='".$linha['usuario_id']."'>".utf8_encode($linha2['nome'])."</option>";

    while ($linha2=mysqli_fetch_assoc($result)){
          echo "
            <option value='".$linha2['id']."'>".utf8_encode($linha2['nome'])."</option>
          ";
        }
echo "</select>";
          echo "</td>
		      <td>".$linha['status']."</td>
		      <td>
          <input name='idvenda' value=$idControleVenda type='hidden'>
          <button class='btn btn-success' role='alert'> Apply</button></td>
        </form>
          </td>
		      
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