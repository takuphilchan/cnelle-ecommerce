
<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: index.php"); }
  ?>
<DOCTYPE html>
<html>
<head>
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
</head>
<body>
<?php
error_reporting(0);
include ('connect.php'); 
session_start(); 
$sql = "SELECT t1.Date, t1.message, t1.SendBy, t1.message_status ,t1.image,t1.Reciever, t2.CustomerImage, t3.OwnerImage FROM customersellermessages as t1, customers as t2, owners as t3 WHERE (t1.SendBy=t2.username or t1.Reciever=t2.username) and (t1.SendBy=t3.company or t1.Reciever=t3.company) and (t1.Reciever='{$_GET["company"]}' or t1.Reciever='{$_SESSION["username"]}') and (t1.SendBy='{$_SESSION["username"]}' or t1.SendBy='{$_GET["company"]}') ORDER BY t1.Date ASC";
$result = $con->query($sql);
if ($result->num_rows > 0) {     
while($row = $result->fetch_assoc()) {
    $imgOwner =  'storeprofile/'.$row["OwnerImage"]; 
    $imgCustomer =  'customerprofile/'.$row["CustomerImage"]; 
    $imageURL = 'messagesImages/'.$row["image"];
    if (!empty($row["image"]) && !empty($row["message"])){
        if(($row["SendBy"]) == ($_SESSION["username"])){ ?>
            <div class='message-container-me'>
                <div class='msg-com-me-img'>
                    <div class='msg-com-me'>
                        <p class='date-message-img-me'><?php echo $row["Date"];?></p><?php echo $row["message"];?>
                    </div><br>
                    <img src='<?php echo $imageURL;?>' alt='';  class='msg-images'  draggable='false'/><br>
                </div>
                <img src='<?php echo $imgCustomer;?>' alt=''; class='sendby-me' draggable='false'/>
            </div><br>
        <?php }else{  ?>
            <div class='message-container-sender'>
                <img src='<?php echo $imgOwner;?>' alt=''; class='sendby-someone' draggable='false'/>
                <div class='msg-com-img'>
                    <p class='date-message-img-someone'><?php echo $row["Date"];?></p>
                    <img src='<?php echo $imageURL;?>' alt='';  class='msg-images'  draggable='false'/><br>
                    <div class='msg-com'>
                        <?php echo $row["message"];?>
                    </div>
                    </div>
            </div><br>
        <?php  } 
        } else if(!empty($row["image"])){ 
            if(($row["SendBy"]) == ($_SESSION["username"])){ ?>
                <div class='message-container-me' >
                    <div class='msg-com-me-img'>
                        <p class='date-message-img-me'><?php echo $row["Date"];?></p>
                        <img src='<?php echo $imageURL;?>' alt='';  class='msg-images'  draggable='false'/>
                    </div>
                    <img src='<?php echo $imgCustomer;?>' alt=''; class='sendby-me' draggable='false'/>
                </div><br>
        <?php }else{ ?>
                <div class='message-container-sender'>
                    <img src='<?php echo $imgOwner;?>' alt=''; class='sendby-someone' draggable='false'/>
                    <div class='msg-com-img'>
                        <p class='date-message-img-someone'><?php echo $row["Date"];?></p>
                    <img src='<?php echo $imageURL;?>' alt='';  class='msg-images'  draggable='false'/>
                </div></div><br>
        <?php  }
            }else  if(empty($row["image"])){
                if(($row["SendBy"]) == ($_SESSION["username"])){ ?>
                <div class='message-container-me'>
                    <div class='msg-com-me'>
                        <p class='date-message-me'><?php echo $row["Date"];?></p><?php echo $row["message"];?>
                    </div>
                        <img src='<?php echo $imgCustomer;?>' alt=''; class='sendby-me' draggable='false'/>
                </div><br>
        <?php }else{ ?>
                <div class='message-container-sender'>
                    <img src='<?php echo $imgOwner;?>' alt=''; class='sendby-someone' draggable='false'/>
                    <div class='msg-com'>
                        <p class='date-message'><?php echo $row["Date"];?></p>
                        <?php echo $row["message"];?>
                    </div>
                </div><br>
        <?php  }
            } 
        } 
} else {
    echo "<div class='no-messages'>No messages</div>";
}
?>
<div class="design-padding"></div>
</body>
</html>
