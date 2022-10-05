
<!DOCTYPE html>
<html>
<head>
<title>cnelle</title>
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script> 
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
<script src="javascript/keypads.js"></script>
<script src="javascript/autocomp.js"></script>
</head>
<body class="body-background-with-design">
<?php
include ('connect.php');  
error_reporting(0);    
if(isset($_POST['login'])){ 
    $email=$_POST['email'];
    $company = $_POST['company'];
    $password = $_POST['mypass']; 
    $company = stripcslashes(htmlspecialchars($company));
    $email = stripcslashes(htmlspecialchars($email));
    $activationCode = stripcslashes(htmlspecialchars($activationCode));
    $password = stripcslashes(htmlspecialchars($password));
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $result = mysqli_query($con, "SELECT * FROM owners WHERE company='{$company}'");
    if(mysqli_num_rows($result)>0){
         while($rows = mysqli_fetch_array($result)){ 
                  if($rows["OwnerEmail"]==$email){
                        if($rows["activationCode"]=='1'){
                              if(password_verify($password, $rows["password"])){
                                  session_destroy();
                                  session_start();
                                  $_SESSION['logged']=true;
                                  $_SESSION['company']=$company;
                                  echo "<p class='notification-message'>Login successful</p>";
                                }else{
                                  echo "<p class='invalid'>incorrect password</p>"; 
                                }
                        }else{
                          $_SESSION['logged']=false;
                          echo "<p class='notification-message'>Your Store Account is not activated, please wait for confirmation and activation</p>";
                        }
                 }else{
              echo "<p class='invalid'>Sorry, email does not match your company name. Try again.</p>"; 
              }
          }
       }else{
        echo "<p class='invalid'>Sorry, company name does not match any existing company name. Try again.</p>"; 
      }
  }else{
    echo"<p class='invalid'> invalid email</p>"; 
  }
}else if(isset($_POST['register'])){
    if(empty($_FILES["image"]["name"])){ 
     $imgContent = "placeholder.png";
    }else{
     $image = explode(".", $_FILES["image"]["name"]);
     $imgContent = round(microtime(true)). '.' . end($image);
     $temp = $_FILES["image"]["tmp_name"];
     $check = move_uploaded_file($temp, "storeprofile/".$imgContent);
     if($check == false){
         echo "Your store profile picture was not uploaded, try another picture";
        }
      }
     $activationCode = 0;
     $email= $_POST['email'];
     $company = $_POST['company'];
     $password = $_POST['mypass'];
     $banner = "banner-placeholder.png";
     $email = stripcslashes(htmlspecialchars($email));     
     $company = stripcslashes(htmlspecialchars($company));
     $password = stripcslashes(htmlspecialchars($password));
     $hash = password_hash($password, PASSWORD_DEFAULT);
     if(filter_var($email,FILTER_VALIDATE_EMAIL)){
         $result = mysqli_query($con, "SELECT * FROM owners WHERE company = '{$company}' ");
             if(mysqli_num_rows($result)==0){
                 session_destroy();
                 session_start();
                 $ins = "INSERT INTO owners (OwnerImage, password, OwnerEmail, company, Banner) values ('$imgContent','$hash','$email','$company','$banner')";
                 $insert_result = mysqli_query($con, $ins);
                 if($insert_result==true){
                 echo "<p class='notification-message'>Congratulations $name your company $company has been created</p>";
                 }
                 }else{
                 echo"<p class='invalid'>"."Sorry company name $company is already taken try another name"."</p>"; 
                } 
            }else{
             echo"<p class='invalid'>invalid email</p>";
         }
    }
?>
<script src="javascript/mask.js"></script>

<div class="authentification-forms-container">
<h3 class="authentification-forms-container-heading">SELLER</h3>
  <div class="authentification-forms-container-inline">
<div class="form-container">
  <div  class="form-top">
    <strong class="form-name">Login</strong>
</div>
<div class="form-body">
<form method="POST" action="storeLoggin.php" >
     <div class="form">
              <input type="text" name="company" class="form-input"  required maxlength=20>
              <label for="company" class="label-name">
                  <span class="content-name">Enter your company name</span>
              </label>
      </div>
     <div class="form">
              <input type="text"  name="email" class="form-input"  required maxlength=30>
              <label for="email" class="label-name">
                  <span class="content-name">Enter your email</span>
              </label>
    </div>
    <div class="form">
                <input type="text" name="mypass" class="mypass" id="password-field" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
             </div>
    <button type="submit" name="login" class="button-for-forms">Log in</button><br><br>
</form>
</div>
</div>

<div class="form-container">
<div class="form-top">
    <strong class="form-name">Create Account</strong>
</div>
<div class="form-body">
        <form action="storeLoggin.php" method="POST">              
             <div class="form">
              <input type="text" name="company"  class="form-input"  required maxlength=30>
              <label for="company" class="label-name">
                  <span class="content-name">Enter your company name</span>
                </label>
             </div> 
                <div class="form">
                <input type="text" name="email" class="form-input"  required maxlength=50>
                <label for="email" class="label-name">
                    <span class="content-name">Enter your email</span>
                </label>
                </div> 
             <div class="form">
                <input type="text" name="mypass" class="mypass" id="password-field-2" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your password </span>
                </label>
                <i id="pass-status-2" class="fa fa-eye" aria-hidden="true" onClick="viewPassword2()"></i>
             </div>
                <div class="checkbox-container">
                  <input type="checkbox" checked="checked" class="checkbox" required>
                <a href="terms.php" class="terms">&nbsp I accept the terms and conditions</a>
                </div><br>
               <button type="submit" name="register" class="button-for-forms">Sign up</button>
            </form>
   </div> 
</div>
</div>
</div>
</body>
</html>