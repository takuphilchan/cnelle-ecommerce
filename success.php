
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<html>
<title>cnelle</title>
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<body class="body-background-with-design">
<div class="information-background">
<div class="order-place-container">
<h3 class="ordered-heading">Your order is completed</h3>
<img src="images/Tick.png" class="ordered-image" alt="">
<p class="ordered-text">Thank your for your order.</p>
<a href="../index.php">Back to products</a>
</div>
</div><br>
</body>
</html>