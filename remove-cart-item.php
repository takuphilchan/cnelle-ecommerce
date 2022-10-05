<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php

include ('connect.php'); 

$id = $_GET['itemId']; // get id through query string

$del = mysqli_query($con,"delete from cart where itemId = '$id'"); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("location:cart.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>