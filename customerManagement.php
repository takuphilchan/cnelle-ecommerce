
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
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
</head>
<body class="body-background">
<div class="search-name-container">
<form action="customerManagement.php" method="GET" >
<div class="search"> 
          <input type="text" class="searchbar" name="emailAd" placeholder="email..."/>
          <button type="submit" name="submit" class="icon"><i class="fa fa-search"></i></button>
</div>
</form>
</div>

<table class="all-tbls"  cellpadding="5" cellspacing="1">
<tbody>
<th class="table-cells">Username</th>
<th class="table-cells">First name</th>
<th class="table-cells">Last Name</th>
<th class="table-cells">Phone</th>
<th class="table-cells">email</th>
<th class="table-cells">Province</th>
<th class="table-cells">Country</th>
<th class="table-cells">Joined On </th>
<th class="table-cells">Delete Account</th>
<?php
  $count = 0;
  include ('connect.php');
  $sql = "SELECT * FROM customers"; 
  $custo = mysqli_query($con, $sql);
  if(isset($_GET['emailAd'])){
    $emailAd = $_GET['emailAd'];
    $safe_email= stripcslashes(htmlspecialchars($emailAd));
    $customer = mysqli_query($con, "SELECT * FROM customers WHERE email like '%$safe_email%'  ORDER BY Date DESC");
    while( $row = $customer->fetch_assoc()){
      ?>
      <tr>
      <td > <?php echo $row['username']; ?></td>
      <td> <?php echo $row['FirstName']; ?></td>
      <td> <?php echo $row['LastName']; ?></td>  
      <td> <?php echo $row['phone']; ?></td>
      <td> <?php echo $row['email']; ?></td>
      <td> <?php echo $row['province']; ?></td>
      <td> <?php echo $row['Country']; ?></td>
      <td> <?php echo $row['Date']; ?></td>
      <td><a href="deleteCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a></td>
      </tr>
      <?php
        $count = $count + 1 ; 
    }
  echo  "<p class='count-design-no-background'>Available buyers: ".$count."</p>";
}elseif(!isset($_POST['submit'])){
      while($row = $custo->fetch_assoc()){
        ?>
        <tr>
        <td > <?php echo $row['username']; ?></td>
        <td> <?php echo $row['FirstName']; ?></td>
        <td> <?php echo $row['LastName']; ?></td>
        <td> <?php echo $row['phone']; ?></td>
        <td> <?php echo $row['email']; ?></td>
        <td> <?php echo $row['province']; ?></td>
        <td> <?php echo $row['Country']; ?></td>
        <td> <?php echo $row['Date']; ?></td>
        <td><a href="deleteCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a></td>
        </tr>
        <?php
        $count = $count + 1; 
      }
      echo  "<p class='count-design-no-background'>All buyers: ".$count."</p>"; 
    }
?>
</tbody>
</table>
</body>
<?php }else{
   header("Location:index.php");  
} ?>