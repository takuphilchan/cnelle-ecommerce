
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php

include ('connect.php'); 

$id = $_GET['CustomerID']; // get id through query string

$del = mysqli_query($con,"delete from customers where CustomerID = '$id'"); // delete query

if($del)
{
    mysqli_close($con); // Close connection
    header("location:customerManagement.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
