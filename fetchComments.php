<?php 
if($_SERVER["HTTP_SEC_FETCH_SITE"] != "same-origin")
{
    die("Access denied!");
}
?>
<?php 
error_reporting(0);
session_start(); 
if(empty($_SESSION['logged'] and $_SESSION['loggedin'])==false){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:index.php"); }
?>
<DOCTYPE html>
<html>
<head>
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>  
</head>
<body>
<?php
error_reporting(0);
session_start(); 
include ('connect.php');
$sql = "SELECT t1.Date, t1.message, t1.customer, t2.CustomerImage FROM comments as t1, customers as t2 WHERE prodid = {$_SESSION['id']} and t1.customer = t2.username ORDER BY Date DESC";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $imgCustomer = 'customerprofile/'.$row["CustomerImage"]; 
        if(($row['customer']) == ($_SESSION['username'])){ ?>
            <div class='message-container-me' >
            <div class='msg-com-me'>
                <p class='date-message-me'><?php echo $row["Date"];?></p><?php echo $row["message"];?></div>
                <img src='<?php echo $imgCustomer;?>' alt=''; class='sendby-me' draggable='false'/></div><br>
        <?php }else{ ?> 
            <div class='message-container-sender'>
                <img src='<?php echo $imgCustomer;?>' alt=''; class='sendby-someone' draggable='false'/>
                <div class='msg-com'>
                    <p class='date-message'><?php echo $row["Date"];?></p><?php echo $row["message"]; ?>
                </div>
            </div><br>
            <?php }          
                }          
            }
        }else{
                echo "<div class='no-messages'>No comments</div>";
            }
?>
</body>
</html>