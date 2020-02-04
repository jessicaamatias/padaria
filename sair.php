<?php 
//HERE WE DEAL WITH THE LOG OUT, TERMINATING THE SESSION
session_start();
session_destroy();
header("location:loginteste.php");
?>