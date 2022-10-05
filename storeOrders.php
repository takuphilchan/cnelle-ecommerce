
<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:storeLoggin.php"); }
?>
<title>cnelle</title>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
<link rel="stylesheet" href="css/main.css"/>
<div class="top-store">
<form action="storeOrders.php" method="GET" >
<div class="search-name-container">
<div class="side-name-heading"><strong>Customer orders</strong></div>
<div class="search"> 
          <input type="text" class="searchbar" name="name" placeholder="Customer username..."/>
          <button type="submit" name="submit" class="icon"><i class="fa fa-search"></i></button>
</div>
</div>
</form>
</div>
<table class="all-tbls-store" cellpadding="5"  cellspacing="1" >
<tbody>
<tr>
<th  class="table-cells" >Name</th>
<th  class="table-cells" >Product Code</th>
<th  class="table-cells" >Customer username</th>
<th  class="table-cells" >Payer email</th>
<th  class="table-cells" >Quantity</th>
<th  class="table-cells" >Total Price</th>
<th  class="table-cells" >Date</th>
<th  class="table-cells" >Delivered</th>
<th class="table-cells" >Talk to buyer</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
        if(isset($_GET['name'])){
        $count = 0;
        $cust = $_GET['name'];
        $safe_cust= stripcslashes(htmlspecialchars($cust));
        $sqlproducts = "SELECT t1.item_name,t1.item_number,t1.username,t1.quantity, t1.payment_gross, t2.code, t1.Date, t1.payer_email, t2.company, t2.image, t1.Recieved FROM payments as t1, products as t2 WHERE username = '%$safe_cust%' and (t2.company='{$_SESSION['company']}') and (t1.item_number = t2.id) ORDER BY Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["image"];
              ?>
                <tr>
             <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["item_name"];?></td>
             <td class="table-cells"><?php echo $rows["code"];?></td>
             <td class="table-cells"><?php echo $rows["username"];?> </td>
             <td style="text-align:center;"><?php echo $rows["payer_email"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["payment_gross"];?> </td>
             <td class="table-cells"> <?php echo $rows["Date"];?></td>
             <td class="table-cells"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td><a class="message-button-cart"  href="sellerCustomerMessages.php?username=<?php echo $row["customer"];?> && company = <?php echo $_SESSION['company'];?>" style="text-decoration: none; color navy; text-align:center;"> <i class="fa fa-comment"></i></a></td>
            </tr>
          <?php
      $count = $count + 1 ; 
    }
    echo  "<div class='count-design-store'>".$count." available orders for ".$cust." </div>";
    }elseif(!isset($_POST['submit'])){      
        $sqlproducts = "SELECT t1.item_name,t1.item_number,t1.username,t1.quantity, t1.payment_gross, t2.code, t1.Date, t1.payer_email, t2.company, t2.image, t1.Recieved FROM payments as t1, products as t2 WHERE (t2.company='{$_SESSION['company']}') and (t1.item_number = t2.id) ORDER BY Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["image"];
              ?>
                <tr>
             <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["item_name"];?></td>
             <td class="table-cells"><?php echo $rows["code"];?></td>
             <td class="table-cells"><?php echo $rows["username"];?> </td>
             <td style="text-align:center;"><?php echo $rows["payer_email"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["payment_gross"];?> </td>
             <td class="table-cells"> <?php echo $rows["Date"];?></td>
             <td class="table-cells"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td><a class="message-button-cart"  href="sellerCustomerMessages.php?username=<?php echo $row["customer"];?> && company = <?php echo $_SESSION['company'];?>" style="text-decoration: none; color navy; text-align:center;"> <i class="fa fa-comment"></i></a></td>
            </tr>

<?php
     }
         
       }
    }
    ?> 
</tbody>
</table>