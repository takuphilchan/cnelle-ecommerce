<!DOCTYPE html>
<html>
<head>
<title>cnelle</title>
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script> 
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<link href="css/main.css?version=1.0" type="text/css" rel="stylesheet" />
<script src="javascript/keypads.js"></script>
<script src="javascript/autocomp.js"></script>
</head>
<body class="body-background-with-design">
<?php
include ('connect.php');  
error_reporting(0);
if(isset($_POST['login'])){ 
    $username = $_POST['myName'];
    $pass = $_POST['mypass']; 
    $username = stripcslashes(htmlspecialchars($username));
    $pass = stripcslashes(htmlspecialchars($pass));
    $result = mysqli_query($con, "SELECT * FROM customers WHERE BINARY username = '{$username}'"); 
    if(mysqli_num_rows($result)>0){
            while($rows = mysqli_fetch_array($result)){
            if(password_verify($pass, $rows["password"])){
            session_destroy();
            session_start(); 
            $_SESSION['loggedin']=true; 
            $_SESSION['username']=$username; 
            echo "<p class='notification-message'>Login successful</p>";
           }else{
            echo "<p class='invalid'>incorrect password<p>"."<br>"; 
           }
         }
       }else{
         echo "<p class='invalid'>Sorry, no account with username $username. Try creating a new account<p>"; 
          } 
    }else if(isset($_POST['register'])){
                $imgContent= "placeholder.jpg";
                $username=$_POST['myName'];
                $email=$_POST['email'];
                $pass = $_POST['mypass'];
                $email = stripcslashes(htmlspecialchars ($email));
                $username = stripcslashes(htmlspecialchars ($username));
                $pass = stripcslashes(htmlspecialchars($pass));
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $user = mysqli_query($con, "SELECT * FROM customers WHERE username = '{$username}'");
                    if($user==true){
                        if(mysqli_num_rows($user)==0){
                            session_destroy();
                            session_start();
                            $reg = "INSERT INTO customers (CustomerImage,username,email,password) values ('$imgContent','$username','$email','$hash')";
                            $reg_result = mysqli_query($con, $reg); 
                            if($reg_result==true){
                            echo "<p class='notification-message'>Congratulations $username your account has been created</p>";
                            }
                        }
                        else{
                                echo"<p class='invalid'>Username $username  has already been taken</p>"; 
                            }     
                        }
                    }else{
                    echo"<p class='invalid'>invalid email</p>"; 
                    }
        }
?>
<div class="authentification-forms-container">
  <h3 class="authentification-forms-container-heading">BUYER</h3>
  <div class="authentification-forms-container-inline">
<div class="form-container"> 
  <div class="form-top">
    <strong class="form-name">Login</strong>
  </div>
 <div class="form-body">
<form action="login.php" method="POST">
          <div class="form">
              <input type="text" name="myName" class="form-input"  required maxlength=20>
              <label for="myName" class="label-name">
                  <span class="content-name">Enter your username</span>
              </label>
           </div>
           <div class="form">
                <input type="text" name="mypass" class="mypass" id="password-field" autocomplete="new-password" oninput="turnOnPasswordStyle()" required>
                <label for="mypass" class="label-name">
                  <span class="content-name">Enter your password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
             </div>
          <button type="submit" name="login" class="button-for-forms">Log in</button><br>
</form>
</div>
</div>
<div class="form-container">
<div class="form-top"> <strong class="form-name">Create Account</strong> </div>
<div>
<div class="form-body">
        <form action="login.php" method="POST">
              <div class="form">
              <input type="text" name="myName" class="form-input"  required maxlength=20>
                <label for="myName" class="label-name">
                    <span class="content-name">Enter your username</span>
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
                <input type="checkbox" checked="checked" class="checkbox" required/>
                <a href="terms.php" class="terms">&nbsp I accept the terms and conditions</a>
                </div><br>
             <button type="submit" name="register" class="button-for-forms">Sign up</button>
          </form>
</div></div></div>
</div>
</div>
<script src="javascript/mask.js"></script>
</body>
</html>