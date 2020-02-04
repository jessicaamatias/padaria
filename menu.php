<?php session_start();
//THIS FILE menu.php CONTAINS THE SIMPLE USER MENU???
include'conexao.php';
$conexao=conexao();?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css\style.css">
<link rel="stylesheet" type="text/css" href="css\w3.css">

<title>Home page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>

<div class="header">
  <h1>Leticia's Cakes</h1>
  <p>The <b>best</b> cakes and sweets by the <b>best</b> chef.</p>
</div>

<div class="navbar">
  <a href="index.php" >Home</a>
  <a href="prices.php">Options and Prices</a>
      <?php 
            if (isset($_SESSION['id'])&& !isset($_SESSION['nivel_acesso'])) {
                echo "  <a href='reservas.php'>My orders</a>
                      <a href='sair.php' >Log out</a>";
            }else{
                echo "<a href='loginteste.php' >Log in / Register</a>";
            }
        ?>
</div>
