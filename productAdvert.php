
<?php 
session_start(); 
error_reporting(0);
if(!isset($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<?php
if($_SESSION['username']==='Administrator'){
?>
<!DOCTYPE html>
<html>
<head>
<title>cnelle</title>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
 <script src="javascript/reload.js"></script>
    <script src="javascript/image-placement-sell.js"></script>
 <link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
</head>
<body class="body-background-forms">
<?php 
error_reporting(0);
session_start();
include ('connect.php');
   if(isset($_POST["submit"])){
      $image = explode(".", $_FILES["image"]["name"][0]);
      $imgContent = round(microtime(true)) .'1'.'.' . end($image);
      $temp1 = $_FILES["image"]["tmp_name"][0];
      $check = move_uploaded_file($temp1, 'advertimages/'.$imgContent);

      $image2 = explode(".", $_FILES["image"]["name"][1]);
      $imgContent2 = round(microtime(true)) .'2'.'.' . end($image2);
      $temp2 = $_FILES["image"]["tmp_name"][1];
      $check2 = move_uploaded_file($temp2, 'advertimages/'.$imgContent2);
     
      $image3 = explode(".", $_FILES["image"]["name"][2]);
      $imgContent3 = round(microtime(true)) .'3'.'.' . end($image3);
      $temp3 = $_FILES["image"]["tmp_name"][2];
      $check3 = move_uploaded_file($temp3, 'advertimages/'.$imgContent3);
      if($check!== false and $check2 !== false and $check3 !== false){
            $ad_query = mysqli_query($con, "SELECT * from Adverts");
                       if(mysqli_num_rows($ad_query)==0){
            $insert_query = mysqli_query($con,"INSERT INTO Adverts (image1, image2, image3,current) VALUES ('$imgContent', '$imgContent2','$imgContent3','active')");             
                       }else{
            $update_query = mysqli_query($con, "UPDATE Adverts SET image1 ='$imgContent', image2 = '$imgContent2', image3 = '$imgContent3' WHERE current = 'active'");               
                       if($update_query == true){

                       echo "<p class='notification-message'>Advert has been updated</p>";
                            }else{
                            echo"<p class='invalid'>Advert was not updated</p>"; 
                        } 
                    }  
                }else{ 
                    "<p class='invalid'>failed to upload your product pictures try other pictures</p>";
                }   
        }  
    ?>

<script src="javascript/image.js"></script>
<div class="productback-sell">
<div class="form-ads-top">
    <h2 class="admin-top-heading">TOP PRODUCT ADVERTISEMENT</h2>
  </div><br>
<div class="form-ads-body">
        <form action="productAdvert.php" method="POST" enctype="multipart/form-data">
                    <div id="sellimg">
                    <h5 class="ads-images-heading"> Add 3 images required* </h5>
                    <label for="file">
                    <div class="frame-display">
                    <input type="file" id="file" name="image[]" multiple style="display: none; outline-color: transparent;" required>
                    <div class="frame" id="dvPreview"></div>
                    </div></label><br>
               <button type="submit" name="submit" class="button-for-ads-form">Post Ad</button><br><br><br>
          </form><br>
     </div>   
    </div>
</body>
</html>
<?php }else{
   header("Location:index.php");  
} ?>