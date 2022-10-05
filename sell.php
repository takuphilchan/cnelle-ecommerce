
<?php 
session_start(); 
if(!isset($_SESSION['logged'])){
  $_SESSION['redirectURL']=$_SERVER['REQUEST_URI'];
  header("Location: storeLoggin.php"); }
?>
<!DOCTYPE html>
<html>
<head>
     <title>cnelle</title>
     <link href="css/main.css?version=1.0" type="text/css" rel="stylesheet" />
     <link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
     <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
     <script src="javascript/keypads.js"></script>
     <script src="javascript/autocomp.js"></script>
    <script src="javascript/specialChar.js"></script>
    <script src="javascript/reload.js"></script>
</head>
<?php 
    error_reporting(0);
    session_start();
    include ('connect.php');
    if(!empty($_SESSION['company'])){
    if(isset($_POST["submit"])){
      function getRandomString($length = 4) {
        $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";
        $validCharNumber = strlen($validCharacters);
     
        $result = "";
     
        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
     
        return $result;
    }
     
      $image = explode(".", $_FILES["image"]["name"][0]);
      $imgContent = round(microtime(true)) .'1'.'.' . end($image);
      $temp1 = $_FILES["image"]["tmp_name"][0];
      $check = move_uploaded_file($temp1, "productimages/".$imgContent);

      $image2 = explode(".", $_FILES["image"]["name"][1]);
      $imgContent2 = round(microtime(true)) .'2'.'.' . end($image2);
      $temp2 = $_FILES["image"]["tmp_name"][1];
      $check2 = move_uploaded_file($temp2, "productimages/".$imgContent2);
     
      $image3 = explode(".", $_FILES["image"]["name"][2]);
      $imgContent3 = round(microtime(true)) .'3'.'.' . end($image3);
      $temp3 = $_FILES["image"]["tmp_name"][2];
      $check3 = move_uploaded_file($temp3, "productimages/".$imgContent3);
      if(empty($_FILES["video"]["name"])){
            $newfilename = "";

         }else{ 

           $fileName = explode(".", $_FILES["video"]["name"]);
           $newfilename = round(microtime(true)) . '.' . end($fileName);
           $temp = $_FILES["video"]["tmp_name"];
           $check4 = move_uploaded_file($temp, "productvideos/".$newfilename);
          }
        if($check!== false and $check2 !== false and $check3 !== false or $check4 !== false ){
                $prodname = $_POST['prodname'];
                $prodname = stripcslashes(htmlspecialchars($prodname));
                $address = $_POST['address'];
                $address = stripcslashes(htmlspecialchars($address));
                $price = $_POST['price'];
                $price = stripcslashes(htmlspecialchars($price));
                $company= $_SESSION['company'];
                $company = stripcslashes(htmlspecialchars($company));
                $code = getRandomString().round(microtime(true)) .'CH'.rand(0, 10000).getRandomString();
                $category = $_POST['category'];
                $category = stripcslashes(htmlspecialchars($category));
                $description = $_POST['description'];
                $description = stripcslashes(htmlspecialchars($description)); 
                $sql = "INSERT INTO products (image,image2,image3,video,prodname,price,company,category,color,UnitsInStock,code) values ('$imgContent','$imgContent2','$imgContent3','$newfilename','$prodname','$price','$company','$category','$weight','$description','$code')";
                $result = mysqli_query($con,$sql);
                if($result == true){
                  echo"<p class='notification-message'> $prodname was added to your sell list </p>";
                }else{
                  echo"<p class='invalid'> $prodname failed to upload, try again.</p>"; 
                }
      }else{ 
          "<p class='invalid'>failed to upload your product pictures try other pictures</p>";
      }  
   }
  }else{
    header('Location: storeLoggin.php');
  }
?>
<body class="body-background-with-design">
<div class="productback-sell">
  <h1 id="prodtitle">ADD PRODUCT INFOMATION</h1>
        <form action="sell.php" method="POST" enctype="multipart/form-data">
            <div id="sellimg">
            <label for="file">
            <div class="frame-display"> 
              <div class="titles-container"> <span class="titles">Add 3 images [required]<span>*</span></span></div>
             <input type="file" id="file" name="image[]" multiple style="display: none; outline-color: transparent;" required>
             <div class="frame" id="dvPreview"></div>
             </div></label><br> 
             <div class="frame-display"> 
              <div class="titles-container"><span class="">Add 1 video [optional]</span> </div>
              <input type="file" id="video" name="video" style="display: none; outline-color: transparent;" onchange="vids(event)">
              <video  id="vidplace"  class="frame-video" controls><source type='video/mp4'></video><br>
              <label for="video" class="addbutton">Click to add video</label>
            </div>
            </div>
            <div id="prodinfo">
            <div class="prodescr-container"><span class="titles">Product name<span>*</span></span><input type="text" name="prodname" id="stopChar" class="prodescr" required maxlength=90></div></div>
            <div class="prodescr-container"><span class="titles">Price [in US dollars]<span>*</span></span>  <input type="text" name="price" id="stopChar" class="prodescr" maxlength=20 onkeypress='return restrictAlphabets(event)' required></div>
            <div class="prodescr-container"><span class="titles">Category <span>*</span> </span> <input type="text" name="category" list="category" class="prodescr" required maxlength=22></div>
                            <datalist id="category">
                                <option value="Clothing">
                                <option value="Beverages">
                                <option value="Appliances">
                                <option value="Gadgets"> 
                                <option value="Vegetables">
                                <option value="Hardware">
                                <option value="Shoes">
                                <option value="Grocery">
                                <option value="Bags">
                                <option value="Books">
                                <option value="Services">
                                <option value="Dairy">
                                <option value="Housing">
                                <option value="Cars">
                                <option value="Women">
                                <option value="Men">
                                <option value="Sports">
                                <option value="Kids">
                                <option value="Youth">
                                <option value="Gaming">
                                <option value="Entertainment">
                                <option value="Other">
                            </datalist><br><br>
            <div class="prodescr-container"><span class="titles">Description<span>*</span></span><textarea type="text" name="description" id="description" required maxlength=300></textarea></div>
              <button type="submit" name="submit" id="sellbutton">Sell product</button><br><br>
            </div>
        </form>
   </div>
   <script src="javascript/image-placement-sell.js"></script>
</body>
</html>