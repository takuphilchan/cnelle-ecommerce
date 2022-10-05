
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css"/>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<div class="top">
<button onclick="location.href='profile.php'" class="top-left-button-with-background">Profile</button> 
<button onclick="location.href='update_notification_status.php?username=<?php echo $_SESSION['username']; ?> && company=<?php echo $_GET['company'];?>'" class="top-right-button-with-background">messages</button>
<button onclick="location.href='cart.php'" class="top-right-button-with-background">Cart</button><br>
<p  class="txt-heading">Wishlist from this store</p>
</div>
<table class="all-tbls" cellpadding="5" cellspacing="1" >
<tbody>
<tr style="background-color: gold;">
<th  class="table-cells" >Name</th>
<th  class="table-cells" >Product Code</th>
<th  class="table-cells" >Company</th>
<th  class="table-cells" >Quantity</th>
<th  class="table-cells" >PricePerUnit</th>
<th  class="table-cells" >Total Price</th>
<th  class="table-cells" >Engaged On</th>
<th  class="table-cells" >Order now</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
  
        if($_SESSION['username']){      
          $sqlproducts = "SELECT t1.productName, t1.quantity, t1.unitPrice, t1.totalPrice, t1.customer, t1.Date, t2.code, t2.image, t2.company FROM wishlist as t1, products as t2 WHERE (t1.customer='{$_SESSION['username']}') and (t1.prodId = t2.id) ORDER BY t1.Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["image"];
              ?>
             <tr>
             <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["productName"];?></td>
             <td class="table-cells"><?php echo $rows["code"];?> </td>
             <td class="table-cells"><?php echo $rows["company"];?> </td>
             <td class="table-cells"><?php echo $rows["quantity"];?> </td>
             <td class="table-cells"><?php echo  "$".$rows["unitPrice"];?> </td>
             <td class="table-cells"><?php echo  "$".$rows["totalPrice"];?> </td>
             <td class="table-cells"> <?php echo $rows["Date"];?></td>
             <td class="table-cells"><a style="text-decoration: none; color navy; text-align:center;">ORDER</a></td>
            </tr>
            <?php
     }
         
       }
    }
    ?> 
</tbody> 
</table>