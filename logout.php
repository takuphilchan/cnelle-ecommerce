
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); 
}else if(!isset($_SESSION['logged'])){
    header("Location: storeLoggin.php");
  }
?>
<?php
error_reporting(0);
session_destroy();
header('location: index.php');
?>