
<head>
<title>cnelle</title>
<link href="css/main.css?version=1.0" type="text/css" rel="stylesheet" />
<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
<link rel="shortcut icon" href="https://www.cnelle.com/favicon.jpeg" type="image/x-icon" />
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
<script src="javascript/keypads.js"></script>
<script src="javascript/onclick-iframes.js?version=1.0"></script>
<script src="javascript/authoptions-toggle.js?version=1.0" ></script>
<meta content="width=device-width, initial-scale=0.80, maximum-scale=5.0, minimum-scale=0.80" name="viewport">
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script>
function changeImage(x){
  document.getElementById('image').src = x.src;
} 
</script> 
</head>
<body>
<div class="product-all-container">
<div class="productback-product">
<?php 
error_reporting(0);
session_start();
include ("connect.php");
$quantity = $_POST['quantity'];  
$quantity = stripcslashes(htmlspecialchars($quantity));
$prodid = $_POST['prodid'];  
$prodid = stripcslashes(htmlspecialchars($prodid));
$product_name = $_POST['productName']; 
$product_name = stripcslashes(htmlspecialchars($product_name));
$price = $_POST['price']; 
$price = stripcslashes(htmlspecialchars($price));
$total = $quantity * $price;
$total = stripcslashes(htmlspecialchars($total));
if(isset($_POST['wishlist'])){
if(!empty($_SESSION['username']) && !empty($_POST['prodid'])){
    $status = 0; 
    $wishlist = "INSERT INTO wishlist (productName, prodId, totalPrice, unitPrice, customer, quantity) values ('$product_name','$prodid','$total','$price','{$_SESSION['username']}', '$quantity')";
    $result = mysqli_query($con,$wishlist);
    echo "<div class='notification-message'>Added to wishlist</div>";
}else{
  header("Location:login.php"); 
}
}else if(isset($_POST['cart'])){
    $cart = "INSERT INTO cart (productName, prodId, totalPrice, unitPrice, customer, quantity) values ('$product_name','$prodid','$total','$price','{$_SESSION['username']}', '$quantity')";
    $result = mysqli_query($con,$cart);
    echo "<div class='notification-message'>Added to cart</div>";
}
?>
<?php
$proid=$_GET["p"];
$product = mysqli_query($con, "SELECT t1.id, t1.image, t1.image2, t1.image3,t1.code, t1.category, t1.video, t1.company, t1.price, t1.prodname ,t1.Date, t2.company, t2.country FROM products as t1, owners as t2 where (t1.company=t2.company and id='$proid')");
      while($product_array = $product->fetch_assoc()){
        $imgURL='productimages/'.$product_array["image"];
        $imgURL2='productimages/'.$product_array["image2"];
        $imgURL3='productimages/'.$product_array["image3"];
        $category = $product_array["category"];
        $productName = $product_array["prodname"];
        $product_id = $product_array['id'];
        $product_company = $product_array["company"] 
?>
       <div class="container-product-img-info">
       <div style="display: block;">
       <div><?php echo "<img src='".$imgURL."' id='image' alt='' class='product-main-image' raggable='false'>"?></div>
       <div style="display: inline-flex; margin-left: 20px; margin-top: 20px;">
       <?php echo "<img src='".$imgURL."' alt='' onclick='changeImage(this)' class='small-images' draggable='false'>"?>  
       <?php echo "<img src='".$imgURL2."' alt='' onclick='changeImage(this)' class='small-images' style='margin-left: 20px;' draggable='false' >"?>
       <?php echo "<img src='".$imgURL3."' alt='' onclick='changeImage(this)' class='small-images' style='margin-left: 20px;' draggable='false'>"?>
      <?php 
       if(!empty($product_array["video"])){
         
                $videoURL='productvideos/'.$product_array["video"];
       ?>
      <?php echo "<video class='small-video' style='margin-left: 20px;' controls><source src='".$videoURL."' type='video/mp4'></video>";?>
       <?php }?>
      </div>
      </div> 
      <div>      
       <div class="proddet-container">   
       <div class="product-name"><?php echo $product_array["prodname"];?></div>
       <div class="proddet">
       <div class="proddet-inner-top">
       <div class="namedsgn"><strong class="product-section-name">Store name</strong><br><span><?php echo $product_array["company"];?></span></div><br>
       <div class="namedsgn"><strong class="product-section-name">Product price</strong><br><span><?php echo "$".number_format(substr($product_array["price"], 0 , 8), 2); ?></span></div><br>
       </div>
       <div class="proddet-inner-middle">
        <div class="namedsgn"><strong class="product-section-name">Country</strong><br><span><?php echo $product_array["country"]; ?></span></div><br>
       <div class="namedsgn"><strong class="product-section-name">Posted on </strong><br><span><?php echo $product_array["Date"]; ?></span></div><br>
        </div>
        <div class="proddet-inner-bottom">
        <div class="namedsgn"><strong class="product-section-name">Product description</strong><br><span><?php echo $product_array["description"]; ?></span></div><br>
        </div>
        <button class="message-button-product" onclick="location.href='update_notification_status.php?company=<?php echo $product_company;?>'"><i class="fa fa-comments" aria-hidden="true"></i></button>
        </div>
       </div><br>     
       <form action="" method="POST">
        <div class="container-color-wishlist-company-outer">
        <div class="container-color-wishlist-company">
        <div class="color-wishlist-container">
        <div><input type="text" name="quantity" class="choose-color-quantity" value="1" onkeypress='return restrictAlphabets(event)' size="2"/></div>
        <div>
        <input type="text" name="prodid" hidden  value="<?php echo $product_array["id"]; ?>">
        <input type="text" name="productName" hidden value="<?php echo $product_array["prodname"]; ?> ">
        <input type="text" name="price" hidden value="<?php echo $product_array["price"]; ?> ">
       </div>     
        </div>
        <div class="cart-action-product">
        <button type="submit" name="wishlist" class="add-to-wishlist">Add to wishlist</button>
        <button type="submit" name="cart" class="add-to-cart">Add to cart</button> 
        </div>
        </div>
      <div class="proddet-comp">
      <?php 
        $imgComp = mysqli_query($con, "SELECT OwnerImage, company FROM owners where company = '{$product_company}'");
        while ($comp = $imgComp->fetch_assoc()){
            $img='storeprofile/'.$comp["OwnerImage"]; ?>
            <buttom onclick="location.href='clientsidestore.php?company=<?php echo $product_company;?>'" class="product-button-to-store"> <?php echo "<img src='".$img."' class='store-image-product'><br><p>Visit store</p>";?></button>
       
       <?php } 
       } ?>   
       </div>
       </div>
       </form>
      </div>
      </div> 
<div class="review-button" onclick='displayReviewsIframe("<?php echo $_GET["p"];?>")'>Click to show reviews</div>
<div id="iframeDisplayReviews" class="comments-container"></div>
            <?php
              $safe_value = stripcslashes(htmlspecialchars($category));
              $safe_product_value = stripcslashes(htmlspecialchars($productName));
              $new_product_name = substr($safe_product_value, 0 , 3);
              $query = mysqli_query($con, "SELECT t1.image, t1.id, t1.prodname,t1.category, t1.company, t1.price, t2.OwnerImage, t1.Date FROM products as t1, owners as t2 WHERE (t1.company = t2.company) and t1.category like '{$safe_value}' or t1.prodname like  '{$new_product_name}' ORDER BY RAND() limit 10");
              if ($query ->num_rows > 1) {  ?>
              <div class="products">
              <h3 class="products-heading-section">Other related products</h3>
              <?php
              while($product = mysqli_fetch_array($query)){
                $imgURL = 'productimages/'.$product["image"];
                $imageOwner = 'storeprofile/'.$product["OwnerImage"]; 
                if($product['id'] !== $proid){
               ?>
                <div class="productdeco">
                      <div class="productImg-container"> 
                      <a href="product.php?p=<?php echo $product["id"]; ?>" class="productImg-link">
                      <?php echo "<img src='".$imgURL."' class='productImg' draggable='false'>"?>
                      </a>
                      </div>
                    <div class="product-title"><?php echo substr($product["prodname"], 0 , 17); ?></div>
                    <div class="product-det">   
                    
                      <a class="product-company" href="clientsidestore.php?company=<?php echo $product["company"]; ?>">
                      <div class="company-prod">
                          <?php echo "<img src='".$imageOwner."' class='store-image' draggable='false'>"?><strong class="store-name-productdeco"><?php echo substr($product["company"], 0 , 14).' '.'⟩⟩'; ?></strong>
                    </div>
                    </a>
                    <div class="product-price"><?php echo "$".number_format(substr($product["price"], 0 , 8), 2); ?></div>
                    </div>
                </div>
              <?php
                    } 
                  }
                }else{
                  echo "<div class='no-messages'>No other related products</div>";
                }
                  ?>
    </div>             
</body>


