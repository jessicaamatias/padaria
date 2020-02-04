<?php include 'menu.php';
//THIS FILE menu.php CONTAINS THE SIMPLE MENU OPTIONS FOR ORDERS
?>


  <!-- Pricing Row -->
<div class="w3-row-padding w3-center w3-padding-64" id="pricing">
          <?php 
            if (isset($_GET['resposta'])) {
                echo $_GET['resposta'];
            }
        ?>
    <h2>Our Products</h2>
    <p>Choose the option you're looking for to check the price.</p><br>
    <div class="w3-third w3-margin-bottom">
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme">
          <p class="w3-xlarge">Birthday Cake</p>
        </li>
    
        <li class="w3-theme-l5 w3-padding-24">
          <a href='detalhar_escolha.php?opcao=Birthday Cake' class="w3-button w3-teal w3-padding-large"><i class="fa fa-check"></i> Check Prices</a>
        </li>
      </ul>
    </div>

    <div class="w3-third w3-margin-bottom">
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme">
          <p class="w3-xlarge">Wedding Cake</p>
        </li>

        <li class="w3-theme-l5 w3-padding-24">
          <a href='detalhar_escolha.php?opcao=Wedding Cake' class="w3-button w3-teal w3-padding-large"><i class="fa fa-check"></i> Check Prices</a>
        </li>
      </ul>
    </div>

    <div class="w3-third w3-margin-bottom">
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme">
          <p class="w3-xlarge">Party Sweets</p>
        </li>
        
        <li class="w3-theme-l5 w3-padding-24">
          <a href='detalhar_escolha.php?opcao=Party Sweets' class="w3-button w3-teal w3-padding-large"><i class="fa fa-check"></i> Check Prices</a>
        </li>
      </ul>
    </div>

  <div class="w3-third w3-margin-bottom">  
      <ul class="w3-ul w3-border w3-hover-shadow">
        <li class="w3-theme">
          <p class="w3-xlarge">Cake and Sweets</p>
        </li>

        <li class="w3-theme-l5 w3-padding-24">
          <a href='detalhar_escolha.php?opcao=Cake and Sweets' class="w3-button w3-teal w3-padding-large"><i class="fa fa-check"></i> Check Prices</a>
        </li>
      </ul>
  </div>

</div>

</body>

</html>