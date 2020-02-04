<?php session_start();
//THIS FILE detalhar_escolha.php DEALS WITH THE DETAILS OF EACH TYPE OF ORDER
include'conexao.php';
$conexao=conexao();?>
<html>
<head>
    <title> User login and registration </title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
    <link rel="stylesheet" type="text/css" 
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


</head>
<body>

    <div class="navbar">
      <a href="index.php" >Home</a>
      <a href="prices.php">Options and Prices</a>
      
      <?php 
      if (isset($_SESSION['id'])) {
        echo "<a href='sair.php' >Log out</a>";
    }else{
        echo "<a href='loginteste.php' >Log in / Register</a>";
    }
    ?>

</div>
        <script type="text/javascript" src="ajax.js"></script>
<div class="container">
    <div class="login-box">
        <div class="row">

            <div class="col-md-12 login-right">
              
              <?php 

                  $idproduto="";
                  //waits for a variable GET that brings an id from the details page and the choice of the options of products, with this it's known the id of each option
                  //espera uma variavel GET que trás um id da pagina de detalhes e escolha das opções dos produtos, com isso sabes se a qual id pertece cada opção
                  if($_GET['opcao']=="Birthday Cake"){
                    $idproduto=1;
                  }else if($_GET['opcao']=="Wedding Cake"){
                    $idproduto=2;
                  }if($_GET['opcao']=="Party Sweets"){
                    $idproduto=3;
                  }else if($_GET['opcao']=="Cake and Sweets"){
                    $idproduto=4;
                  }
              ?>
              
                <h2>Select the Details of your Order</h2>
              <?php 
              //espera uma variavel GET que trás uma resposta de uma ação iniciada apartir desta pagina
              //waits for a variable GET that brings an answer from an action initiaded from this page
                if (isset($_GET['resposta'])) {//verifica se veio alguma resposta GET
                    echo $_GET['resposta'];
                }
              ?>

                <div class="w3-third w3-margin-bottom">
                  <form action="agendar.php" method="post">
                  <!-- stores in a hidden way the id of the product cadastered previously in the database -->
                  <input type="hidden" name="idproduto" value="<?php echo $idproduto; ?>">
                    <ul class="w3-ul 
                    w3-border w3-hover-shadow">
                      <h3><b>
                        <?php
                         if(isset($_GET['opcao'])){
                          echo $_GET['opcao'];
                          echo "<input type='hidden' name='opcao' value='".$_GET['opcao']."'>";
                        }

                        ?>
                            
                        </b></h3>

                      <?php 
                      //used to verify if the selected product in the previous screen is necessary to visualize the options of the below select
                      //utilizado para verifica se o produto selecionado na tela anterior faz se necessário a visualização das opções do select abaixo
                      //compares if it's different than party sweets   
                      if($_GET['opcao']!="Party Sweets"){
                       ?>
                          <li class="w3-padding-16"><b>Weight of the Cake:</b>
                            <br>
                              <select name="peso_bolo" id="quilo_misto" onchange="alterar_preco_misto(0);" >
                                <option value=1>1 kg</option>
                                <option value=2>2 kg</option>
                                <option value=3>3 kg</option>
                                <option value=4>4 kg</option>
                                <option value=5>5 kg</option>
                              </select>
                              <br>
                          </li>
                    <?php 
                        }else{
                            echo "<input type='hidden' id='quilo_misto' value=0>";
                        }
                    ?>
                  
                  <?php 
                  //used to verify if the selected product in the previous screen is necessary to visualize the options of the below select
                  //if the option is either party sweets or cake and sweets      
                  if($_GET['opcao']=="Party Sweets" || $_GET['opcao']=="Cake and Sweets"){
                      ?>

                      <li class="w3-padding-16"><b>Quantity of Sweets:</b>
                      <br>
                      <select name="quantidade_doce" id="unidade_misto" onchange="alterar_preco_misto(0);">
                            <option value=50>50 un</option>
                            <option value=100>100 un</option>
                            <option value=150>150 un</option>
                            <option value=200>200 un</option>
                            <option value=250>250 un</option>
                          </select>
                          <br>
                      </li>

                    <?php
                      } else{
                      //used to make sure there's no error in the calculation that is made by the ajax function to determine the price of the product, but this input is not visible to the user
                      
                            echo "<input type='hidden' id='unidade_misto' value=0>";
                        }
                      //used to verify if the selected product in the previous screen is necessary to visualize the options of the below select
                        //if different then party sweets it calls for the cake flavours table
                        if($_GET['opcao']!="Party Sweets"){
                    ?>
                          <li class="w3-padding-16"><b>Cake Flavour:</b>
                              <br>
                              <select name="recheio_id">
                                <?php 
                                //selecting all flavours from the flavour table
                                  $sql="select * from recheio_sabor";
                                  $resultado=mysqli_query($conexao,$sql);

                                  while($linha=mysqli_fetch_assoc($resultado)){
                                    echo "<option value=".$linha['id'].">".$linha['descricao']."</option>";
                                  }
                                ?>
                                
                              </select>
                              <br>
                          </li>

                      <?php 
                        }
                      ?>

                      <?php 
                       //utilizado para verifica se o produto selecionado na tela anterior faz se necessário a visualização das opções do select abaixo
                        if($_GET['opcao']=="Cake and Sweets" || $_GET['opcao']=="Party Sweets"){
                       ?>
                          <li class="w3-padding-16"><b>Sweets Flavours:</b>
                            <br>
                            <label>Flavour 1</label>
                            <select name="sabor_doce1">
                                <?php 
                                //selecting all flavours from the flavour table
                                  $sql="select * from recheio_sabor";
                                  $resultado=mysqli_query($conexao,$sql);
                                
                                  while($linha=mysqli_fetch_assoc($resultado)){
                                    echo "<option value='".$linha['id']."'> ".$linha['descricao']."</option>";
                                  }
                                ?>

                            </select>
                            <br>
                            <label>Flavour 2</label>

                            <select name="sabor_doce2">
                                <?php 
                                
                                //listing the flavours from the flavours table
                                  $sql="select * from recheio_sabor";
                                  $resultado=mysqli_query($conexao,$sql);
                                
                                  while($linha=mysqli_fetch_assoc($resultado)){
                                    echo "<option value='".$linha['id']."'> ".$linha['descricao']."</option>";
                                  }
                                ?>
                            </select>

                          </li>

                      <?php 
                        }
                      ?>

                      <li class="w3-padding-16"><b>Diet Restriction:</b>
                          <br>
                          <select name="adicional" onchange="alterar_preco_misto(10);">
                            <option value=""></option>
                            <option value='No lactose'> No lactose</option>
                            <option value='No gluten'> No gluten</option>
                            <option value='No sugar'> No sugar</option>
                            
                          </select>
                          <br>
                      </li>


                    <li class="w3-padding-16">
                      <b>Delivery Date</b>
                      <br>  <input type="date" name="data_entrega" value required>
                    </li>

                    <?php 
                    //if not party sweets it asks for decoration details
                      if($_GET['opcao']!="Party Sweets"){
                     ?>
                        <li class="w3-padding-16">
                          <b>Decoration</b><br>
                          <textarea name="descricao_decoracao" placeholder="Decoration Description" ></textarea>
                        </li>
                    <?php 
                      }
                    ?>
                      
                        <input type="hidden" id="preco_misto" value=75>
                        
                        <h2 class="w3-wide" id="resultado_preco_misto">
                           R$ 50
                        </h2>

                             <script type="text/javascript">
                                 setTimeout(alterar_preco_misto(0), 500);//calls the funtion that alters the price in 500 miliseconds
                             </script>              
                        <button type="submit" class="btn btn-primary">Submit Order</button>
                      
                    </ul>
                  </form>
                </div>




            </div>
        </div>
    </div>
</div>
</body>
</html>