
<?php 
session_start(); 
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>cnelle</title>
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
        <script src="javascript/scroll.js"></script>
        <link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
        <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
            <?php  
            error_reporting(0);
            session_start(); 
            include ('connect.php');
            if(!empty($_SESSION['username'])){
            $message = $_POST['message'];
            $Admin = "Administrator";
            $message = stripcslashes(htmlspecialchars($message)); 
            if(isset($_POST['submit']) && !empty($_POST['message'])){
                $sql= "INSERT INTO review (message,SendBy, Reciever) values ('$message','{$_SESSION['username']}', '$Admin')";
                mysqli_query($con,$sql); 
                header("Location: review.php");
                exit;
                }
            }else{
                header('Location: login.php');
            }
        ?>
        <script>
            $(document).ready(function(){
                setInterval(function(){
                    $("#message").load("fetchreview.php"); 
                },1);
            });
        </script>
    </head>
    <body class="body-background">
        <h3 class="chats-heading-help-review">CNELLE CUSTOMER FEEDBACK</h3>
        <form action="review.php" method="POST">
        <div class="messages-textbox-container"> 
            <div class="design" id="message">
            </div>
            <div class="textbox-area-help-review">
                <textarea type="text" class="textbox" name="message" placeholder="type a message" autocomplete="off"></textarea>
                <button type="submit" class="send-button" name="submit"><i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </form>
    </body>
</html>