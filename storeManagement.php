
<?php 
session_start(); 
error_reporting(0);
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<head>
<title>cnelle</title>
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body class="body-background">
<div class="search-name-container">
<form action="storeManagement.php" method="GET" >
<div class="search"> 
          <input type="text" class="searchbar" name="storeAd" placeholder="company..."/>
          <button type="submit" name="submit" class="icon"><i class="fa fa-search"></i></button>
</div>
</form>
</div>

<table class="all-tbls"  cellpadding="5" cellspacing="1">
<tbody style="border:1px solid grey;">
<th class="table-cells">Deactivate</th>
<th class="table-cells">Activate</th>
<th class="table-cells">Store name</th>
<th class="table-cells">Owner Name</th>
<th class="table-cells">Owner LastName</th>
<th class="table-cells">id Type</th>
<th class="table-cells">id Number</th>
<th class="table-cells">Phone</th>
<th class="table-cells">email</th>
<th class="table-cells">Activation Code</th>
<th class="table-cells">Address</th>
<th class="table-cells">City</th>
<th class="table-cells">Province</th>
<th class="table-cells">Country</th>
<th class="table-cells">Opened On</th>
<th class="table-cells">Delete Account</th>
<?php
    $count = 0;
    include ('connect.php');
    $sql = "SELECT * FROM owners"; 
    $stores = mysqli_query($con, $sql);
  if(isset($_GET['storeAd'])){
    $storeAd = $_GET['storeAd'];
    $safe_store= stripcslashes(htmlspecialchars($storeAd));
    $owner = mysqli_query($con, "SELECT * FROM owners WHERE company like '%$safe_store%'  ORDER BY Date DESC");
    while($row = $owner->fetch_assoc()){ 
      ?>
      <tr>
      <td><a href="deactivateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Deactivate</a></td>
      <td><a href="activateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Activate</a></td>
      <td> <?php echo $row['company']; ?></td>
      <td> <?php echo $row['OwnerFirstName']; ?></td>
      <td> <?php echo $row['OwnerLastName']; ?></td>
      <td> <?php echo $row['idType']; ?></td>
      <td> <?php echo $row['idNumber']; ?></td>
      <td> <?php echo $row['phone']; ?></td>
      <td> <?php echo $row['OwnerEmail']; ?></td>
      <td> <?php echo $row['activationCode']; ?></td>
      <td> <?php echo $row['OwnerAddress']; ?></td>
      <td> <?php echo $row['City']; ?></td>
      <td> <?php echo $row['province']; ?></td>
      <td> <?php echo $row['Country']; ?></td>
      <td> <?php echo $row['Date']; ?></td>
      <td><a href="deleteStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Delete</a></td>
      </tr>
      <?php
  $count = $count + 1 ; 
}
echo  "<p class='count-design-no-background'>Available stores: ".$count."</p>";
}elseif(!isset($_POST['submit'])){
         while($row = $stores->fetch_assoc()){
           ?>
           <tr>
           <td><a href="deactivateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Deactivate</a></td>
           <td><a href="activateStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Activate</a></td>
           <td> <?php echo $row['company']; ?></td>
           <td> <?php echo $row['OwnerFirstName']; ?></td>
           <td> <?php echo $row['OwnerLastName']; ?></td>
           <td> <?php echo $row['idType']; ?></td>
           <td> <?php echo $row['idNumber']; ?></td>
           <td> <?php echo $row['phone']; ?></td>
           <td> <?php echo $row['OwnerEmail']; ?></td>
           <td> <?php echo $row['activationCode']; ?></td>
           <td> <?php echo $row['OwnerAddress']; ?></td>
           <td> <?php echo $row['City']; ?></td>
           <td> <?php echo $row['province']; ?></td>
           <td> <?php echo $row['Country']; ?></td>
           <td> <?php echo $row['Date']; ?></td>
           <td><a href="deleteStore.php?SupplierID=<?php echo $row['SupplierID']; ?>">Delete</a></td>
           </tr>
           <?php
           $count = $count + 1 ; 
         }
         echo  "<p class='count-design-no-background'>All stores: ".$count."</p>";
    }
?>
</tbody>
</table>
</body>
<?php }else{
   header("Location:index.php");  
} ?>