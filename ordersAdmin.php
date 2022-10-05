
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css"/>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<body class="body-background">
<div class="search-name-container">
<form action="ordersAdmin.php" method="GET" >
<div class="search"> 
          <input type="text" class="searchbar" name="customer" placeholder="customer username..."/>
          <button type="submit" name="submit" class="icon"><i class="fa fa-search"></i></button>
</div>
</form>
</div>
<table class="all-tbls" cellpadding="5" cellspacing="1" >
<tbody>
<tr>
<th  class="table-cells">Delivered</th>   
<th  class="table-cells">Not yet Delivered</th> 
<th  class="table-cells">Product Name</th>
<th  class="table-cells">Product Code</th>
<th  class="table-cells">Customer username</th>
<th  class="table-cells">Payer email</th>
<th  class="table-cells">Receiver email</th>
<th  class="table-cells">Company</th>
<th  class="table-cells">Quantity</th>
<th  class="table-cells">Total Price</th>
<th  class="table-cells">Date</th>
<th  class="table-cells">Delivered</th>
</tr>
<?php
      error_reporting(0);
      session_start(); 
      include ('connect.php');
      if(isset($_GET['customer'])){
        $count = 0;
        $cust = $_GET['customer'];
        $safe_cust= stripcslashes(htmlspecialchars($cust));
        $sqlproducts = "SELECT t1.item_name,t1.payment_id,t1.item_number,t1.username,t1.quantity,t1.receiver_email,t1.payment_gross, t2.code, t1.Date, t1.payer_email, t2.company, t2.image, t1.Recieved FROM payments as t1, products as t2 WHERE t1.username like '%$safe_cust%' and (t1.item_number = t2.id) ORDER BY Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["image"];
              ?>
                <tr>
             <td style="text-align:center;"><a style="text-decoration: none;"  href="recieved.php?OrderId=<?php echo $rows['payment_id']; ?>">✔</a></td>  
             <td style="text-align:center;"><a style="text-decoration: none;" href="norecieved.php?OrderId=<?php echo $rows['payment_id']; ?>">X</a></td>         
             <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["item_name"];?></td>
             <td class="table-cells"><?php echo $rows["code"];?></td>
             <td class="table-cells"><?php echo $rows["username"];?> </td>
             <td style="text-align:center;"><?php echo $rows["payer_email"];?> </td>
             <td style="text-align:center;"><?php echo $rows["receiver_email"];?> </td>
             <td class="table-cells"><?php echo $rows["company"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["payment_gross"];?> </td>
             <td class="table-cells"> <?php echo $rows["Date"];?></td>
             <td class="table-cells"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
            </tr>
  
     <?php   
       $count = $count + 1;
     }
     echo  "<p class='count-design-no-background'>Available orders: ".$count."</p>";
    }else{
      $count = 0;
      $sqlproducts = "SELECT t1.item_name,t1.payment_id,t1.item_number,t1.username,t1.quantity,t1.receiver_email,t1.payment_gross, t2.code, t1.Date, t1.payer_email, t2.company, t2.image, t1.Recieved FROM payments as t1, products as t2 WHERE (t1.item_number = t2.id) ORDER BY Date DESC";
      $res = mysqli_query($con, $sqlproducts); 
          while($rows = $res->fetch_assoc()){ 
              $image =  'productimages/'.$rows["image"];
            ?>
              <tr>
           <td style="text-align:center;"><a style="text-decoration: none;"  href="recieved.php?OrderId=<?php echo $rows['payment_id']; ?>">✔</a></td>  
           <td style="text-align:center;"><a style="text-decoration: none;" href="norecieved.php?OrderId=<?php echo $rows['payment_id']; ?>">X</a></td>       
           <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["item_name"];?></td>
           <td class="table-cells"><?php echo $rows["code"];?></td>
           <td class="table-cells"><?php echo $rows["username"];?> </td>
           <td style="text-align:center;"><?php echo $rows["payer_email"];?> </td>
           <td style="text-align:center;"><?php echo $rows["receiver_email"];?> </td>
           <td class="table-cells"><?php echo $rows["company"];?> </td>
           <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
           <td style="text-align:center;"><?php echo  "$".$rows["payment_gross"];?> </td>
           <td class="table-cells"> <?php echo $rows["Date"];?></td>
           <td class="table-cells"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
          </tr>

<?php   
     $count = $count + 1;
   }
    echo  "<p class='count-design-no-background'>All orders: ".$count."</p>";
  }
  ?> 
</tbody> 
</table>
</body>
<?php }else{
   header("Location:index.php");  
} ?>