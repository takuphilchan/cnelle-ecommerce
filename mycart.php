<title>cnelle</title>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<link href="css/main.css?version=1.0" type="text/css" rel="stylesheet" />
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<?php
error_reporting(0);

// Include Configuration file
include_once 'config.php';
//Include Database Connection file
include_once 'dbConnect.php';

require_once ("connect.php");
$empty = 'empty';
  if((!empty($_GET['action'])) && ($_GET['action'] == $empty)){
    $del = mysqli_query($con,"delete from cart where customer='{$_SESSION['username']}'"); // delete query
  }  
if(!empty($_SESSION['username'])){      
        $sqlproducts = "SELECT t1.itemId, t1.code, t1.productName, t1.prodId, t1.customer, t1.size, t1.quantity, t1.unitPrice, t1.totalPrice, t2.image, t2.id, t1.Date FROM cart as t1, products as t2  WHERE t1.customer='{$_SESSION['username']}' AND t2.id = t1.prodId ORDER BY t1.Date DESC";
        $query = mysqli_query($con, $sqlproducts); 
        if ($query -> num_rows > 0){ ?>
        <table class="all-tbls" cellpadding="5" cellspacing="1" >
            <tbody> 
            <h3  class="txt-heading">MY SHOPPING CART</h3>
            <tr>  
            <th  class="table-cells" >Remove</th>
            <th  class="table-cells" >Name</th>
            <th  class="table-cells" >Product Code</th>
            <th  class="table-cells" >Size</th>
            <th  class="table-cells" >Quantity</th>
            <th  class="table-cells" >PricePerUnit</th>
            <th  class="table-cells" >Total Price</th>
            <th  class="table-cells" >Date added</th>  
            <th  class="table-cells" >Order</th>     
            </tr>
           <?php while($rows = $query->fetch_assoc()){ 
                $image =  'productimages/'.$rows["image"];
              ?>
                <tr>
             <td class="table-cells"><a href="remove-cart-item.php?itemId=<?php echo $rows['itemId'];?>" class="remove-btn"><i class="fa fa-trash"><i></a></td>  
             <td class="table-cells"><?php echo "<img src='".$image."' style='height:60px; width:60px; border-radius:50%;'>"."<br>".$rows["productName"];?></td>
               
             <td class="table-cells"><?php echo $rows["code"];?> </td>
             <td class="table-cells"><?php echo $rows["size"];?></td>
             <td class="table-cells"><?php echo $rows["quantity"];?> </td>
             <td class="table-cells"><?php echo  "$".$rows["unitPrice"];?> </td>
             <td class="table-cells"><?php echo  "$".$rows["totalPrice"];?> </td>
             <td class="table-cells"><?php echo $rows["Date"];?></td>
             <td>
				<form action="<?php echo PAYPAL_URL;?>" method="POST">
                            <!-- Identify your bussiness so that you can collect the payment -->
                            <input type="hidden" name="business" value="<?php echo PAYPAL_EMAIL;?>">
                            <!-- Specify a buy now button -->
                            <input type="hidden" name="cmd" value="_xclick">
                            <!-- Specify details about the item that buyers will purchase -->
                            <input type="hidden" name="item_name" value="<?php echo $rows['prodname'];?>">
                            <input type="hidden" name="item_number" value="<?php echo $rows['id'];?>">
							<input type="hidden" name="custom" value="<?php echo $_SESSION['username'];?>">
                            <input type="hidden" name="amount" value="<?php echo $rows["totalPrice"];?>">
							<input type="hidden" name="quantity" value="<?php echo $rows['quantity'];?>">
                            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY;?>">
                            <!-- Specify URLs -->
                            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                            <!-- Display the payment button -->
                            <input type="image" name="submit" class="pay-button" src="https://paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif">
                 </form>
				</td>
            </tr>
        <?php
         } ?>
    </tbody>  
      </table>
    <button onclick="location.href='my-cart.php?action=empty'" class="emptyCart">Empty Cart</button>
     <?php }else{ ?>
        <div class="no-records">Your Cart is Empty</div>
      <?php }
      }
    ?> 
