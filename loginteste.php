<?php session_start();
//THIS FILE loginteste.php DEALS WITH THE REGISTRATION FORM
?>
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


<div class="container">
<div class="login-box">
    <div class="row">
        

    <div class="col-md-6 login-left">
        <h2> Login Here</h2>
        <?php 
            if (isset($_GET['respostaErroLogin'])) {
                echo $_GET['respostaErroLogin'];
            }
        ?>
        
        <form action="logar.php" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary"> Login </button>
        </form>
    </div>

    <div class="col-md-6 login-right">

        <h2> Register Here</h2>
        <?php 
            if (isset($_GET['resposta'])) {
                echo $_GET['resposta'];
            }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="nome" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="endereco" class="form-control" required>
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="tel" name="telefone" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary"> Register </button>
        </form>
    </div>

    </div>
</div>
</div>
</body>
</html>