
<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<!DOCTYPE html>
<html>
<head>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
    <script src="javascript/reload.js"></script>
    <script src="javascript/image-placement.js"></script>
    <link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>   
    <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body class="body-background-with-design-messages">  
<?php 
error_reporting(0); 
session_start(); 
include ('connect.php'); 
if(!empty($_SESSION["username"])){
$message = $_POST["message"];
$companies = $_GET["company"];
$message = stripcslashes(htmlspecialchars($message)); 
$companies = stripcslashes(htmlspecialchars($companies)); 
if(isset($_POST['submit'])){
    if(!empty($message) && empty($_FILES["image"]["name"])){
            $imgContent = "";
        }else if(empty($message) && empty($_FILES["image"]["name"])){
            header("Location: customerSellerMessages.php?company=$companies");
            exit;
        }else if(!empty($_FILES["image"]["name"])){
    $image = explode(".", $_FILES["image"]["name"]);
    $imgContent = round(microtime(true)). '.' . end($image);
    $temp = $_FILES["image"]["tmp_name"];
    $check = move_uploaded_file($temp, "messagesImages/".$imgContent); 
    }
    $sql= "INSERT INTO customersellermessages (image, message, SendBy,Reciever) values ('$imgContent','$message','{$_SESSION['username']}', '$companies')";
    mysqli_query($con,$sql); 
    header("Location: customerSellerMessages.php?company=$companies");
    exit;
        
    }
}else{
    header('Location: login.php');
}
?>

<script>
$(document).ready(function(){
    setInterval(function(){
        $("#message").load("fetchcustomerSellerMessages.php?company=<?php echo $companies; ?>"); 
    },3000);
});
</script> 


<nav class="top-relative">
<a href="allChats.php" class="chats-heading">All Chats</a> 
</nav>  
<h2  class="chats-heading-messaging">Chatting with <?php echo $_GET['company']; ?></h2> 
<form action="customerSellerMessages.php?company=<?php echo $_GET['company'];?>" method="POST" enctype="multipart/form-data"> 
<div class="messages-textbox-container"> 
<div class="design" id="message">
    <?php
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
            }else {
                echo "<div class='no-messages'>No messages</div>";
            } 
    ?>
    <div class="design-padding"></div>
    </div>
    <div class="textbox-area">
    <input type="text" name="Companies" value="<?php echo $_GET['company']; ?>" hidden>
    <textarea type="text" class="textbox" name="message" placeholder="type a message" autocomplete="off"></textarea>
    <input type="file" id="file" name="image" style="display: none;" onchange="loadFile(event)">
    <label for="file"><div style="background-image: url('images/product.png');" class="choose-image" id="imgplace"></div></label>
    <button type="submit" class="send-button" name="submit"><i class="fa fa-paper-plane"></i></button>
</div>
</div>
</form>
</body>
</html>
<script src="javascript/scroll.js"></script> 