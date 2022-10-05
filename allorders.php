
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<title>cnelle</title>
<link rel="stylesheet" href="css/main.css"/>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<p  class="txt-heading">ALL MY ORDERS</p>
<table class="all-tbls" cellpadding="5" cellspacing="1" >
<tbody>
<tr>
<th  class="table-cells" >Name</th>
<th  class="table-cells" >Product Code</th>
<th  class="table-cells" >Company</th>
<th  class="table-cells" >Payer email</th>
<th  class="table-cells" >Quantity</th>
<th  class="table-cells" >Total Price</th>
<th  class="table-cells" >Date</th>
<th  class="table-cells" >Delivered</th>
<th class="table-cells" >Talk to supplier</th>
</tr>
<?php
        error_reporting(0);
        session_start(); 
        include ('connect.php');
        if($_SESSION['username']){      
          $sqlproducts = "SELECT t1.item_name, t1.item_number, t1.username, t1.quantity, t1.payment_gross, t2.code, t1.Date, t1.payer_email, t2.company, t2.image, t1.Recieved FROM payments as t1, products as t2 WHERE (t1.username='{$_SESSION['username']}') and (t1.item_number = t2.id) ORDER BY t1.Date DESC";
        $res = mysqli_query($con, $sqlproducts); 
        if($res==true){
            while($rows = $res->fetch_assoc()){ 
                $image =  'productimages/'.$rows["image"];
              ?>
                <tr>
             <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["item_name"];?></td>
             <td class="table-cells"><?php echo $rows["code"];?></td>
             <td class="table-cells"><?php echo $rows["company"];?> </td>
             <td style="text-align:center;"><?php echo $rows["payer_email"];?> </td>
             <td style="text-align:center;"><?php echo $rows["quantity"];?> </td>
             <td style="text-align:center;"><?php echo  "$".$rows["payment_gross"];?> </td>
             <td class="table-cells"> <?php echo $rows["Date"];?></td>
             <td class="table-cells"> <?php if($rows["Recieved"]==0) echo "--"; else echo "✔";?></td>
             <td><a class="message-button-cart"  href="customerSellerMessages.php?company=<?php echo $rows['company']; ?> && username = <?php echo $_SESSION['username'];?>" style="text-decoration: none; color navy; text-align:center;"><i class="fa fa-comment"></i></a></td>
           
            </tr>

<?php
     }
         
       }
    }
    ?> 
</tbody> 
</table>