
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" /> 
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
<body class="body-background">
<nav class="top-relative">
<button  class="top-left-button" onclick="location.href='clientsidestore.php?company=<?php echo $_GET['company']; ?>'">Store</button>
</nav>
<div class="store-info-container">
<?php
error_reporting(0);
include ("connect.php");
$sql = "SELECT * FROM owners where company = '{$_GET["company"]}'";
$Info = $con->query($sql);
        while ($comp = $Info -> fetch_assoc()){
        ?>    
    <h1>Store owner information</h1>
    <div class="account-details-container">
    <div class="account-details">
    <h3 class="info-headings">First Name</h3>
    <?php if(!empty($comp["OwnerFirstName"])){?>
    <p><?php echo $comp["OwnerFirstName"]; ?></p>
    <?php }else{ ?>
    <p>Not set</p>
    <?php } ?>
    <br/> 
    <h3 class="info-headings">Last Name</h3>
    <?php if(!empty($comp["OwnerLastName"])){?>
    <p><?php echo $comp["OwnerLastName"]; ?></p>
    <?php }else{ ?>
    <p>Not set</p>
    <?php } ?>
    <br/>     
    <h3 class="info-headings">Email</h3>
    <?php if(!empty($comp["OwnerEmail"])){?>
    <p><?php echo $comp["OwnerEmail"]; ?></p>
    <?php }else{ ?>
    <p>Not set</p>
    <?php } ?>
    </div>
    <div class="account-details">  
    <h3 class="info-headings">Address</h3>
    <?php if(!empty($comp["OwnerAddress"])){?>
    <p><?php echo $comp["OwnerAddress"]; ?></p>
    <?php }else{ ?>
    <p>Not set</p>
    <?php } ?>
    <br>
    <h3 class="info-headings">Mobile Number</h3>
    <?php if(!empty($comp["phone"])){?>
    <p><?php echo $comp["phone"]; ?></p>
    <?php }else{ ?>
    <p>Not set</p>
    <?php } ?>
    <br>
    <h3 class="info-headings">Whatsapp</h3>
    <a href="https://wa.me/<?php echo $comp["phone"]; ?>"> <img src="images/whatsapp.jpeg" alt="" style="height: 50px; width: 50px; border-radius: 50%;">  </a>    
    </div>       
    </div>       
       <?php }         
?>  
</div>
</body>