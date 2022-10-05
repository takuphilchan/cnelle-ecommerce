
<?php 
error_reporting(0);
session_start(); 
if(empty($_SESSION['logged']) && empty($_SESSION['loggedin'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location:login.php"); }
?>
<html>
<head>
<title>cnelle</title>
<link href="css/main.css?version=1.4" type="text/css" rel="stylesheet"/>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
</head>
<body class="body-background-with-design">
<script src="javascript/image.js"></script>
<script src="javascript/image-2.js"></script>
<script src="javascript/mask.js"></script>
<div class="profile-background">
<?php
include ('connect.php');
error_reporting(0);
session_start(); 
if(!empty($_SESSION['company'])){
   if(isset($_POST["submit"])){
    $result =  mysqli_query($con,"SELECT * FROM owners where company = '{$_SESSION['company']}'");
    $row = mysqli_fetch_array($result); 
    if(empty($_FILES["image"]["name"])){
        $imgContent = $row["OwnerImage"];
       }else{
        $image = explode(".", $_FILES["image"]["name"]);
        $imgContent = round(microtime(true)). '.' . end($image);
        $temp = $_FILES["image"]["tmp_name"];
        $check = move_uploaded_file($temp, "storeprofile/".$imgContent);
        if($check == false){
            echo "Your store profile picture was not uploaded, try another picture";
           }
         }
         if(empty($_FILES["banner"]["name"])){ 
          $bannerContent = $row["Banner"];
         }else{
          $banner = explode(".", $_FILES["banner"]["name"]);
          $bannerContent = round(microtime(true)). '.' . end($banner);
          $bannertemp = $_FILES["banner"]["tmp_name"];
          $check2 = move_uploaded_file($bannertemp, "storeprofile/".$bannerContent);
          if($check2 == false){
              echo "<p class='invalid'> Your store banner was not uploaded, try another picture</p>";
             }
           }
        $firstName = $_POST['OwnerFirstName'];    
        $lastName = $_POST['OwnerLastName'];
        $idNumber = $_POST['idNumber'];
        $idtype= $_POST['idtype'];
        $TypeGoods= $_POST['TypeGoods'];
        $city = $_POST['City'];
        $province = $_POST['province'];
        $country = $_POST['Country'];
        $postalCode = $_POST['PostalCode'];
        $number =$_POST['phone'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email= $_POST['OwnerEmail'];
        $storeColor = $_POST['storeColor'];
        $address = $_POST['OwnerAddress'];
        $password = $_POST['mypass'];
        $phone = $code.$number;
        $firstName = stripcslashes(htmlspecialchars($firstName));
        $lastName = stripcslashes(htmlspecialchars($lastName));
        $idNumber = stripcslashes(htmlspecialchars($idNumber));
        $idtype = stripcslashes(htmlspecialchars ($idtype));
        $province = stripcslashes(htmlspecialchars($province));
        $age = stripcslashes(htmlspecialchars($age));
        $gender = stripcslashes(htmlspecialchars ($gender));
        $phone = stripcslashes(htmlspecialchars($phone));
        $city = stripcslashes(htmlspecialchars($city));
        $country = stripcslashes(htmlspecialchars($country));
        $postalCode = stripcslashes(htmlspecialchars($postalCode));
        $TypeGoods = stripcslashes(htmlspecialchars($TypeGoods));
        $email = stripcslashes(htmlspecialchars($email));
        $storeColor = stripcslashes(htmlspecialchars($storeColor));
        $address = stripcslashes(htmlspecialchars($address));
        $password = stripcslashes(htmlspecialchars($password));
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $updt = "UPDATE owners SET OwnerImage ='$imgContent', Banner = '$bannerContent', idNumber = '$idNumber', idType = '$idtype', age='$age', gender='$gender', TypeGoods='$TypeGoods', OwnerEmail='$email', OwnerLastName='$lastName', password='$hash', phone='$phone', storeColor='$storeColor', OwnerAddress='$address', PostalCode='$postalCode' WHERE company = '{$_SESSION['company']}'"; 
                       $success = mysqli_query($con,$updt); 
                       $company = $_SESSION['company'];
                       if($success == true){
                       echo "<p class='notification-message'>Congratulations $company your account has been updated</p>";
                       }else{
                            echo"<p >Account $company  was not updated</p>"; 
                        }     
            }else{
                echo"<p class='invalid'>invalid email</p>";
            }  
        }  
 $result =  mysqli_query($con,"SELECT * FROM owners where company = '{$_SESSION['company']}'");
 $row= mysqli_fetch_array($result);
 $imgURL = 'storeprofile/'.$row["OwnerImage"];
 $imgURLBanner = 'storeprofile/'.$row["Banner"];

?>
<div class="account-information-account-details">
            <div class="account-information">
            <?php echo "<img src='".$imgURL."' draggable='false' class='image-update-container'>";?>
            <div class="account-information-inner"> 
            <div class="info-details"><strong>First name</strong><br><span><?php echo $row['OwnerFirstName']; ?></span></div>
            <div class="info-details"><strong>Last name</strong><br><span><?php echo $row['OwnerLastName']; ?></span></div>
            <div class="info-details"><strong>Email</strong><br><span><?php echo $row['OwnerEmail'];?></span></div>
            <div class="info-details"><strong>Phone</strong><br><span><?php echo $row['phone']; ?></span></div>
            <div class="info-details"><strong>Province</strong><br><span><?php echo $row['province']; ?></span></div>
            <div class="info-details"><strong>Country</strong><br><span><?php echo $row['Country']; ?></span></div>
            <div class="info-details"><strong>Email</strong><br><span><?php echo $row['OwnerEmail'];?></span></div>
            <div class="info-details"><strong>ID type</strong><br><span><?php echo $row['idType']; ?></span></div>
            <div class="info-details"><strong>ID number</strong><br><span><?php echo $row['idNumber']; ?></span></div>
            <div class="info-details"><strong>Gender</strong><br><span><?php echo $row['gender']; ?></span></div>
            <div class="info-details"><strong>Age</strong><br><span><?php echo $row['age']; ?></span></div>
            <div class="info-details"><strong>Goods type</strong><br><span><?php echo $row['TypeGoods'];?></span></div>
            <div class="info-details"><strong>Store background color</strong><br><span><?php echo $row['storeColor']; ?></span></div>
            <div class="info-details"><strong>Postal code</strong><br><span><?php echo $row['PostalCode']; ?></span></div>
            </div>
           </div> 
        <div class="account-details-image-container">
         <h3 class="account-details-heading">Update information</h3><br>
         <form action="profile.php" method="POST" enctype="multipart/form-data">
            <div class="profile-banner-container">
              <div class="profile-picture-container">
                <h3 class="picture-section-heading">Store Profile</h3>
                  <input type="file" id="file" name="image" style="display: none;" onchange="loadFile(event)" value="<?php echo $row['OwnerImage'];?>">
                  <label for="file"><?php   echo "<img id='imgplace' src='".$imgURL."' draggable='false' class='image-update-container'>";?></label>
                  <strong class="username-profile"> <?php echo $_SESSION['company']; ?></strong><br>
              </div>
              <div class="banner-container">
                <h3 class="picture-section-heading">Store Banner</h3>
                  <input type="file" id="file2" name="banner" style="display: none;" onchange="loadBanner(event)" value="<?php echo $row['Banner'];?>">
                  <label for="file2"><?php  echo "<img id='img' src='".$imgURLBanner."' draggable='false' class='image-banner-container'>";?></label>
              </div>
              </div><br>
               <div class="account-details-container">
               <div class="account-details">
               <div class="form">
                <input type="text" name="OwnerFirstName" class="form-input"   maxlength=50 value="<?php echo $row['OwnerFirstName']; ?>">
                <label for="OfirstName" class="label-name">
                    <span class="content-name">Enter your first name</span>
                </label>
                </div> 
               <div class="form">
                <input type="text" name="OwnerLastName" class="form-input"    maxlength=80 value="<?php echo $row['OwnerLastName'];?>">
                <label for="address" class="label-name">
                    <span class="content-name">Last Name</span>
                    </label>
                </div>
               <div class="form">
               <input type="tel" name="phone" id="phone" class="form-input"  onkeypress='return restrictAlphabets(event)' maxlength=20 value="<?php echo $row['phone']; ?>">
                <label for="phone" class="label-name">
                    <span class="content-name">Phone number</span>
                </label>
                </div>
                <div class="form">
                <input type="text" name="OwnerEmail" class="form-input"   maxlength=30 value="<?php echo $row['OwnerEmail']; ?>">
                <label for="email" class="label-name">
                    <span class="content-name">Email</span>
                </label>
                </div> 

                <div class="form">
                <input type="text" name="OwnerAddress" class="form-input"    maxlength=80 value="<?php echo $row['OwnerAddress']; ?>">
                <label for="address" class="label-name">
                    <span class="content-name">Store address</span>
                    </label>
                </div>

                <div class="form">
                <input type="text" list="idtype" name="idtype" class="form-input"   maxlength=11 value="<?php echo $row['idType']; ?>"> 
                <label for="idtype" class="label-name">
                    <span class="content-name">Enter your ID type</span>
                </label>
               <datalist id="idtype">
                              <option value="National ID">National ID</option>
                              <option value="Passport">Passport</option>
                </datalist>
                </div>
                <div class="form">
                <input type="text" name="idNumber" class="form-input"   maxlength=30 value="<?php echo $row['idNumber']; ?>">
                <label for="idNumber" class="label-name">
                    <span class="content-name">Enter your ID number</span>
                </label>
                </div>
                <div class="form">
                <input type="text" name="gender" list="gender" class="form-input"   maxlength=6 value="<?php echo $row['gender'];?>">
                <label for="gender" class="label-name">
                    <span class="content-name">Enter your gender</span>
                </label>
                <datalist id="gender">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                </datalist>
                </div>  
                </div>
                <div class="account-details"> 
                <div class="form">
                <input type="number" name="age" class="form-input"   maxlength=3 value="<?php echo $row['age']; ?>" >
                <label for="age" class="label-name">
                    <span class="content-name">Enter your age</span>
                </label>
                </div> 
                <div class="form">
                <input type="text" name="TypeGoods"  class="form-input"   maxlength=60 value="<?php echo $row['TypeGoods']; ?>">
                <label for="TypeGoods" class="label-name">
                  <span class="content-name">Enter your goods type</span>
                   </label>
                </div>  

                <div class="form">
                <input type="text" name="province" class="form-input"    maxlength=80 value="<?php echo $row['province']; ?>">
                <label for="address" class="label-name">
                    <span class="content-name">Store province</span>
                    </label>
                </div> 
                <div class="form">
                <input type="text" name="country" class="form-input"    maxlength=80 value="<?php echo $row['Country']; ?>">
                <label for="address" class="label-name">
                    <span class="content-name">Store country</span>
                    </label>
                </div>
                <div class="form">
                <input type="text" name="storeColor" list="storeColor" class="form-input"  value="<?php echo $row['storeColor']; ?>" maxlength=50>
                <label for="storeColor" class="label-name">
                    <span class="content-name">Store background color</span>
                </label>
                <datalist name="storeColor" class="form-input" style="background-color: white;" id="storeColor">
                <option Selected value="purple">purple</option>
                <option value="orange">orange</option>
                    <optgroup label="Other countries">
                        <option value="blue">blue</option>
                        <option value="royalblue">royalblue</option>
                        <option value="green">green</option>
                        <option value="black">black</option>
                        <option value="grey">grey</option>
                        <option value="red">red</option>
                        <option value="pink">pink</option>
                      </optgroup>
               </datalist>
               </div> 
                <div class="form">
                <input type="text" name="PostalCode" class="form-input"   maxlength=10 value="<?php echo $row['PostalCode']; ?>">
                <label for="postalCode" class="label-name">
                    <span class="content-name">Postal code</span>
                    </label>
                </div> 

                <div class="form">
                <input type="text" name="mypass" class="mypass" id="password-field" required="required" autocomplete="new-password" oninput="turnOnPasswordStyle()" >
                <label for="mypass" class="label-name">
                  <span class="content-name">password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
                </div> 
                <button type="submit" name="submit" class="button-for-profiles">UPDATE INFORMATION</button><br><br><br>     
                </div>   
                </div>     
          </div>  
        </form>
    </div>  
<?php }else if(!empty($_SESSION['username'])){
include ('connect.php');
   if(isset($_POST["submit"])){
    $result = mysqli_query($con, "SELECT * FROM customers where username = '{$_SESSION['username']}'"); 
    $row= mysqli_fetch_array($result);
    if(empty($_FILES["image"]["name"])){
        $imgContent = $row['CustomerImage'];
            }else{
            $image = explode(".", $_FILES["image"]["name"]);
            $imgContent = round(microtime(true)). '.' . end($image);
            $temp = $_FILES["image"]["tmp_name"];
            $check = move_uploaded_file($temp, "customerprofile/".$imgContent);
            if($check==false){
                echo  "Picture was not uploaded,  try another picture";
                }
            }
            $phone=$_POST['phone'];
            $firstname = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $country=$_POST['country'];
            $province=$_POST['province'];
            $email=$_POST['email'];
            $pass = $_POST['mypass'];
            $firstname = stripcslashes(htmlspecialchars ($firstname));
            $lastname = stripcslashes(htmlspecialchars ($lastname));
            $email = stripcslashes(htmlspecialchars ($email));
            $phone = stripcslashes(htmlspecialchars ($phone));
            $country = stripcslashes(htmlspecialchars ($country));
            $province = stripcslashes(htmlspecialchars ($province));
            $pass = stripcslashes(htmlspecialchars($pass));
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $updt = "UPDATE customers set CustomerImage ='$imgContent', email='$email', password='$hash', Phone='$phone', LastName='$lastname', FirstName='$firstname', Country='$country', province='$province' WHERE username = '{$_SESSION['username']}'"; 
                      $success = mysqli_query($con,$updt);  
                      $name = $_SESSION['username'];
                      if($success==true){
                       echo "<p class='notification-message'>Congratulations $name your account has been updated</p>";
                       $_SESSION['loggedin']=true;
                    }else{
                            echo"<p class='invalid'>Account $name failed to update</p>"; 
                        } 
                      
                      }else{
                        echo"<p class='invalid'>invalid email</p>";
                    }    
               }  
          $result = mysqli_query($con, "SELECT * FROM customers where username = '{$_SESSION['username']}'"); 
          $row= mysqli_fetch_array($result);
          $imgURL = 'customerprofile/'.$row["CustomerImage"]; 
?>
<div class="account-information-account-details">
            <div class="account-information">
            <?php echo "<img src='".$imgURL."' draggable='false' class='image-update-container'>";?>
            <div class="account-information-inner"> 
            <div class="info-details"><strong>First name</strong><br><span><?php echo $row['FirstName']; ?></span></div>
            <div class="info-details"><strong>Last Name</strong><br><span><?php echo $row['LastName']; ?></span></div>
            <div class="info-details"><strong>Email</strong><br><span><?php echo $row['email'];?></span></div>
            <div class="info-details"><strong>Phone</strong><br><span><?php echo $row['phone']; ?></span></div>
            <div class="info-details"><strong>Province</strong><br><span><?php echo $row['province']; ?></span></div>
            <div class="info-details"><strong>Country</strong><br><span><?php echo $row['Country']; ?></span></div>
            </div>
           </div> 
           <div class="account-details-image-container">
             <h3 class="account-details-heading">Update information</h3><br>
            <form action="profile.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="file" name="image" style="display: none;"  onchange="loadFile(event)" value="<?php echo $row['CustomerImage']; ?>">
              <label for="file"><?php echo "<img id='imgplace' src='".$imgURL."' draggable='false' class='image-update-container'>";?></label><br>
              <strong class="username-profile"> <?php echo $_SESSION['username']; ?></strong><br>
            <div class="account-details-container">
            <div class="account-details"> 
            <div class="form">
              <input type="text" name="firstName" class="form-input" onkeypress='return restrictNumbers(event)' maxlength=30 value="<?php echo $row['FirstName']; ?>" >
              <label for="firstName" class="label-name">
                  <span class="content-name">First Name</span>
              </label>
             </div> 

             <div class="form">
              <input type="text" name="lastName" class="form-input" onkeypress='return restrictNumbers(event)' maxlength=30 value="<?php echo $row['LastName']; ?>" >
              <label for="lastName" class="label-name">
                  <span class="content-name">Last Name</span>
              </label>
             </div> 

             <div class="form">
              <input type="text" name="email" class="form-input" maxlength=30 value="<?php echo $row['email'];?>">
              <label for="email" class="label-name">
                  <span class="content-name">Email</span>
              </label>
              </div>
              <div class="form">
              <input type="tel" name="phone" id="phone" class="form-input" onkeypress='return restrictAlphabets(event)' maxlength=20 value="<?php echo $row['phone']; ?>">
                <label for="phone" class="label-name">
                    <span class="content-name">Phone number</span>
                </label>
              </div>
            </div>
            <div class="account-details"> 
            <div class="form">
              <input type="text" name="province" class="form-input" onkeypress='return restrictNumbers(event)' maxlength=30 value="<?php echo $row['province']; ?>" >
              <label for="province" class="label-name">
                  <span class="content-name">Province</span>
              </label>
             </div> 
             <div class="form">
                <input type="text" list="country" name="country" class="form-input"  onkeypress='return restrictNumbers(event)' maxlength=56 value="<?php echo $row['Country']; ?>"> 
                <label for="country" class="label-name">
                  <span class="content-name">Country</span>
                </label>
                <datalist id="country">
                              <option value="Afghanistan">Afghanistan</option>
                              <option value="Albania">Albania</option>
                              <option value="Algeria">Algeria</option>
                              <option value="American Samoa">American Samoa</option>
                              <option value="Andorra">Andorra</option>
                              <option value="Angola">Angola</option>
                              <option value="Anguilla">Anguilla</option>
                              <option value="Antartica">Antarctica</option>
                              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                              <option value="Argentina">Argentina</option>
                              <option value="Armenia">Armenia</option>
                              <option value="Aruba">Aruba</option>
                              <option value="Australia">Australia</option>
                              <option value="Austria">Austria</option>
                              <option value="Azerbaijan">Azerbaijan</option>
                              <option value="Bahamas">Bahamas</option>
                              <option value="Bahrain">Bahrain</option>
                              <option value="Bangladesh">Bangladesh</option>
                              <option value="Barbados">Barbados</option>
                              <option value="Belarus">Belarus</option>
                              <option value="Belgium">Belgium</option>
                              <option value="Belize">Belize</option>
                              <option value="Benin">Benin</option>
                              <option value="Bermuda">Bermuda</option>
                              <option value="Bhutan">Bhutan</option>
                              <option value="Bolivia">Bolivia</option>
                              <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                              <option value="Botswana">Botswana</option>
                              <option value="Bouvet Island">Bouvet Island</option>
                              <option value="Brazil">Brazil</option>
                              <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                              <option value="Brunei Darussalam">Brunei Darussalam</option>
                              <option value="Bulgaria">Bulgaria</option>
                              <option value="Burkina Faso">Burkina Faso</option>
                              <option value="Burundi">Burundi</option>
                              <option value="Cambodia">Cambodia</option>
                              <option value="Cameroon">Cameroon</option>
                              <option value="Canada">Canada</option>
                              <option value="Cape Verde">Cape Verde</option>
                              <option value="Cayman Islands">Cayman Islands</option>
                              <option value="Central African Republic">Central African Republic</option>
                              <option value="Chad">Chad</option>
                              <option value="Chile">Chile</option>
                              <option value="China">China</option>
                              <option value="Christmas Island">Christmas Island</option>
                              <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                              <option value="Colombia">Colombia</option>
                              <option value="Comoros">Comoros</option>
                              <option value="Congo">Congo</option>
                              <option value="Congo">Congo, the Democratic Republic of the</option>
                              <option value="Cook Islands">Cook Islands</option>
                              <option value="Costa Rica">Costa Rica</option>
                              <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                              <option value="Croatia">Croatia (Hrvatska)</option>
                              <option value="Cuba">Cuba</option>
                              <option value="Cyprus">Cyprus</option>
                              <option value="Czech Republic">Czech Republic</option>
                              <option value="Denmark">Denmark</option>
                              <option value="Djibouti">Djibouti</option>
                              <option value="Dominica">Dominica</option>
                              <option value="Dominican Republic">Dominican Republic</option>
                              <option value="East Timor">East Timor</option>
                              <option value="Ecuador">Ecuador</option>
                              <option value="Egypt">Egypt</option>
                              <option value="El Salvador">El Salvador</option>
                              <option value="Equatorial Guinea">Equatorial Guinea</option>
                              <option value="Eritrea">Eritrea</option>
                              <option value="Estonia">Estonia</option>
                              <option value="Ethiopia">Ethiopia</option>
                              <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                              <option value="Faroe Islands">Faroe Islands</option>
                              <option value="Fiji">Fiji</option>
                              <option value="Finland">Finland</option>
                              <option value="France">France</option>
                              <option value="France Metropolitan">France, Metropolitan</option>
                              <option value="French Guiana">French Guiana</option>
                              <option value="French Polynesia">French Polynesia</option>
                              <option value="French Southern Territories">French Southern Territories</option>
                              <option value="Gabon">Gabon</option>
                              <option value="Gambia">Gambia</option>
                              <option value="Georgia">Georgia</option>
                              <option value="Germany">Germany</option>
                              <option value="Ghana">Ghana</option>
                              <option value="Gibraltar">Gibraltar</option>
                              <option value="Greece">Greece</option>
                              <option value="Greenland">Greenland</option>
                              <option value="Grenada">Grenada</option>
                              <option value="Guadeloupe">Guadeloupe</option>
                              <option value="Guam">Guam</option>
                              <option value="Guatemala">Guatemala</option>
                              <option value="Guinea">Guinea</option>
                              <option value="Guinea-Bissau">Guinea-Bissau</option>
                              <option value="Guyana">Guyana</option>
                              <option value="Haiti">Haiti</option>
                              <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                              <option value="Holy See">Holy See (Vatican City State)</option>
                              <option value="Honduras">Honduras</option>
                              <option value="Hong Kong">Hong Kong</option>
                              <option value="Hungary">Hungary</option>
                              <option value="Iceland">Iceland</option>
                              <option value="India">India</option>
                              <option value="Indonesia">Indonesia</option>
                              <option value="Iran">Iran (Islamic Republic of)</option>
                              <option value="Iraq">Iraq</option>
                              <option value="Ireland">Ireland</option>
                              <option value="Israel">Israel</option>
                              <option value="Italy">Italy</option>
                              <option value="Jamaica">Jamaica</option>
                              <option value="Japan">Japan</option>
                              <option value="Jordan">Jordan</option>
                              <option value="Kazakhstan">Kazakhstan</option>
                              <option value="Kenya">Kenya</option>
                              <option value="Kiribati">Kiribati</option>
                              <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                              <option value="Korea">Korea, Republic of</option>
                              <option value="Kuwait">Kuwait</option>
                              <option value="Kyrgyzstan">Kyrgyzstan</option>
                              <option value="Lao">Lao People's Democratic Republic</option>
                              <option value="Latvia">Latvia</option>
                              <option value="Lebanon" selected>Lebanon</option>
                              <option value="Lesotho">Lesotho</option>
                              <option value="Liberia">Liberia</option>
                              <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                              <option value="Liechtenstein">Liechtenstein</option>
                              <option value="Lithuania">Lithuania</option>
                              <option value="Luxembourg">Luxembourg</option>
                              <option value="Macau">Macau</option>
                              <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                              <option value="Madagascar">Madagascar</option>
                              <option value="Malawi">Malawi</option>
                              <option value="Malaysia">Malaysia</option>
                              <option value="Maldives">Maldives</option>
                              <option value="Mali">Mali</option>
                              <option value="Malta">Malta</option>
                              <option value="Marshall Islands">Marshall Islands</option>
                              <option value="Martinique">Martinique</option>
                              <option value="Mauritania">Mauritania</option>
                              <option value="Mauritius">Mauritius</option>
                              <option value="Mayotte">Mayotte</option>
                              <option value="Mexico">Mexico</option>
                              <option value="Micronesia">Micronesia, Federated States of</option>
                              <option value="Moldova">Moldova, Republic of</option>
                              <option value="Monaco">Monaco</option>
                              <option value="Mongolia">Mongolia</option>
                              <option value="Montserrat">Montserrat</option>
                              <option value="Morocco">Morocco</option>
                              <option value="Mozambique">Mozambique</option>
                              <option value="Myanmar">Myanmar</option>
                              <option value="Namibia">Namibia</option>
                              <option value="Nauru">Nauru</option>
                              <option value="Nepal">Nepal</option>
                              <option value="Netherlands">Netherlands</option>
                              <option value="Netherlands Antilles">Netherlands Antilles</option>
                              <option value="New Caledonia">New Caledonia</option>
                              <option value="New Zealand">New Zealand</option>
                              <option value="Nicaragua">Nicaragua</option>
                              <option value="Niger">Niger</option>
                              <option value="Nigeria">Nigeria</option>
                              <option value="Niue">Niue</option>
                              <option value="Norfolk Island">Norfolk Island</option>
                              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                              <option value="Norway">Norway</option>
                              <option value="Oman">Oman</option>
                              <option value="Pakistan">Pakistan</option>
                              <option value="Palau">Palau</option>
                              <option value="Panama">Panama</option>
                              <option value="Papua New Guinea">Papua New Guinea</option>
                              <option value="Paraguay">Paraguay</option>
                              <option value="Peru">Peru</option>
                              <option value="Philippines">Philippines</option>
                              <option value="Pitcairn">Pitcairn</option>
                              <option value="Poland">Poland</option>
                              <option value="Portugal">Portugal</option>
                              <option value="Puerto Rico">Puerto Rico</option>
                              <option value="Qatar">Qatar</option>
                              <option value="Reunion">Reunion</option>
                              <option value="Romania">Romania</option>
                              <option value="Russia">Russian Federation</option>
                              <option value="Rwanda">Rwanda</option>
                              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                              <option value="Saint LUCIA">Saint LUCIA</option>
                              <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                              <option value="Samoa">Samoa</option>
                              <option value="San Marino">San Marino</option>
                              <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                              <option value="Saudi Arabia">Saudi Arabia</option>
                              <option value="Senegal">Senegal</option>
                              <option value="Seychelles">Seychelles</option>
                              <option value="Sierra">Sierra Leone</option>
                              <option value="Singapore">Singapore</option>
                              <option value="Slovakia">Slovakia (Slovak Republic)</option>
                              <option value="Slovenia">Slovenia</option>
                              <option value="Solomon Islands">Solomon Islands</option>
                              <option value="Somalia">Somalia</option>
                              <option value="South Africa">South Africa</option>
                              <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                              <option value="Span">Spain</option>
                              <option value="SriLanka">Sri Lanka</option>
                              <option value="St. Helena">St. Helena</option>
                              <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                              <option value="Sudan">Sudan</option>
                              <option value="Suriname">Suriname</option>
                              <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                              <option value="Swaziland">Swaziland</option>
                              <option value="Sweden">Sweden</option>
                              <option value="Switzerland">Switzerland</option>
                              <option value="Syria">Syrian Arab Republic</option>
                              <option value="Taiwan">Taiwan, Province of China</option>
                              <option value="Tajikistan">Tajikistan</option>
                              <option value="Tanzania">Tanzania, United Republic of</option>
                              <option value="Thailand">Thailand</option>
                              <option value="Togo">Togo</option>
                              <option value="Tokelau">Tokelau</option>
                              <option value="Tonga">Tonga</option>
                              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                              <option value="Tunisia">Tunisia</option>
                              <option value="Turkey">Turkey</option>
                              <option value="Turkmenistan">Turkmenistan</option>
                              <option value="Turks and Caicos">Turks and Caicos Islands</option>
                              <option value="Tuvalu">Tuvalu</option>
                              <option value="Uganda">Uganda</option>
                              <option value="Ukraine">Ukraine</option>
                              <option value="United Arab Emirates">United Arab Emirates</option>
                              <option value="United Kingdom">United Kingdom</option>
                              <option value="United States">United States</option>
                              <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                              <option value="Uruguay">Uruguay</option>
                              <option value="Uzbekistan">Uzbekistan</option>
                              <option value="Vanuatu">Vanuatu</option>
                              <option value="Venezuela">Venezuela</option>
                              <option value="Vietnam">Viet Nam</option>
                              <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                              <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                              <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                              <option value="Western Sahara">Western Sahara</option>
                              <option value="Yemen">Yemen</option>
                              <option value="Yugoslavia">Yugoslavia</option>
                              <option value="Zambia">Zambia</option>
                              <option value="Zimbabwe">Zimbabwe</option>
            </datalist>
               </div>   
               <div class="form">
                <input type="text" name="mypass" id="password-field" class="mypass" required="required" autocomplete="new-password" oninput="turnOnPasswordStyle()" >
                <label for="mypass" class="label-name">
                  <span class="content-name">password </span>
                </label>
                <i id="pass-status" class="fa fa-eye" aria-hidden="true" onClick="viewPassword()"></i>
               </div>
              <button type="submit" name="submit" class="button-for-profiles">UPDATE INFORMATION</button>
              </div>
    </div>   
  </div>
</form>             
</div>
</div> 
<?php }else{
         header('Location: login.php');
       }
    ?>
</div>
</body>
</html>   