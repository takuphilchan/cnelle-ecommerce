
<html>
<head>
<link rel="stylesheet" href="css/main.css"/>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body>
 <?php  
    error_reporting(0);
    session_start();
    include ("connect.php");
    if(isset($_POST["send"]) && !empty($_SESSION['username'])){
        $message = $_POST['message'];
        $comment_by = $_SESSION['username'];
        $product_id = $_GET['p'];
        if(!empty($message) && !empty($product_id) && !empty($comment_by)){
        $sql = "INSERT INTO comments (message, customer, prodid) values ('$message', '$comment_by', '$product_id')";
        mysqli_query($con, $sql);
        } 
    }
?>   

<div class="product-reviews-textbox-container">
<form action="customer-reviews.php?p=<?php echo $_GET['p'];?>" method="POST">
 <?php
    $sql = "SELECT t1.Date, t1.message, t1.customer, t2.CustomerImage FROM comments as t1, customers as t2 WHERE ((prodid = '{$_GET['p']}') and (t1.customer = t2.username)) ORDER BY t1.Date DESC";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {?> 
    <div class="messages-textbox-container">
    <h3 class="review-title">PRODUCT REVIEWS</h3> 
    <div class="comment" id="message">   
        <?php
        while($row = $result->fetch_assoc()) {
            $imgCustomer = 'customerprofile/'.$row["CustomerImage"];
                echo "<div class='message-container-sender'>"."<img src='".$imgCustomer."' alt=''; class='sendby-someone' draggable='false'/>"."<div class='msg-com-product'>"."<p class='date-message-img-someone'>".$row["Date"]."</p>".$row["message"]."</div>"."</div>"."<br>";
            }?>   
            </div><br>   
                <?php }else{
                echo "<div class='no-messages'>No reviews yet<br><br> Leave a review</div><br>";
            } ?> 
    </div>
    <div class="textbox-area-product">
    <textarea type="text" class="textbox" name="message" placeholder="type a review" autocomplete="off"></textarea>
    <button type="submit" name="send" class="send-button"><i class="fa fa-paper-plane"></i></button>
    </div>    
</form>  
</div>    
</body>
</html>